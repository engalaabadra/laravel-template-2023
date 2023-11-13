<?php
namespace Modules\Wallet\Traits\User;
use GeneralTrait;

trait WalletTrait{
    public function addIntoWallet($model,$price,$userId,$reservationId){
        //will add price into wallet user
        $priceShareTemplate = calShareTemplate($price);
        $wallet=$model->where(['user_id'=>$userId])->first();
        $priceShareUser=$price - $priceShareTemplate;
        $wallet->balance = $wallet->balance + ($priceShareUser);
        $wallet->save();

        //add a movement
        $nameMovement = trans('messages.adding into wallet');
        $typeMovement = '1';//Deposition
        $this->createMovement($model,$priceShareUser,$userId,$nameMovement,$typeMovement,$reservationId);

        return $wallet;
    }
    public function addIntoWalletCallback($model,$price,$walletId){
        //will add price into wallet user
        $wallet=$model->where(['id'=>$walletId])->first();
        $wallet->balance = $wallet->balance + ($price);
        $wallet->save();
        //add a movement
        $nameMovement = trans('messages.adding into wallet');
        $typeMovement = '1';//Deposition
        $this->createMovement($model,$price,$wallet->user_id,$nameMovement,$typeMovement);
        return $wallet;
    }
}

