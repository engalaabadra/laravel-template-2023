<?php

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\API\Admin\PaymentResourceController;

/**************************Routes Payments***************************** */

Route::resource('payments', PaymentResourceController::class);
Route::post('payments/update/{id}', [PaymentResourceController::class,'update']);
//another routes for module Payments
Route::prefix('payments')->as('payments')->group(function(){

});
