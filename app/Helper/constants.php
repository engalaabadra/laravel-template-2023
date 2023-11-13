<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Carbon\Carbon;

 function dashboard(){ 
    return 'admin.dashboard';
 }
 function home(){
    return 'home';
 }
 function localLang(){
   return config('app.locale');
 }
 function strRandom(){
   return mt_rand(1000, 9999);
}
function strLength($data){
   return Str::length($data);
}
function hashData($data){
   return Hash::make($data);
}
function hashCheck($value1,$value2){
   return Hash::check($value1, $value2);
}
function exceptData($data,$dataExcept){
   return Arr::except($data ,$dataExcept);
}

function urlFlag($code){
   return 'https://ipdata.co/flags/'.$code.'.png';
}
function systemCurrency(){
   return 'SAR';
}
function tapId(){
   return request()->input('tap_id');
}
function location(){
   return geoip(request()->ip());
}
function countryCurrency(){
   return  location()->currency;
}
//for filters
function page(){
   return request()->input('page');
}


function status(){
   return request()->input('status');
}

function message(){
   return request()->input('message');
}

//for filter doctors
function specialty(){
   return request()->input('specialty');
}
function rate(){
   return request()->input('rate');
}

function fav(){
   return request()->input('fav');
}

function day(){
   return request()->input('day');
}

function search(){
   return request()->input('search');
}

function type(){
   return request()->input('type');
}

function isStart(){
   return request()->input('is_start');
}
function isEnd(){
   return request()->input('is_end');
}

function randomLink(){
   return request()->input('link');
}

function getTokenPayment(){
   $token=base64_encode(config("services.moyasar.key_live"));
   return $token;
}

function isSoftDeletes($model){
   return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model));
}

function currentTime(){
   $currentDateTime = Carbon::now();
   $currentTime = $currentDateTime->toTimeString();
   return $currentTime;
}
function currentDate(){
   $currentDateTime = Carbon::now();
   $currentDate = $currentDateTime->toDateString();
   return $currentDate;
}