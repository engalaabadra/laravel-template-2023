<?php

use Illuminate\Support\Facades\Route;
use Modules\Review\Http\Controllers\API\Admin\ReviewResourceController;

/**************************Routes Reviews***************************** */
Route::resource('reviews', ReviewResourceController::class);
//another routes for module Reviews
Route::prefix('reviews')->as('reviews')->group(function(){
    //routes  additional for module Reviews
    Route::as('additional')->group(function(){
        
       
    });


});

