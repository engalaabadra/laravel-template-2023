<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneralTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;

class PaymentLog extends BaseModel
{
    use GeneralTrait ,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
