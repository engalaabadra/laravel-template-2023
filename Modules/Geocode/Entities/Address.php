<?php

namespace Modules\Geocode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Geocode\Entities\Traits\Address\GeneralAddressTrait;

class Address extends Model 
{

    use GeneralAddressTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

      
}
