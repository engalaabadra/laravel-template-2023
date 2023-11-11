<?php
/**************************Auth************************************* */
use App\Http\Controllers\API\Auth\RecoveryPasswordController;
use App\Http\Controllers\API\Auth\User\LoginController;
use App\Http\Controllers\API\Auth\User\RegisterController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\ImageController;
use Illuminate\Http\Request;



Route::post('email',function(Request $request){
    if($request['type']=='welcome' || $request['type']=='check-code' || $request['type']=='new-reservation' || $request['type']=='cancel-reservation' || $request['type']=='reminder-reservation' || $request['type']=='rescheduling-reservation'){
      Mail::to($request['email'])->send(new General($request));  
      return 'done';
    } 
    return ;
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::prefix('register')->group(function(){
    //opertaions reg, login
    Route::post('/check-code', [RegisterController::class, 'checkCodeRegister'])->name('check-code-register');
    Route::get('/resend-code', [RegisterController::class, 'resendCodeRegister'])->name('resend-code-register');
});

    //opertaions recovery-by-password
Route::prefix('recovery-by-password')->group(function(){
    Route::post('forgot-password',  [RecoveryPasswordController::class,'forgotPassword'])->name('forgot-password');
});
Route::prefix('recovery-by-password')->group(function(){
    Route::post('check-code', [RecoveryPasswordController::class,'checkCodeRecovery'])->name('check-code-pass');
    Route::get('resend-code', [RecoveryPasswordController::class,'resendCodeRecovery'])->name('resend-code-pass');
    Route::post('reset-password', [RecoveryPasswordController::class,'resetPassword'])->name('reset-password');
});


//logout
Route::middleware(['auth:api'])->group(function(){
    Route::delete('/logout', [LoginController::class, 'destroy']);
});
//image
Route::get('/upload-image/{item}/{modelName}/{folderName}',[ImageController::class,'uploadImage'])->name('file.upload-image');

//home
Route::get('/home',[HomeController::class,'index'])->name('home.all');
//Lang
Route::get('lang/{lang}', ['as' => 'lang.switch.api', 'uses' => 'App\Http\Controllers\API\LanguageController@switchLang']);
Route::get('get-all-langs', ['as' => 'lang.langs.api', 'uses' => 'App\Http\Controllers\API\LanguageController@getAllLangs']);
Route::get('default-lang', ['as' => 'lang.default-lang.api', 'uses' => 'App\Http\Controllers\API\LanguageController@defaultLang']);

//additinal
