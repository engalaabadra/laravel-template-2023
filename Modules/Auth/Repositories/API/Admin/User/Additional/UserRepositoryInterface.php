<?php
namespace Modules\Auth\Repositories\API\Admin\User\Additional;

interface UserRepositoryInterface
{
   public function getRolesUser($model,$userId);
   public function getPermissionsUser($model,$userId);

}
