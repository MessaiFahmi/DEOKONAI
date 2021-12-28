<?php

namespace Deokonai\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DateTimeZone;
use Deokonai\Models\Image;
use Deokonai\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingsController extends Controller {

    private $mailEncryptionTypes = [
        'tls' => 'TLS',
        'ssl' => 'SSL',
    ];

    private $mailMailers = [
        'smtp' => 'SMTP',
    ];

    public function index(Request $request) {

        if($request->isMethod('post')){

            $settings = array_merge($this->validate($request, [
                'name' => ['required', 'string', 'max:50'],
                'description' => ['nullable', 'string', 'max:255'],
                'url' => ['required', 'url'],
                'timezone' => ['required', 'timezone'],
                'copyright' => ['nullable', 'string', 'max:150'],
                'keywords' => ['nullable', 'string', 'max:150'],
                'icon' => ['nullable', 'exists:images,file'],
                'logo' => ['nullable', 'exists:images,file'],
                'background' => ['nullable', 'exists:images,file'],
            ]), [
                'url' => rtrim($request->input('url'), '/'), // Remove trailing end slash
            ]);
    
            Setting::updateSettings($settings);
    
            $response = redirect()->route('admin.settings.index')->with('success', trans('admin.settings.status.updated'));
    
            return $response;

        }

        return view('admin.settings.index', [
            'images' => Image::all(),
            'icon' => setting('icon'),
            'logo' => setting('logo'),
            'background' => setting('background'),
            'timezones' => DateTimeZone::listIdentifiers(),
            'currentTimezone' => config('app.timezone'),
            'copyright' => setting('copyright'),
            'conditions' => setting('conditions'),
        ]);

    }

    public function seo(Request $request){

        if($request->isMethod('post')){
            $settings = $this->validate($request, [
                'html-head' => ['nullable', 'string'],
                'html-body' => ['nullable', 'string'],
                'welcome-popup' => ['required_with:enable_welcome_popup', 'nullable', 'string'],
            ]);
    
            if (! $request->filled('enable_welcome_popup')) {
                $settings['welcome-popup'] = null;
            }
    
            Setting::updateSettings($settings);
    
            return redirect()->route('admin.settings.seo')->with('success', trans('admin.settings.status.updated'));
        }
        return view('admin.settings.seo', [
            'htmlHead' => setting('html-head'),
            'htmlBody' => setting('html-body'),
        ]);

    }

    public function mail(Request $request){

        if($request->isMethod('post')){

            // $mailSettings = $this->validate($request, [
            //     'from-address' => ['required', 'string', 'email'],
            //     'mailer' => ['nullable', Rule::in(array_keys($this->mailMailers))],
            //     'smtp-host' => ['required_if:driver,smtp', 'nullable', 'string'],
            //     'smtp-port' => ['required_if:driver,smtp', 'nullable', 'integer', 'between:1,65535'],
            //     'smtp-encryption' => ['nullable', Rule::in(array_keys($this->mailEncryptionTypes))],
            //     'smtp-username' => ['nullable', 'string'],
            //     'smtp-password' => ['nullable', 'string'],
            // ]) + [
            //     'users_email_verification' => $request->filled('users_email_verification'),
            // ];
    
            // $mailSettings['smtp-password'] = encrypt($mailSettings['smtp-password'], false);
    
            // if ($mailSettings['mailer'] === null) {
            //     $mailSettings['mailer'] = 'array';
            //     $mailSettings['users_email_verification'] = false;
            // }
    
            // foreach ($mailSettings as $key => $value) {
            //     Setting::updateSettings('mail.'.str_replace('-', '.', $key), $value);
            // }
    
            // return redirect()->route('admin.settings.mail')->with('success', trans('admin.settings.status.updated'));
            
        }

        return view('admin.settings.mail', [
            'mailers' => $this->mailMailers,
            'encryptionTypes' => $this->mailEncryptionTypes,
            'smtpConfig' => config('mail.mailers.smtp', optional([])),
        ]);

    }

    // public function sendTestMail(Request $request){
    //     try {
    //         $request->user()->notify(new TestMail());
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'message' => trans('messages.status-error', ['error' => $e->getMessage()]),
    //         ], 500);
    //     }

    //     return response()->json(['message' => trans('admin.settings.mail.sent')]);
    // }

}
