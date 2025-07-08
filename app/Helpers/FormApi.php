<?php

namespace App\Helpers;

use App\Models\Module;
use App\Models\File;
use Exception;
use Illuminate\Support\Facades\Storage;
use Datetime;

class FormApi
{

    private static function getOrCreateModuleRecord($user, $module) {

        $existing = Module::where('module', $module)->where('user', $user)->first();
        if ($existing){
            return $existing;
        }

        $exist_no_user = Module::where('module', $module)->whereNull('user')->first();

        $basePath = storage_path("/labs/$module/$user");

        $logPath = "$basePath/meta/log";
        $formPath = "$basePath/meta/form.json";
        if($exist_no_user){

            $src = resource_path("defaults/$module");
            $dst = storage_path("labs/$module/$user/fromDefaults");
            
            $moduleRecord = $exist_no_user->replicate();
            $moduleRecord->user = $user;
            $moduleRecord->log_path = $logPath;

            $defaultFormPath = $dst . "/form.json";
            $formPath = file_exists($src . "/form.json") ? $defaultFormPath : $formPath;
            
            $moduleRecord->form_path = $formPath;
            $moduleRecord->submitted = false;
            $moduleRecord->save();

            if (!file_exists("$basePath/meta/")) {
                mkdir("$basePath/meta/", 0777, true);
            }
            touch($logPath);
            touch($formPath);
            
            if (file_exists($src)){
                mkdir($dst, 0777, true);
                self::copyDirectory($user, $src, $dst, $module);
            }

            return $moduleRecord;
        }else{
            throw new Exception("No module matching name $module found");
        }
    }

    private static function createFileEntry($owner, $module, $name, $path) {
        File::create([
            'owner' => $owner,
            'module' => $module,
            'name' => $name,
            'selfserve' => 1,
            'path' => $path,
        ]);
        touch($path);
    }

    private static function copyDirectory($user,$src, $dest,$module) {
        if (!file_exists($src)) {
            throw new Exception("Source directory does not exist: $src");
        }


        if (!file_exists($dest)) {
            mkdir($dest, 0777, true);
        }


        foreach (scandir($src) as $file) {
            if ($file == '.' || $file == '..')
                continue;

            $srcFile = $src . DIRECTORY_SEPARATOR . $file;
            $destFile = $dest . DIRECTORY_SEPARATOR . $file;

            if (is_dir($srcFile)) {
                self::copyDirectory($user, $srcFile, $destFile, $module);
            } else {
                echo("Copying file from $srcFile to $destFile");
                copy($srcFile, $destFile);
                self::createFileEntry($user, $module, $file, $destFile);
            }
        }
    }

    private static function gen_file_name($baseDir) {
        $fname = bin2hex(random_bytes(4));
        while(file_exists($baseDir . $fname)){
            $fname = bin2hex(random_bytes(4));
        }
        touch($baseDir . $fname);
        return $fname;
    }


    #I think everything that modifies should error if locked
    private static function errorIfLocked($moduleRecord) {
        if ($moduleRecord->locked || $moduleRecord->submitted || ($moduleRecord->due && now()->greaterThan($moduleRecord->due))){
            throw new Exception("The module is currently locked is empty or does not exist.");
        }
        return;
    }

