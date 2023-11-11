<?php


use Illuminate\Support\Facades\Route;
use Modules\Movement\Http\Controllers\API\Admin\MovementResourceController;

/**************************Routes Movements***************************** */
Route::resource('movements', MovementResourceController::class);

