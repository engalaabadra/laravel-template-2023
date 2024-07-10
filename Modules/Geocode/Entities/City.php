<?php

namespace Modules\Geocode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Geocode\Entities\Traits\City\GeneralCityTrait;
class City extends Model 
{
    use GeneralCityTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

   
}