    public static function write_log($user, $module, $message){

        try {
            $moduleRecord = self::getOrCreateModuleRecord($user, $module);
            self::errorIfLocked($moduleRecord);
            $logPath = $moduleRecord->log_path;
            $logMessage = "[" . now() . "] $message\n";
            file_put_contents($logPath, $logMessage, FILE_APPEND);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
    #Json passed in must use double quotes not single quotes
    #ie. parameter: '{"a":"b"}' works "{'a':'b'}" gets Invalid JSON format: Syntax error
    public static function form_update($user, $module, $json){
        try {
            $moduleRecord = self::getOrCreateModuleRecord($user, $module);
            self::errorIfLocked($moduleRecord);

            $formPath = $moduleRecord->form_path;
            $json = str_replace("'", '"', $json);
            $updatedData = json_decode($json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON format in input data: " . json_last_error_msg());
            }
            if (!file_exists($formPath)) {
                throw new Exception("Form file does not exist at path: $formPath");
            }

            $currentFormContent = file_get_contents(filename: $formPath);
            $jsonToUse = trim($currentFormContent);
            if(empty($jsonToUse)) $jsonToUse = "{}";
            $currentForm = json_decode($jsonToUse, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception(message: "Invalid JSON format in existing form file: " . json_last_error_msg());
            }

            $mergedForm = array_replace_recursive($currentForm, $updatedData);
            file_put_contents($formPath, json_encode($mergedForm, JSON_PRETTY_PRINT));
        } catch (Exception $e) {
            error_log("Error in form_update: " . $e->getMessage());
        }
    }


    public static function form_set($user, $module, $json){
        try {

            $moduleRecord = self::getOrCreateModuleRecord($user, $module);
            self::errorIfLocked($moduleRecord);
            $formPath = $moduleRecord->form_path;
            $directory = dirname($formPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            file_put_contents($formPath,$json);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public static function form_get($user, $module){


        try {
            $moduleRecord = self::getOrCreateModuleRecord($user, $module);
            $formPath = $moduleRecord->form_path;
            #Instead of error empty string returned if called on a file that does not exist
            return file_exists($formPath) ? file_get_contents($formPath) : '';
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public static function get_file_path($id){
            $file = File::findOrFail($id);
            return $file->path;
    }

    public static function file_open($id, $mode){
        $filePath = self::get_file_path($id);
        return fopen($filePath, $mode);
    }

    public static function file_delete($id){
        $filePath = self::get_file_path($id);
        try{
            unlink($filePath);
            File::where('id', $id)->delete();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
    public static function is_file_owner($user, $id){
        return File::where('id', $id)->where('owner', $user)->exists();
    }

    public static function file_create($user, $module){

        $baseDir = storage_path("labs/$module/$user");
        if (!file_exists($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        $fname = self::gen_file_name($baseDir);

        self::createFileEntry($user,$module,$fname, $baseDir . $fname);
        return File::where('owner', $user)->where('module', $module)->where('path', $baseDir . $fname)->value('id');
    }

    public static function file_id_for($user, $module, $filename){
        return File::where('owner', $user)->where('module', $module)->where('name', $filename)->value('id');
    }

    public static function files_for($user, $module){
        return File::where('owner', $user)->where('module', $module)->get();
    }

    public static function module_locked($user, $module){
        try{
            $moduleRecord = Module::where('module', $module)->where('user', $user) -> first();
            return $moduleRecord->locked || $moduleRecord->submitted || ($moduleRecord->due && now()->greaterThan($moduleRecord->due));
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

    }

    public static function mark_completed($user, $module, $done = true){
        Module::where('module', $module)->where('user', $user) -> update(['submitted' => $done]);
    }

    public static function is_completed($user, $module){
        return Module::where('module', $module)->where('user', $user) -> value('submitted') == true;
    }
    
    public static function reset_module($user, $module){
        try {

            $moduleRecord = self::getOrCreateModuleRecord($user, $module);
            $logPath = $moduleRecord->log_path;
            $formPath = $moduleRecord->form_path;

            if (file_exists($logPath)) {
                $backupPath = storage_path("labs/$module/$user/meta/backups/") . basename($logPath);
                if (!file_exists(dirname($backupPath))) {
                    mkdir(dirname($backupPath));
                }
                file_put_contents($backupPath, file_get_contents($logPath), FILE_APPEND);

                unlink($logPath);
            }
            $toDel =File::where('owner', $user)
            ->where('module', $module)
            ->get();

            foreach ($toDel as $file) {
                $path = $file->path;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            unlink($formPath);
            $moduleRecord->delete();
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return False;
        }
    }

    public static function current_user(){
        #return session('userid', 'Default');
        return "demo-default";
    }


    public static function logged_in_admin(){
       return static::current_user() == "Admin";
    }

    public static function is_force_lock($user, $module) {

        try{
            $moduleRecord = Module::where('module', $module)->where('user', $user) -> first();
            return $moduleRecord->locked == true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function is_late($user, $module) {

        try{
            $moduleRecord = Module::where('module', $module)->where('user', $user) -> first();
            return ($moduleRecord->due && now()->greaterThan($moduleRecord->due));
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

}

