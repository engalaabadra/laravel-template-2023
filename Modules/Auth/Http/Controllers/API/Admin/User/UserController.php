<?php

namespace Modules\Auth\Http\Controllers\API\Admin\User;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Auth\Repositories\API\Admin\User\Additional\UserRepository;
use Modules\Auth\Entities\User;
use GeneralTrait;
use Modules\Auth\Resources\Admin\UserResource;
use Modules\Auth\Resources\Admin\RoleResource;
use Modules\Auth\Http\Controllers\API\Admin\User\UserResourceController;
class UserController extends UserResourceController
{
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var UserRepository
     */
    protected $userRepo;
        /**
     * @var User
     */
    protected $user;
    
    /**
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param StoreRepository $userRepo
     * @param Store $user
     */
    public function __construct(EloquentRepository $eloquentRepo, User $user,UserRepository $userRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->user = $user;
        $this->userRepo = $userRepo;
    }
    public function getRolesUser($userId){
        $rolesUser=$this->userRepo->getRolesUser($this->user,$userId);
        if(page()) $data=getDataResponse(RoleResource::collection($rolesUser));
        else $data=RoleResource::collection($rolesUser);
        return successResponse(0,$data);
    }
}