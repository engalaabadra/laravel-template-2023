<?php


use Illuminate\Support\Facades\Route;
use Modules\Notification\Http\Controllers\API\Admin\NotificationResourceController;

/**************************Routes Notifications***************************** */
Route::resource('notifications', NotificationResourceController::class);

