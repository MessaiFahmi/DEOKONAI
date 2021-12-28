<?php

namespace Deokonai\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Deokonai\Extensions\UpdateManager;
use Deokonai\Models\Setting;
use Deokonai\Support\EnvEditor;
use Exception;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class InstallController extends Controller {
    
    public const TEMP_KEY = 'base64:hmU1T3OuvHdi5t1wULI8Xp7geI+JIWGog9pBCNxslY8=';

    public const MIN_PHP_VERSION = '7.3';

    public const REQUIRED_EXTENSIONS = [
        'bcmath', 'ctype', 'json', 'mbstring', 'openssl', 'PDO', 'tokenizer',
        'xml', 'xmlwriter', 'curl', 'fileinfo', 'zip',
    ];

    protected $databaseDrivers = [
        'mysql' => 'MySQL/MariaDB',
        'pgsql' => 'PostgreSQL',
        'sqlite' => 'SQLite',
        'sqlsrv' => 'SQLServer',
    ];


    protected $hasRequirements;

    protected $requirements;

    /**
     * Create a new controller instance.
     */
    public function __construct() {

        $this->requirements = static::getRequirements();
        $this->hasRequirements = ! in_array(false, $this->requirements, true);

        $this->middleware(function (Request $request, callable $next) {
            if (config('app.key') !== self::TEMP_KEY || ! $this->hasRequirements) {
                return redirect()->home();
            }

            return $next($request);
        });

        $this->middleware(function (Request $request, callable $next) {
            return file_exists(App::environmentFilePath())
                ? $next($request)
                : redirect()->route('install.database');
        })->only([]);

        
    }

    public function index() {

        return view('install.index', [
            'compatible' => $this->hasRequirements,
            'requirements' => $this->requirements,
            'minPhpVersion' => self::MIN_PHP_VERSION,
            'phpVersion' => PHP_VERSION,
        ]);

    }

    public function database(Request $request) {

        if($request->isMethod('post')) {

            $this->validate($request, [
                'type' => ['required', Rule::in(array_keys($this->databaseDrivers))],
                'host' => ['required_unless:type,sqlite'],
                'port' => ['nullable', 'integer', 'between:1,65535'],
                'database' => ['required_unless:type,sqlite'],
                'user' => ['required_unless:type,sqlite'],
                'password' => ['nullable'],
            ]);
    
            $envPath = App::environmentFilePath();
            $databaseType = $request->input('type');
    
            try {
                if ($databaseType === 'sqlite') {
                    $databasePath = database_path('database.sqlite');
    
                    touch($databasePath);
    
                    DB::connection('sqlite')->getPdo(); // Ensure connection
    
                    File::copy(base_path('.env.example'), $envPath);
    
                    EnvEditor::updateEnv(['DB_CONNECTION' => $databaseType]);
    
                    return redirect()->route('install.admin_user');
                }
    
                $host = $request->input('host');
                $port = $request->input('port');
                $database = $request->input('database');
                $user = $request->input('user');
                $password = $request->input('password');
    
                $key = 'database.connections.test.';
    
                config([
                    $key.'driver' => $databaseType,
                    $key.'host' => $host,
                    $key.'port' => $port,
                    $key.'database' => $database,
                    $key.'username' => $user,
                    $key.'password' => $password,
                ]);
    
                DB::connection('test')->getPdo(); // Ensure connection
    
                copy(base_path('.env.example'), $envPath);
    
                EnvEditor::updateEnv([
                    'DB_CONNECTION' => $databaseType,
                    'DB_HOST' => $host,
                    'DB_PORT' => $port,
                    'DB_DATABASE' => $database,
                    'DB_USERNAME' => $user,
                    'DB_PASSWORD' => $password,
                ]);
    
                return redirect()->route('install.admin_user');
            } catch (Throwable $t) {
                return redirect()->back()->withInput()->with('error', utf8_encode($t->getMessage()));
            }

        }

        return view('install.database', [
            'databaseDrivers' => $this->databaseDrivers,
        ]);

    }

    public function admin_user(Request $request) {

        if($request->isMethod('POST')) {

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
                'password' => ['required', 'string', 'max:255', 'min:8'],
                'password_confirmation' => ['required', 'string', 'max:255', 'min:8', 'same:password'],
            ]);

            if($validated){

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->uuid = Str::uuid();
                $user->save();
                $user->assignRole('Administrateur');
                Auth::login($user);

                return redirect()->route('install.finish');

            }else{
                return redirect()->back()->withInput()->with('error', 'Les informations saisies ne sont pas valides');
            }
        }

        return view('install.admin_user');

    }

    public function finish() {

        EnvEditor::updateEnv([
            'APP_KEY' => 'base64:'.base64_encode(Encrypter::generateKey(config('app.cipher'))),
            'DEOKONAI_INSTALLED' => 'true',
        ]);

        return view('install.success');

    }

    public static function getRequirements() {

        $requirements = [
            'php' => version_compare(PHP_VERSION, static::MIN_PHP_VERSION, '>='),
            'writable' => is_writable(base_path()),
            'function-symlink' => static::hasFunctionEnabled('symlink'),
            'rewrite' => ! defined('DEOKONAI_NO_URL_REWRITE'),
            '64bit' => PHP_INT_SIZE !== 4,
        ];

        foreach (static::REQUIRED_EXTENSIONS as $extension) {
            $requirements['extension-'.$extension] = extension_loaded($extension);
        }

        return $requirements;

    }

    private static function hasFunctionEnabled(string $function) {

        if (! function_exists($function)) {
            return false;
        }

        try {
            return strpos(ini_get('disable_functions'), $function) === false;
        } catch (Exception $e) {
            return false;
        }

    }

    public static function parsePhpVersion() {

        preg_match('/^(\d+)\.(\d+)/', PHP_VERSION, $matches);

        if (count($matches) > 2) {
            return "{$matches[1]}.{$matches[2]}";
        }

        return PHP_VERSION;

    }
}
