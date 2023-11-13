<?php
use App\Http\Controllers\API\Auth\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::middleware(['auth:api'])->group(function(){
    Route::delete('/logout', [LoginController::class, 'destroy']);
});
