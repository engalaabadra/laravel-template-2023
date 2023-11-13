<?php

namespace Modules\Banner\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use GeneralTrait;
use Modules\Banner\Entities\Traits\GeneralBannerTrait;

class Banner extends Model
{
    use GeneralTrait,GeneralBannerTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
