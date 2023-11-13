<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\API\Admin\ContactResourceController;

/**************************Routes Contacts***************************** */

Route::resource('contacts', ContactResourceController::class);


