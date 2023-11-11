<?php
use Modules\Review\Http\Controllers\API\User\ReviewResourceController;
use Modules\Review\Http\Controllers\API\User\ReviewController;

Route::resource('reviews', ReviewResourceController::class);
//another routes for module Reviews
Route::prefix('reviews')->as('reviews')->group(function(){
    //routes  additional for module Reviews
    Route::as('additional')->group(function(){
        Route::get('doctor/{doctorId}',[ReviewController::class,'reviewsDoctor']);
    });
});
