<?php

namespace Modules\Auth\Http\Controllers\API\Admin\Role;
use App\Http\Controlers\Controler;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Auth\Repositories\API\Admin\Role\Additional\RoleRepository;
use Modules\Auth\Entities\Role;
use GeneralTrait;
use Modules\Auth\Resources\Admin\UserResource;
use Modules\Auth\Http\Controllers\API\Admin\Role\RoleResourceController;
use Modules\Auth\Resources\Admin\PermissionResource;

class RoleController extends RoleResourceController
{
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var RoleRepository
     */
    protected $roleRepo;
        /**
     * @var Role
     */
    protected $role;
    
    /**
     * StoreControler constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param StoreRepository $roleRepo
     * @param Store $role
     */
    public function __construct(EloquentRepository $eloquentRepo, Role $role,RoleRepository $roleRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->role = $role;
        $this->roleRepo = $roleRepo;
    }
    public function getUsersRole(Request $request,$userId){
        $usersRole=$this->roleRepo->getUsersRole($this->role,$userId);
        if(page()) $data=getDataResponse(UserResource::collection($usersRole));
        else $data=UserResource::collection($usersRole);
        return successResponse(0,$data);
    }
    public function getPermissionsRole(Request $request,$permissionId){
        $permissionsRole=$this->roleRepo->getPermissionsRole($this->role,$permissionId);
        if(page()) $data=getDataResponse(PermissionResource::collection($permissionsRole));
        else $data=PermissionResource::collection($permissionsRole);
        return successResponse(0,$data);
    }
}