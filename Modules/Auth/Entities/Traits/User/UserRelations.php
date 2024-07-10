<?php
namespace Modules\Auth\Entities\Traits\User;
use App\Models\Image;
use Modules\Profile\Entities\Profile;
use Modules\Wallet\Entities\Wallet;
use Modules\Review\Entities\Review;
use Modules\Specialty\Entities\Specialty;
use Modules\Favorite\Entities\Favorite;
use Modules\Reservation\Entities\Reservation;
use Modules\Appointment\Entities\Appointment;
use Modules\Duration\Entities\Duration;
use Modules\Time\Entities\Time;
use Modules\Day\Entities\Day;
use Modules\Geocode\Entities\Country;

trait UserRelations{
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function specialties(){//this is a doctor: have many of specialties
        return $this->belongsToMany(Specialty::class,'specialties_doctors','doctor_id','specialty_id');
    }
    public function profile() {
        return $this->hasOne(Profile::class);
    }
    public function reviewsUser(){
        return $this->hasMany(Review::class,'user_id');
    }
    public function reviewsDoctor(){
        return $this->hasMany(Review::class,'doctor_id');
    }

    public function favoritesUser(){
        return $this->hasMany(Favorite::class,'user_id');
    }
    public function favoritesDoctor(){
        return $this->hasMany(Favorite::class,'doctor_id');
    }
    public function reservations(){
        return $this->hasMany(Reservation::class,'user_id');
    }
    public function reservationsDoctor(){
        return $this->hasMany(Reservation::class,'doctor_id');
    }
    public function appointments(){
        return $this->hasMany(Appointment::class,'doctor_id');
    }
    // public function durationsDoctor(){
    //    return $this->belongsToMany(Duration::class,'durations_doctors','doctor_id','duration_id');
    // }




    public function durations(){
        return $this->belongsToMany(Duration::class,'appointments','doctor_id','duration_id');
    }
    public function days(){
        return $this->belongsToMany(Day::class,'appointments','doctor_id','day_id');
    }
    // public function times(){
    //     return $this->belongsToMany(time::class,'appointments','doctor_id','time_id');
    // }

    public function chatDoctors(){
        return $this->hasMany(Chat::class,'doctor_id');
    }

    public function chatUsers(){
        return $this->hasMany(Chat::class,'user_id');
    }

    public function times(){
        return $this->hasMany(Time::class,'doctor_id');
    }

    public function wallet(){
        return $this->hasOne(Wallet::class,'user_id');
    }
}
