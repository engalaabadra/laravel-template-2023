<?php
use Modules\Chat\Http\Controllers\API\User\ChatResourceController;
use Modules\Chat\Http\Controllers\API\User\ChatController;


Route::resource('chats', ChatResourceController::class)->only(['store','destroy']);
Route::prefix('chats')->group(function(){
    Route::post('store-files/{id}', [ChatController::class,'storeFiles']);
});

Route::delete('chats', [ChatResourceController::class,'deleteAll']);
Route::get('chats/doctor/{doctorId}', [ChatResourceController::class,'allChatsUserDoctor']);
