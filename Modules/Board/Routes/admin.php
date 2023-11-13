<?php

use Illuminate\Support\Facades\Route;
use Modules\Board\Http\Controllers\API\Admin\BoardResourceController;

/**************************Routes Boards***************************** */

Route::resource('boards', BoardResourceController::class);
Route::post('boards/update/{id}', [BoardResourceController::class,'update']);
//another routes for module boards
Route::prefix('boards')->as('boards')->group(function(){

});
