<?php

namespace App\Http\Controllers\API\Auth\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Auth\Login\User\LoginRepository;
use Illuminate\Http\Request;
use Modules\Auth\Entities\User;
use Modules\Profile\Resources\UserResource;
use Modules\Profile\Resources\ProfileDoctorResource;

class LoginController extends Controller
{
    /**
     * @var LoginRepository
     */
    protected $loginRepo;
    /**
     * @var User
    */
    protected $user;

    public function __construct(LoginRepository $loginRepo,User $user){
        $this->loginRepo = $loginRepo;
        $this->user = $user;
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request){
        $login=  $this->loginRepo->login($request,$this->user);
        if(is_string($login)) return  clientError(0,$login);
        $data=[
            "token"=>createToken($login),
            "user" => new UserResource($login),
        ];
        return successResponse(0, $data,trans('auth.Logged in successfully'));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function destroy(Request $request)
    {
        $logout=  $this->loginRepo->logout($request);
        if(is_string($logout)) return  clientError(0,$logout);
        $logout ? successResponse(4) : serverError(0);
    }
}

