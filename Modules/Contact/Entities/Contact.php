<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneralTrait;
use Modules\Contact\Entities\Traits\GeneralContactTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use GeneralTrait,GeneralContactTrait ,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
