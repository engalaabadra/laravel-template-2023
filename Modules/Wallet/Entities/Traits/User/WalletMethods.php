<?php
namespace Modules\Wallet\Entities\Traits\User;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Reservation\Entities\Reservation;
use Modules\Wallet\Resources\User\WalletResource;
use Modules\Payment\Traits\PaymentTrait;
use Modules\Movement\Traits\MovementTrait;
trait WalletMethods{
    use GeneralTrait,PaymentTrait,MovementTrait;

      //get data//
    public function balance($model){
        $user=authUser();
        $wallet=$model->where(['user_id'=>$user->id])->first();
        return  $wallet;
    }

    public function actionMethod($request,$model,$id=null){
        $data = $request->validated();
        $user=authUser();
        $wallet=$model->where(['user_id'=>$user->id])->first();
        $amount = $data['amount'];

        $url = $this->paymentProcessMethodWallet($wallet->id,$amount);
            if(isset($url->errors)){
                $url=$url->errors[0]->description;
            }
        return  [
                    'url'=>$url,
                    //'wallet'=>new WalletResource($wallet),
                    'wallet'=>$wallet,
                ];

    }
}

