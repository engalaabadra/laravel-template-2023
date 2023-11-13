<?php
use Modules\Contact\Http\Controllers\WEB\User\ContactResourceController;

Route::resource('contacts', ContactResourceController::class,[
    'names'=>[
        'store'=>'store'
    ]
])->only(['store']);
