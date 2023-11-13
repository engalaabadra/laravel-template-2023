<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Profile\Entities\Traits\GeneralProfileTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
class Profile extends Model
{
    use GeneralProfileTrait,SoftDeletes;
    protected $appends = ['original_gender'];

    public $fillable = ['user_id','bio','gender','birth_date','years_experience','license_number','price_half_hour'];

}
