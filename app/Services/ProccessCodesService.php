<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Entities\User;
use App\Providers\RouteServiceProvider;
use App\Mail\SendingCode;
use Nexmo\Laravel\Facade\Nexmo;
use App\Services\SendingMessagesService;
use App\Services\MsegatSmsService;
use App\Models\RegisterCodeNum;
use GeneralTrait;

class ProccessCodesService{
    use GeneralTrait;
   
    public function processRegPhone($model,$request,$code,$msg){//model: RegisterCodeNum or PasswordReset 
        $validateData = null; 
        //if model is PasswordReset
        if(get_class($model) == "App\Models\PasswordReset"){
            //check if country_id for this phone no this user
            $user = User::where(['phone_no'=>$request->phone_no,'country_id'=>$request->country_id])->first();
            if(!$user) return trans('messages.your country is wrong , pls enter correct your country');
            else $validateData = $user;
        }
        
        //if model is RegisterCodeNum
        if(get_class($model) == "App\Models\RegisterCodeNum"){
            //1. service for : check if this phone no. is valid or not
            $validateResponse = $this->validatePhoneNo($request->phone_no, $request->country_id);
            if(!$validateResponse['message'])   return trans('messages.your phone no. not valid');
            else $validateData = $validateResponse;
        }
        //for models : RegisterCodeNum,PasswordReset
        //2. insert code for this phone in db
        $model->updateOrCreate(['phone_no' => $request->phone_no], [
            'phone_no' => $request->phone_no,
            'country_id' => $request->country_id,
            'code' => $code,
        ]);
        //3. send a sms
        app(SendingMessagesService::class)->sendingMessage($validateData,$msg);

    }
    public function processRegEmail($model,$request,$code){
        //insert code for this email in db
        $model->updateOrCreate(['email' => $request->email], [
            'email' => $request->email,
            'code' => $code,
        ]);
        //send a msg into email
            $dataEmail=[
            'code'=>$code,
            'email'=>$request->email,
            'type'=>'check-code',
        ];
        app(SendingMessagesService::class)->sendingMessage($dataEmail);
    }

    public function verificationPhone($user){
        User::where(['country_id'=>$user->country_id,'phone_no'=>$user->phone_no])->first();
        $user->phone_verified_at=now();
        $user->save();
    }
    public function verificationEmail($user){
        User::where(['email'=>$user->email])->first();
        $user->email_verified_at=now();
        $user->save();
    }

    public function checkCode($model,$code){
        //get data info_user from session
        $info_auth=session('info_auth');
        if (isset($info_auth->phone_no))  $resultCodeUser = $model->where(['code'=> $code,'country_id'=>$info_auth->country_id,'phone_no'=>$info_auth->phone_no])->first();
        elseif (isset($info_auth->email))  $resultCodeUser = $model->where(['code'=> $code,'email'=>$info_auth->email])->first();
        // check if it does not expired: the time is one hour
        if(!$resultCodeUser){
            return trans('messages.code is invalid, try again');
        }
        if ($resultCodeUser->created_at > now()->addHour()) {
            $resultCodeUser->delete();
            return trans('messages.code is expire');
        }
        
        if(get_class($model) == "App\Models\RegisterCodeNum"){
            //resullt from this check(write *code valid* , and from prev. check (in reg route) -> *phone,email valid*) is true :
            // so will add this user into db
            if(isset($info_auth->phone_no) && isset($info_auth->email)) $user = User::create(['email'=>$info_auth->email , 'password'=>$info_auth->password , 'country_id'=>$info_auth->country_id , 'phone_no'=>$info_auth->phone_no , 'fcm_token'=>$info_auth->fcm_token ]);
            elseif(isset($info_auth->phone_no)) $user = User::create(['password'=>$info_auth->password , 'country_id'=>$info_auth->country_id , 'phone_no'=>$info_auth->phone_no , 'fcm_token'=>$info_auth->fcm_token ]);
            elseif(isset($info_auth->email)) $user = User::create(['email'=>$info_auth->email , 'password'=>$info_auth->password , 'fcm_token'=>$info_auth->fcm_token ]);
            $token = createToken($user);
            //verification phone, email
            if($resultCodeUser->phone_no) app(ProccessCodesService::class)->verificationPhone($user);
            if($resultCodeUser->email) app(ProccessCodesService::class)->verificationEmail($user);
            $data = [
                'user'=>$user,
                'token'=>$token,
                'code'=>$code
            ];
        }elseif(get_class($model) == "App\Models\PasswordReset"){
            if (isset($info_auth->phone_no))  $user = User::where(['country_id'=>$info_auth->country_id,'phone_no'=>$info_auth->phone_no])->first();
            elseif (isset($info_auth->email))  $user = User::where(['email'=>$info_auth->email])->first();
        
            $data = [
                'code'=>$code,
                'user'=>$user,
            ];
        }
        return $data;
    }
}
