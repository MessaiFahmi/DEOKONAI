<?php

namespace App\Extensions;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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

        $downloadPath = $this->downloadPath . DIRECTORY_SEPARATOR . $version . '.zip';

        if ($this->files->exists($downloadPath)) {
            $this->files->delete($downloadPath);
        }

        $downloadRequest = $this
            ->httpRequest()
            ->withOptions([
                'sink' => $downloadPath,
            ])
            ->get("https://github.com/{$this->source['owner']}/{$this->source['repository']}/archive/{$version}.zip");
            var_dump($this->downloadPath . '/' . $version . '.zip');
        if ($downloadRequest->ok()) {
            return $downloadPath;
        }
        return false;

    }

    public function update($version = null) {

        $zipFile = $this->downloadUpdate($version);

        if (!$zipFile) {
            return false;
        }

        // Get this extension updated

        // $zip = new ZipArchive;
        // if ($zip->open($zipFile) !== true) return false;
        // $path = base_path('app/Extensions/UpdateManager.php');
        // $newContent = $zip->getFromName("{$this->source['repository']}-{$this->version}{$path}");
        // file_put_contents(base_path($path), $newContent);
        // $zip->close();
        // return true;

        $zip = new ZipArchive;
        if ($zip->open($zipFile) !== true) return false;
        $updateFolder = $this->source['repository'] . "-" . $version;
        $updateFile = [];
        for ($i = 0; $i < $zip->numFiles; $i++) {
            // Get some infos on file
            $filename = $zip->getNameIndex($i);
            $stats = $zip->statIndex($i);
            $fileinfo = pathinfo($filename);
            // We remove github root folder from name
            $filename = substr($filename, strlen("{$updateFolder}/"));
            $dirname = substr($fileinfo['dirname'], strlen("{$updateFolder}/"));
            // We check if that file need to be updated or not
            if (in_array($filename, $this->bypassFiles)) continue;
            // If the folder doesn't exist, create it recursively
            if (!is_dir(base_path($dirname))) mkdir(base_path($dirname), 0775, true);

            // Copy file content if it's a file
            if ($stats['size'] > 0) {
                // We stop here if the file isn't writable
                $path = "zip://" . $zipFile . "#{$updateFolder}/" . "$filename";
                $updateFile[$path] = base_path($filename);
                $file = $updateFile[$path];
                if (file_exists($file) && !is_writable($file)) {
                    // $this->errorUpdate = $this->Lang->get('UPDATE__FAILED_FILE', [
                    //     '{FILE}' => $file,
                    // ]);
                    // $this->log("The file " . $file . " is not writable!");
                    echo "The file " . $file . " is not writable!";
                    return false;
                }
            }
        }

        // We copy the files here
        foreach ($updateFile as $key => $v) {
            $has_key = hash_file('sha1', $key);
            $hash = hash_file('sha1', $v);
            if($has_key == $hash)
                continue;
            if (!copy($key, $v)) {
                // $this->errorUpdate = $this->Lang->get('UPDATE__FAILED_FILE', [
                //     '{FILE}' => $v,
                // ]);
                echo "Failed to copy file from $key to " . $v;
                return false;
            }
            echo "The file " .$v. " was replaced with success !";
        }

        echo "End UPDATE";

        $zip->close();

        // Remove zip
        @unlink($zipFile);

        // Clear cache
        // Cache::clearGroup(false, '_cake_core_');
        // Cache::clearGroup(false, '_cake_model_');

        // Update database
        // return $this->updateDb();

        Cache::flush();

        Artisan::call('migrate', ['--force' => true, '--seed' => true]);

        return true;

    }


}