<?php

namespace Modules\Geocode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Geocode\Entities\Traits\Area\GeneralAreaTrait;

class Area extends Model 
{
    use GeneralAreaTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
