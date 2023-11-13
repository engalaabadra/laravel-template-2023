<?php

namespace Modules\Movement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Movement\Entities\Traits\GeneralMovementTrait;
use GeneralTrait;

class Movement extends Model
{
    use GeneralTrait,GeneralMovementTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
