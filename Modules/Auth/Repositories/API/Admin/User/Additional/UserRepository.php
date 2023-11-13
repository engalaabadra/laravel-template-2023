<?php
namespace Modules\Auth\Repositories\API\Admin\User\Additional;

use Modules\Auth\Repositories\API\Admin\User\Additional\UserRepositoryInterface;
use Modules\Auth\Entities\Traits\User\GeneralUserTrait;

class UserRepository implements UserRepositoryInterface
{
    use GeneralUserTrait;

    public function getRolesUser($model,$userId){
        $rolesUser = $this->getRelationsUser($model,$userId);
        return  $rolesUser;
   }

}
