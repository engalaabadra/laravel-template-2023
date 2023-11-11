<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneralTrait;
use Modules\Payment\Entities\Traits\GeneralPaymentTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;
use App\Models\Image;


class Payment extends BaseModel
{
    use GeneralTrait,GeneralPaymentTrait ,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

}
