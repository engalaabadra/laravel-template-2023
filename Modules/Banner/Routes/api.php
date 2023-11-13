<?php
use Modules\Banner\Http\Controllers\API\User\BannerResourceController;

Route::resource('banners', BannerResourceController::class)->only(['index']);

