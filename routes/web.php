<?php

use App\Http\Controllers\WEB\ContactUsController;
use App\Http\Controllers\WEB\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\WEB\HomeController;


Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/doctors',[HomeController::class,'allDoctor'])->name('doctors');
Route::get('doctors/profile/{id}',[HomeController::class,'doctorProfile'] )->name('single-doctor');
Route::get('/blogs',[HomeController::class,'allBlog'] )->name('blogs');
Route::get('/blogs/{id}',[HomeController::class,'viewBlog'] )->name('single-blog');

Route::get('/register',[RegisterController::class,'create'] )->name('register-form');
Route::post('/register',[RegisterController::class,'store'] )->name('website-register');
Route::get('/success/{type}',function ($type) {
    if ($type == 0) {
        return view('pages.static.patient-success-page');
    }
    return view('pages.static.doctor-success-page');
});

Route::post('/contact-us',[ContactUsController::class,'store'] )->name('website-contact-us');


Route::get('/policy', function () {
    return view('pages.static.ar.policy');
})->name('policy');

Route::get('/about', function () {
    return view('pages.static.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.static.contact');
})->name('contact');


Route::get('/notfound', function () {
    return view('pages.static.notfound');
})->name('notfound');


Broadcast::routes();


// Route::post('/broadcasting/auth', function (Request $request) {

//     // dd(2);
//     // dd(authUser());
//     $user = $request->user();
//     // dd($user);
//     if (!$user) {
//         return response()->json(['message' => 'Unauthenticated.'], 401);
//     }

//     $pusher = new Pusher(
//         env('PUSHER_APP_KEY'),
//         env('PUSHER_APP_SECRET'),
//         env('PUSHER_APP_ID'),
//         [
//             'cluster' => env('PUSHER_APP_CLUSTER'),
//             'useTLS' => true,
//         ]
//     );


//     $socketId = $request->input('socket_id');
//     $channelName = $request->input('channel_name');
//     // dd($channelName);

//     $presenceData = [
//         'id' => $user->id,
//         'name' => $user->name,
//         'email' => $user->email,
//     ];
// // dd($pusher);
//     $auth = $pusher->presence_auth('Message.User.5', '8f3c06516d141d6bd465', $user->id, $presenceData);

//     return response($auth);
// });
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Reoptimized class loader:
Route::get('/optimize-clear', function() {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
//Clear Config clear:
Route::get('/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});
//migrate:
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate');
    return '<h1>Clear Config cleared</h1>';
});
//migrate-fresh:
Route::get('/migrate-fresh', function() {
    $exitCode = Artisan::call('migrate:fresh');
    return '<h1>Clear Config cleared</h1>';
});

//Passport install
Route::get('/passport-install', function() {
    $exitCode = Artisan::call('passport:install');
    return '<h1>passport install</h1>';
});

//storage link
Route::get('/storage-link', function() {
    $exitCode = Artisan::call('storage:link');
    return '<h1>storage link</h1>';
});



Route::get('auth/twitter', [TwitterController::class, 'loginwithTwitter']);
Route::get('auth/callback/twitter', [TwitterController::class, 'cbTwitter']);

//Lang
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\WEB\LanguageController@switchLang']);
Route::get('get-all-langs', ['as' => 'lang.langs', 'uses' => 'App\Http\Controllers\WEB\LanguageController@getAllLangs']);
Route::get('default-lang', ['as' => 'lang.default-lang', 'uses' => 'App\Http\Controllers\WEB\LanguageController@defaultLang']);


//additional
Route::get('/changeNames', function() {
    $arr = [];
    $files = \Storage::disk('public')->files("chats-files/thumbnail");
    foreach($files as $file)
    if (str_contains($file,"(L)")) {
        $variable = substr($file, 0, strpos($file, "(L)"));
        $str = str_replace("(L)", "", $file, $count);
        $str = str_replace("chats-files/thumbnail", "", $str, $count);
        // dd("chats-files" . $str);
        \Storage::disk('public')->move($file,"chats-files" . $str);
    }

});

