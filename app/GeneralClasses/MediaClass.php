<?php
namespace App\GeneralClasses;
use Illuminate\Support\Facades\Storage;
class MediaClass {
    public static function store($file,$foldername){
        $resTypesThumbnail=    typesThumbnail($file);
        $filenametostore= $resTypesThumbnail['filenametostore'];
        
        //Upload File
        $resUploadFile = uploadFile($file,$foldername,$filenametostore);
        $file_path_original=$resUploadFile['file_path_original'];
        return $file_path_original;

    }

    public static function delete($files){
        if(gettype($files)=='object'){
            foreach($files as $file){
                Storage::delete($file->filename);
            }
        }else{
            $file=$files;
            Storage::delete($file);

        }

    }


}
