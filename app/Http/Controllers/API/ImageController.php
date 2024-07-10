<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GeneralTrait;

class ImageController extends Controller
{
    public function uploadImage($request,$item,$modelName,$folderName){
        if(!empty($data['image'])) return $this->uploadImage($request,$item,$modelName,$folderName,$item->id);
    }
}
