<?php

namespace Modules\Geocode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AddressType extends Model 
{
    use SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

    
}
