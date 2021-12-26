<?php

namespace App\Extensions;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class UpdateManager {

    public $source;

    public $downloadPath;

    public $files;

    private $bypassFiles = [
        '.DS_Store',
        '.htaccess',
        'empty',
        'app/Config/database.php',
        'config/secure',
        '__MACOSX',
        'config.json',
        'theme.default.json',
        '.editorconfig',
        '.env.example',
        '.gitignore',
        '.gitattributes',
        '.gitmodules',
        '.styleci.yml',
    ];

    public function __construct(Filesystem $files) {

        $this->files = $files;
        $this->downloadPath = storage_path('app' . DIRECTORY_SEPARATOR . 'updates' . DIRECTORY_SEPARATOR);
        $default_repository_type = config('deokonai.update.default_repository_type');
        $this->source = config('deokonai.update.repository_types.' . $default_repository_type);

    }

    public function httpRequest($headers = []) {

        $request = Http::
            withHeaders($headers);
        return $request;

    }

    public function getPrivateAccessToken() {

        return $this->source['private_access_token'] ?? null;

    }

    public function hasPrivateAccessToken() {
            
        return !empty($this->getPrivateAccessToken());

    
    }

    public function getVersions() {

        $headers = [];
        if($this->hasPrivateAccessToken()) {
            $headers = [
                'Authorization' => 'token ' . $this->getPrivateAccessToken(),
            ];
        } 
        $versions = $this->httpRequest($headers)
            ->get("https://api.github.com/repos/{$this->source['owner']}/{$this->source['repository']}/releases")
            ->json();
        if(!empty($versions)) {
            return $versions;
        }
        dd($versions);
        throw new \Exception('No versions availaible in repository.');
        
    }

    public function getVersion($version) {

        $versions = $this->getVersions();
        foreach ($versions as $v) {
            if ($v['tag_name'] == $version) {
                return $v;
            }
        }
        return null;

    }

    public function getlastVersion() {

        $versions = $this->getVersions();
        $latestVersion = $versions[0];
        return $latestVersion;

    }

    public function getLatestVersionNumber() {

        $latestVersion = $this->getlastVersion();
        return $latestVersion['tag_name'];

    }

    public function hasUpdate() {

        $latestVersion = $this->getLatestVersionNumber();
        $installedVersion = config('deokonai.update.version');
        return version_compare($installedVersion, $latestVersion, '<');

    }

    public function downloadUpdate($version = null) {

        if ($version == null) {
            $version = $this->getLatestVersionNumber();
        }else{
            $version = $this->getVersion($version);
        }

        if($version == null){
            return false;
        }

        if (! $this->files->exists($this->downloadPath)) {
            $this->files->makeDirectory($this->downloadPath);
        }

        $downloadPath = $this->downloadPath . $version . '.zip';

        if ($this->files->exists($downloadPath)) {
            $this->files->delete($downloadPath);
        }

        $downloadRequest = $this
            ->httpRequest()
            ->withOptions([
                'sink' => $downloadPath,
            ])
            ->get("https://github.com/{$this->source['owner']}/{$this->source['repository']}/archive/{$version}.zip");
        if ($downloadRequest->ok()) {
            return [
                'version' => $version,
                'downloadPath' => $downloadPath
            ];
        }
        return false;

    }

    public function update($version = null) {

        $update = $this->downloadUpdate($version);
        $version = $update['version'];
        $zipFile = $update['downloadPath'];
        
        if (!$zipFile) { return false; }

        $zip = new ZipArchive;
        if ($zip->open($zipFile) !== true) return false;
        $updateFolder = $this->source['repository'] . "-" . $version;
        $zip->extractTo(base_path('tmp/' ));
        $updateFile = [];
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            $stats = $zip->statIndex($i);
            $fileinfo = pathinfo($filename);
            $filename = substr($filename, strlen("{$updateFolder}/"));
            $dirname = substr($fileinfo['dirname'], strlen("{$updateFolder}/"));
            if (in_array($filename, $this->bypassFiles)) continue;
            if (!is_dir(base_path($dirname))) mkdir(base_path($dirname), 0775, true);

            if ($stats['size'] > 0) {
                $path = base_path('tmp/' . $updateFolder . '/' . $filename);
                $updateFile[$path] = base_path($filename);
                $file = $updateFile[$path];
                if (file_exists($file) && !is_writable($file)) {
                    echo "The file " . $file . " is not writable!";
                    return false;
                }
            }
        }

        foreach ($updateFile as $key => $v) {
            if (!copy($key, $v)) {
                return false;
            }
        }

        $zip->close();

        @unlink($zipFile);
        
        $dir = base_path('tmp/' . $updateFolder);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        
        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileinfo->getRealPath());
        }
        
        rmdir($dir);

        Cache::flush();

        Artisan::call('migrate', ['--force' => true, '--seed' => true]);

        return true;

    }


}