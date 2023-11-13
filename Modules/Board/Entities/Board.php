<?php

namespace Modules\Board\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Board\Entities\Traits\GeneralBoardTrait;

class Board extends Model
{
    use GeneralTrait,GeneralBoardTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}

