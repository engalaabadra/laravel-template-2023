<?php
use Modules\Movement\Http\Controllers\API\User\MovementResourceController;

Route::resource('movements', MovementResourceController::class)->only(['index']);
