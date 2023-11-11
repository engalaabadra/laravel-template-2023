<?php

use Illuminate\Support\Facades\Route;
use Modules\Chat\Http\Controllers\API\Admin\ChatResourceController;

/**************************Routes Chats***************************** */

Route::resource('chats', ChatResourceController::class);


