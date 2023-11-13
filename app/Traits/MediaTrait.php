<?php
namespace App\Traits;

trait MediaTrait{
    public function uploadImage($data,$item,$modelName,$folderName,$id=null){
        $request = request();
        
        if($request->hasFile('image')){
            $data['image']=storeImageInFolder($data['image'],$folderName);
        }else{
            $data['image']=$item->image;
        }
        
        if($id){
            if($item->image){
                $item->image()->update(['url'=>$data['image']]);
            }else{
                $item->image()->create(['url'=>$data['image'],'imageable_id'=>$item->id,'imageable_type'=>$modelName]);
            }
        }else{
            $item->image()->create(['url'=>$data['image'],'imageable_id'=>$item->id,'imageable_type'=>$modelName]);
        }
    }     
    public function uploadFiles($request,$model,$folderName,$id){
        $data= $request->validated();
        $item=$this->find($model,$id,'id');
        if(is_numeric($item)) return 404;
        if($request->hasFile('files')){
            $filesItem=storeFiles($data['files'],$folderName);
        }
        $item->files()->createMany($filesItem);      
        return $filesItem;  
    }     
}
