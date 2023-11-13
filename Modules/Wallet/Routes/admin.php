<?php

use Illuminate\Support\Facades\Route;
use Modules\Wallet\Http\Controllers\API\Admin\WalletResourceController;

/**************************Routes Wallets***************************** */
Route::resource('wallets', WalletResourceController::class);
//another routes for module Wallets
Route::prefix('wallets')->as('wallets')->group(function(){
    //routes  additional for module Wallets
    Route::as('additional')->group(function(){
        
       
    });


});

