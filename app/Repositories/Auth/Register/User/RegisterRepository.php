<?php
namespace App\Repositories\Auth\Register\User;

use Illuminate\Support\Facades\Hash;
use GeneralTrait;
use Modules\Auth\Entities\Traits\User\GeneralUserTrait;
use Illuminate\Support\Arr;

class RegisterRepository implements RegisterRepositoryInterface{
    use GeneralTrait,GeneralUserTrait;

    public function register($request,$model){//model2:registerCodeNum
        $resultReg = $request->actionRegister($request,$model);
        if(is_string($resultReg)) return $resultReg;
        session(['info_auth'=>(object)$resultReg]);
        return $resultReg;
    }
}
