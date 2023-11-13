<?php
use Modules\RequestWithdrawing\Http\Controllers\API\Admin\RequestWithdrawingResourceController;

/**************************Routes RequestWithdrawing***************************** */

Route::resource('requests-withdrawings', RequestWithdrawingResourceController::class)->only(['index','update']);
