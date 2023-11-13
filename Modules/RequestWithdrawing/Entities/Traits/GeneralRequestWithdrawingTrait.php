<?php
namespace Modules\RequestWithdrawing\Entities\Traits;
use Modules\RequestWithdrawing\Entities\Traits\RequestWithdrawingAttributes;
use Modules\RequestWithdrawing\Entities\Traits\RequestWithdrawingRelations;
use Modules\RequestWithdrawing\Entities\Traits\RequestWithdrawingScopes;

trait GeneralRequestWithdrawingTrait{
   use RequestWithdrawingAttributes;
   use RequestWithdrawingRelations;
   use RequestWithdrawingScopes;
    
}
