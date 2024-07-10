<?php

namespace Modules\Favorite\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use GeneralTrait;
use Modules\Favorite\Entities\Traits\GeneralFavoriteTrait;

class Favorite extends Model
{
    use GeneralTrait,GeneralFavoriteTrait;
    protected $appends = ['original_active'];
    public $guarded = [];

}
