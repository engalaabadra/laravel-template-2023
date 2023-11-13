<?php
namespace Modules\RequestWithdrawing\Repositories\User\Resources;

use Modules\RequestWithdrawing\Repositories\User\Resources\RequestWithdrawingRepositoryInterface;
use Modules\RequestWithdrawing\Entities\Traits\User\RequestWithdrawingMethods;

class RequestWithdrawingRepository implements RequestWithdrawingRepositoryInterface
{
    use RequestWithdrawingMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }

  }
  