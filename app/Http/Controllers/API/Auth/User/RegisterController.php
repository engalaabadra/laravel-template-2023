<?php

namespace App\Http\Controllers\API\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Requests\Auth\User\RegisterRequest;
use App\Models\RegisterCodeNum;
use App\Services\MsegatSmsService;
use App\Services\ProccessCodesService;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Entities\User;
use App\Repositories\Auth\Register\User\RegisterRepository;
use GeneralTrait;
use Modules\Auth\Entities\User\GeneralUserTrait;
use Modules\Geocode\Entities\Country;

class RegisterController extends Controller
{
    use GeneralTrait;

    /**
     * @var RegisterRepository
     */
    protected $regRepo;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var RegisterCodeNum
     */
    protected $registerCodeNum;

    public function __construct(RegisterRepository $regRepo, User $user, RegisterCodeNum $registerCodeNum)
    {
        $this->regRepo = $regRepo;
        $this->user = $user;
        $this->registerCodeNum = $registerCodeNum;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $regUser = $this->regRepo->register($request, $this->registerCodeNum);
        if (is_string($regUser)) return clientError(0, $regUser);
        $user = (object)$regUser;
       
        return successResponse(0, $user, trans('auth.Congrats...Registration completed successfully'));

    }

    /**
     * @return JsonResponse
     */
    public function checkCodeRegister(CheckCodeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $resultCodeUser = app(ProccessCodesService::class)->checkCode($this->registerCodeNum, $data['code']);
        if (is_string($resultCodeUser)) return clientError(0, $resultCodeUser);
       
        return successResponse(0, $resultCodeUser, trans('auth.Thanks,The code is valid'));
    }

    /**
     * @return JsonResponse
     */
    public function resendCodeRegister(): JsonResponse
    {
        //get data info_user from session
        $info_auth=session('info_auth');
        $code = strRandom();
        if (isset($info_auth->phone_no)){
            $result = app(ProccessCodesService::class)->processRegPhone($info_auth,$code);
            if(is_string($result)) return $result;
        }
        if (isset($info_auth->email)){
            $result = app(ProccessCodesService::class)->processRegEmail($info_auth,$code);
            if(is_string($result)) return $result;
        }
        return successResponse(0, $info_auth);
    }
}

