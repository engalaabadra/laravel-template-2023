<?php
namespace Modules\Auth\Entities\Traits\User;
use Modules\Auth\Entities\Traits\User\UserAttributes;
use Modules\Auth\Entities\Traits\User\UserMethods;
use Modules\Auth\Entities\Traits\User\UserRelations;
use Modules\Auth\Entities\Traits\User\UserScopes;

trait GeneralUserTrait{
    use UserAttributes;
    use UserMethods;
    use UserRelations;
    use UserScopes;

}
