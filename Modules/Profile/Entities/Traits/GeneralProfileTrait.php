<?php
namespace Modules\Profile\Entities\Traits;
use Modules\Profile\Entities\Traits\ProfileAttributes;
use Modules\Profile\Entities\Traits\ProfileMethods;
use Modules\Profile\Entities\Traits\ProfileRelations;
use Modules\Profile\Entities\Traits\ProfileScopes;

trait GeneralProfileTrait{
   use ProfileAttributes;
   use ProfileMethods;
   use ProfileRelations;
   use ProfileScopes;
}
