<?php
use Modules\Profile\Http\Controllers\API\User\ProfileController;
use Modules\Profile\Http\Controllers\API\Doctor\ProfileController as ProfileDoctorController;

Route::prefix('profile')->as('profile.')->group(function(){
    Route::get('show', [ProfileController::class,'show'])->name('show');
    Route::get('show/doctor/{doctorId}', [ProfileDoctorController::class,'show'])->name('show-doctor');
    Route::post('update', [ProfileController::class,'update'])->name('update');
    Route::post('update-password', [ProfileController::class,'updatePassword'])->name('update-password');
});

