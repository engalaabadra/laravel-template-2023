<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\API\Admin\User\UserResourceController;
use Modules\Auth\Http\Controllers\API\Admin\User\UserController;
use Modules\Auth\Http\Controllers\API\Admin\Role\RoleResourceController;
use Modules\Auth\Http\Controllers\API\Admin\Role\RoleController;

/**************************Routes Users***************************** */

Route::resource('users', UserResourceController::class);
Route::post('users/update/{id}', [UserResourceController::class,'update']);

//another routes for module Users
Route::prefix('users')->as('users')->group(function(){
    //routes  additional for module Users
    Route::as('additional')->group(function(){
        Route::get('get-roles-user/{userId}',[UserController::class,'getRolesUser'])->name('.get-roles-user');

       
    });

});

/**************************Routes Roles***************************** */

Route::resource('roles', RoleResourceController::class);
Route::post('roles/update/{id}', [RoleResourceController::class,'update']);

//another routes for module Roles
Route::prefix('roles')->as('roles')->group(function(){
    //routes  additional for module Roles
    Route::as('additional')->group(function(){
        Route::get('get-users-role/{roleId}',[RoleController::class,'getUsersRole'])->name('.get-users-role');
        Route::get('get-permissions-role/{roleId}',[RoleController::class,'getPermissionsRole'])->name('.get-permissions-role');
    
       
    });

});


