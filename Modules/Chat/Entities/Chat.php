<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Chat\Entities\Traits\GeneralChatTrait;

class Chat extends Model
{
    use GeneralTrait,GeneralChatTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
