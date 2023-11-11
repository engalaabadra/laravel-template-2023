<?php

use Illuminate\Support\Facades\Route;
use Modules\Favorite\Http\Controllers\API\Admin\FavoriteResourceController;

/**************************Routes Favorites***************************** */
Route::resource('favorites', FavoriteResourceController::class);
//another routes for module Favorites
Route::prefix('favorites')->as('favorites')->group(function(){
    //routes  additional for module Favorites
    Route::as('additional')->group(function(){
        
       
    });

    //routes  services for module Favorites
    Route::prefix('services')->as('services')->group(function(){

    });
});

