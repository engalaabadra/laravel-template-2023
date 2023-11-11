<?php
namespace Modules\Auth\Repositories\API\Admin\Role\Additional;

use Modules\Auth\Repositories\API\Admin\Role\Additional\RoleRepositoryInterface;
use Modules\Auth\Entities\Traits\Role\GeneralRoleTrait;

class RoleRepository implements RoleRepositoryInterface
{
    use GeneralRoleTrait;

    public function getUsersRole($model,$roleId){
        $usersRole=$this->getRelationsRole($model,$roleId,'users');
        return $usersRole;
   }
    public function getPermissionsRole($model,$roleId){
        $permissionsRole=$this->getRelationsRole($model,$roleId,'permissions');
        return  $permissionsRole;
    }
}