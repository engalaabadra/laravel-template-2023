<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\PasswordReset;
use Modules\Auth\Entities\User;
use App\Repositories\Auth\Recovery\Password\PasswordRepository;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Requests\Auth\ResendCodeRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use GeneralTrait;
use ProccessCodesService;
use SendingMessagesService;

class RecoveryPasswordController extends Controller
{
    use GeneralTrait;

    /**
     * @var PasswordRepository
     */
    protected $passwordRepo;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var PasswordReset
     */
    protected $passwordReset;
    public function __construct(User $user,PasswordReset $passwordReset,PasswordRepository $passwordRepo){
        $this->user = $user;
        $this->passwordRepo = $passwordRepo;
        $this->passwordReset = $passwordReset;

    }
    public function forgotPassword(ForgotPasswordRequest $request){
        $result =  $this->passwordRepo->forgotPassword($request,$this->passwordReset);
        if(is_string($result)) return  clientError(0,$result);
        return successResponse(0,$result);
    }

    public function checkCodeRecovery(CheckCodeRequest $request){
        $data=$request->validated();
        $result= $this->passwordRepo->checkCode($data,$this->passwordReset);
        if(is_string($result)) return  clientError(0,$result);
        return successResponse(0,$result);
    }

    public function resendCodeRecovery(){
        $result= $this->passwordRepo->resendCode($this->passwordReset);
        if(is_string($result)) return  clientError(0,$result);
        return successResponse(0,$result);
    }

    public function resetPassword(ResetPasswordRequest $request){
        $passwordReset=$this->passwordRepo->resetPassword($request);
        if(is_string($passwordReset)) return  clientError(0,$passwordReset);
        return successResponse(0,$passwordReset);
    }

}
