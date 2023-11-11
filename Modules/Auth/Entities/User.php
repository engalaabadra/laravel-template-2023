<?php

namespace Modules\Auth\Entities;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Modules\Auth\Entities\Role;
use Modules\Auth\Entities\Permission;
use  Modules\Auth\Entities\Traits\User\GeneralUserTrait;
use Modules\Geocode\Entities\Country;

class User extends Authenticatable implements MustVerifyEmail
{
    use GeneralTrait,GeneralUserTrait,LaratrustUserTrait , HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $appends = ['original_active'];
    public $fillable = [
        'fcm_token',
        'full_name',
        'nick_name',
        'password',
        'country_id',
        'phone_no',
        'email',
        'email_verified_at',
        'phone_verified_at',
        'active',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //mutators
    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = hashData($value);
    }
    //basic relations
    public function roles(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_user','user_id','permission_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }




}
