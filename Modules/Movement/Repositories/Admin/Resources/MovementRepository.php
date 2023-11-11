<?php
namespace Modules\Movement\Repositories\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Movement\Repositories\Admin\Resources\MovementRepositoryInterface;
use Modules\Movement\Entities\Traits\Admin\MovementMethods;

class MovementRepository extends EloquentRepository implements MovementRepositoryInterface
{
    use MovementMethods;
}
