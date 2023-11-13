<?php
namespace Modules\Movement\Entities\Traits\User;
use GeneralTrait;
use Modules\Auth\Entities\User;
use Modules\Reservation\Entities\Reservation;
use Modules\Wallet\Entities\Wallet;
use Modules\Movement\Resources\User\MovementResource;
trait MovementMethods{
    
     //get data -paginates-//
  public function getPaginatesDataMethod($request, $model){
    if(isset(getallheaders()['lang']))  return $this->paginatesDataMethod($request, $model,getallheaders()['lang']);
    else return $this->paginatesDataMethod($request, $model);
    }
    public function paginatesDataMethod($request, $model,$lang=null){
        $user=authUser();
        $wallet=Wallet::where(['user_id'=>$user->id])->first();
        if(!$lang) $lang=localLang();
        return $model->where('wallet_id',$wallet->id)->with('wallet')->orderBy('created_at','desc')->paginate($request->total);
    }
    //get data -all- //
    public function getAllDataMethod($model){
        if(isset(getallheaders()['lang']))  return $this->allDataMethod($model,getallheaders()['lang']);
        else return $this->allDataMethod($model);
    }
    public function allDataMethod($model,$lang=null){
        $user=authUser();
        $wallet=Wallet::where(['user_id'=>$user->id])->first();
        if(!$lang) $lang=localLang();
        return $model->where('wallet_id',$wallet->id)->with('wallet')->orderBy('created_at','desc')->get();
    }
}
