<?php

use Illuminate\Support\Facades\Route;
use Modules\Banner\Http\Controllers\API\Admin\BannerResourceController;

/**************************Routes Banners***************************** */

Route::resource('banners', BannerResourceController::class);
// Route::post('banners/update/{id}', [BannerResourceController::class,'update']);

//another routes for module Banners
Route::prefix('banners')->as('banners')->group(function(){
    //routes  additional for module Banners
    Route::as('additional')->group(function(){
        
       
    });

});


