<?php

namespace Modules\Geocode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Geocode\Entities\Traits\State\GeneralStateTrait;

class State extends Model 
{
    use GeneralStateTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

   
}
