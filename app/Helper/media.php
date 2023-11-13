<?php
use App\GeneralClasses\MediaClass;

    function typesThumbnail($media){
        if(!empty($media)){
            
        $filenamewithextension = $media->getClientOriginalName();
      //get filename without extension
      $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

      //get file extension
      $extension = $media->getClientOriginalExtension();

      //filename to store
      $filenametostore = $filename.'_'.time().'.'.$extension;

    //   //small thumbnail name
    //   $smallthumbnail = $filename.'_'.time().'(S)'.'.'.$extension;

    //   //medium thumbnail name
    //   $mediumthumbnail = $filename.'_'.time().'(M)'.'.'.$extension;

    //   //large thumbnail name
    //   $largethumbnail = $filename.'_'.time().'(L)'.'.'.$extension;
       return [
        'filenametostore'=>$filenametostore,
        // 'smallthumbnail'=>$smallthumbnail,
        // 'mediumthumbnail'=>$mediumthumbnail,
        // 'largethumbnail'=>$largethumbnail
       ];
      
        }
    }
//}

function uploadFile($media,$namefolder,$filenametostore) {
  $file_path_original =$media->storeAs('public/'.$namefolder, $filenametostore);
  return [
    'file_path_original'=>'storage/'.$file_path_original,

  ];
  
}
function storeFiles($files,$folderName){
    $arrFiles=array();
    foreach($files as $file){
        $file_path_original= MediaClass::store($file,$folderName);//store image
        $file_path_original_without_public= str_replace("public/","",$file_path_original);
        array_push($arrFiles,['filename'=>$file_path_original_without_public]);
    }
    return $arrFiles;
}
/**
 * Create a thumbnail of specified size
 *
 * @param string $path path of thumbnail
 * @param int $width
 * @param int $height
 */
function createThumbnail($path, $width, $height)
{

    $img = Image::make($path)->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    });
    $img->save($path);
}

   //for files
    
    function storeImages($request,$dataImages,$folderName){
    $data=$request->validated();
    if(!empty($data[$dataImages])){
        if($request->hasFile($dataImages)){
            $arrImages=[];
            $files= $request->file($dataImages); //upload files 
            foreach($files as $file){
                $file_path_original= MediaClass::store($file,$folderName);//store  images
                $file_path_original= str_replace("public/","",$file_path_original);
                $data[$dataImages]=$file_path_original;
                array_push($arrImages,['filename'=>$file_path_original]);
            }
            return $arrImages;
        }
    }
}

 function storeImageInFolder($dataImage,$folderName){
     $file_path_original= MediaClass::store($dataImage,$folderName);//store image
     $file_path_original_without_public= str_replace("public/","",$file_path_original);
     return $file_path_original_without_public;
}


 function storeThumb($request,$dataImage,$folderName){
    $data=$request->validated();
    $file_path_original= MediaClass::store($request->file($dataImage),$folderName);//store image
    $file_path_original_without_public= str_replace("public/","",$file_path_original);
    return $file_path_original_without_public;
}