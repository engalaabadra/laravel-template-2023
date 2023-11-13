<?php

namespace Modules\Geocode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;


class Country extends Model 
{
    use GeneralTrait,SoftDeletes;
   protected $appends = ['original_active'];
    public $guarded = [];

      
    
  
}
