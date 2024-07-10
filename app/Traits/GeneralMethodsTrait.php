<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Modules\Auth\Entities\User;
use Modules\Movement\Entities\Movement;




trait GeneralMethodsTrait{
    use AuthTrait;

    public function updateFcmMethod($request){
        $data=$request->validated();
        $user = User::where('id',authUser()->id)->first();
        $user->update(['fcm_token'=>$data['fcm_token']]);
        return $user;
    }


    public  function countMovements($walletId){

        return  Movement::where('wallet_id',$walletId)->count();
    }

}
