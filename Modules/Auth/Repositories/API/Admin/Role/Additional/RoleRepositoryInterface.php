<?php
namespace Modules\Auth\Repositories\API\Admin\Role\Additional;

interface RoleRepositoryInterface
{
   public function getUsersRole($model,$roleId);
   public function getPermissionsRole($model,$roleId);

}
