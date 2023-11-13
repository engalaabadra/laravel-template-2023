<?php
use Modules\Notification\Http\Controllers\API\User\NotificationController;

//notifications
Route::get('/',[NotificationController::class,'index']);
Route::post('/send-notification/user/{userId}',[NotificationController::class,'sendNotificationMethod']);
//fcm_token
Route::post('/update-fcm',[NotificationController::class,'updateFcm'])->name('update-fcm');
