<?php
namespace Modules\RequestWithdrawing\Repositories\Admin\Resources;

use Modules\RequestWithdrawing\Repositories\Admin\Resources\RequestWithdrawingRepositoryInterface;
use Modules\RequestWithdrawing\Entities\Traits\Admin\RequestWithdrawingMethods;
use App\Repositories\EloquentRepository;

class RequestWithdrawingRepository extends EloquentRepository implements RequestWithdrawingRepositoryInterface
{
    use RequestWithdrawingMethods;

  }
  