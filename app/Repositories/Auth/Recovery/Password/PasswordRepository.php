<?php
namespace App\Repositories\Auth\Recovery\Password;

use App\Services\MsegatSmsService;
use App\Services\ProccessCodesService;
use App\Traits\GeneralTrait;
use Modules\Auth\Entities\User;
use App\Services\SendingMessagesService;

class PasswordRepository  implements PasswordRepositoryInterface{

    use GeneralTrait;

    public function forgotPassword($request,$model){//model: password_resets , model1: user
        $code = "0000";  //TODO::strRandom()
        $result =  $request->processForgotPassword($request,$code,$model);
        session(['info_auth'=>(object)$result]);
        return $result;
    }
    public function checkCode($data,$model){
        $objectCode= app(ProccessCodesService::class)->checkCode($model,$data['code']);
        if(is_string($objectCode)) return  $objectCode;
        $data=[
            'email'=>$data['email'],
            'type'=>'check-code',
            'code'=>$data['code']
        ];
        app(SendingMessagesService::class)->sendingMessage($data);
        return $objectCode;

    }
    public function resendCode($model){

        //get data info_user from session
        $info_auth=session('info_auth');
        $code = strRandom();
        if (isset($info_auth->phone_no)){
                $msg ="رمز تغيير كلمة المرور:" . $code." يرجى استخدامه فورًا.";
                $result = app(ProccessCodesService::class)->processRegPhone($model,$info_auth,$code,$msg);
                if(is_string($result)) return $result;
            } 
            if (isset($info_auth->email)){
                $result = app(ProccessCodesService::class)->processRegEmail($model,$info_auth,$code);
                if(is_string($result)) return $result;
            }
            $info_auth->code = $code;
            return $info_auth;
        }

    public function resetPassword($request){//model :user
        $data=$request->validated();
        $resultUser = $request->has('email') || $request->has('phone_no') ? $this->checkEmailPhone($request) : trans('messages.Pls, enter email or phone');

        if(is_string($resultUser)){
            return $resultUser;
        }else{
            $resultUser->update(['password'=>$data['password']]);
            return $resultUser;
        }
    }
}
