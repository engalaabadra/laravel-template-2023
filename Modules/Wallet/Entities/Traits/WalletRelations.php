<?php
namespace Modules\Wallet\Entities\Traits;
use Modules\Auth\Entities\User;
use Modules\Wallet\Entities\Wallet;
use Modules\RequestWithdrawing\Entities\RequestWithdrawing;

trait WalletRelations{


    public function requestWithdrawing(){
        return $this->belongsTo(RequestWithdrawing::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }
}
