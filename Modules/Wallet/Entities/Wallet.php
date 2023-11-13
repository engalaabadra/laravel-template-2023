<?php

namespace Modules\Wallet\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Wallet\Entities\Traits\GeneralWalletTrait;
use GeneralTrait;

class Wallet extends Model
{
    use GeneralTrait,GeneralWalletTrait,SoftDeletes;
    protected $appends = ['original_active'];
    public $guarded = [];

}
