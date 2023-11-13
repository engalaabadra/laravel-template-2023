<?php

namespace Modules\RequestWithdrawing\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\RequestWithdrawing\Entities\Traits\GeneralRequestWithdrawingTrait;
use GeneralTrait;

class RequestWithdrawing extends Model
{
    use GeneralTrait,GeneralRequestWithdrawingTrait,SoftDeletes;

    protected $appends = ['original_active'];
    protected $table = 'requests_withdrawings';
    public $guarded = [];

}
