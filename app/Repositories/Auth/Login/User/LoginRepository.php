<?php
namespace App\Repositories\Auth\Login\User;

use App\Repositories\EloquentRepository;

class LoginRepository extends EloquentRepository implements LoginRepositoryInterface{
    public function login($request,$model){
        $resultLogin = $request->has('email') || $request->has('phone_no') ? $request->checkLogin($request,'user') : trans('messages.Pls, enter email or phone');
        if(is_string($resultLogin)) return $resultLogin;
        $roles= $resultLogin->roles->pluck('name')->toArray();
        if(!in_array('user',$roles)) return trans('messages.Invalid credentials');
        return $resultLogin;
    }

    public function logout($request){
        $roles= authUser()->roles->pluck('name')->toArray();
        if(!in_array('user',$roles)) return trans('messages.Invalid credentials');
        $request->user()->token()->revoke();
        return true;
    }
}
