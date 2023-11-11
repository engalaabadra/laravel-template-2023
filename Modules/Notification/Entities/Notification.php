<?php

namespace Modules\Notification\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Notification\Entities\Traits\GeneralNotificationTrait;

class Notification extends Model
{
    use GeneralTrait,GeneralNotificationTrait,SoftDeletes;
    // protected $appends = ['original_active'];
    public $guarded = [];

}
