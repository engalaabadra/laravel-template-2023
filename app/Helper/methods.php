<?php

use Modules\Review\Entities\Review;
use Modules\Favorite\Entities\Favorite;
use Modules\Bookmark\Entities\Bookmark;
use Modules\Reservation\Entities\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

function urlDomain(){
    return 'http://127.0.0.1:8000/';
}
function encryptString($string){
    return hash('md5', $string);
}

function avgRatingReview($doctorId){
    $averageRating = Review::where('doctor_id', $doctorId)
                        ->avg('rating');
    return round($averageRating,3);
}
function countReservationsDoctor($doctorId){
    $countReservationsDoctor = Reservation::where(['doctor_id'=> $doctorId,'status'=>'1'])->count();
    return $countReservationsDoctor;
}


function isFav($doctorId){
    if(authUser()){
        $isFav = Favorite::where(['doctor_id'=> $doctorId,'user_id'=>authUser()->id])->first();
        if($isFav) return true;
        else return false;
    }
}


function priceHalfHour($doctor){
   return  $doctor->profile->price_half_hour;
}

function calShareDoctor($price){
  return  $price * config('vars.share_doctor')/100;
}

function calShareTemplate($price){
    return  $price * config('vars.share_template')/100;
  }

function precentageTemplate($price){
    return  $price * config('vars.precentage_template')/100;
}
function calPaymentPrice($priceHalfHour,$duration){
   return ($priceHalfHour*2)*$duration;
}



function setTimeZone($utc){
    $dt = new DateTime($utc);
    $tz = new DateTimeZone(config('app.timezone')); // or whatever zone you're after

    $dt->setTimezone($tz);
    return $dt->format('Y-m-d H:i:s');
}

    
