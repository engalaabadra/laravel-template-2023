<?php
use Modules\Wallet\Http\Controllers\API\User\WalletResourceController;
use Illuminate\Support\Facades\Route;


Route::resource('wallets', WalletResourceController::class)->only(['index','store']);

