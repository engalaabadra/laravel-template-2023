<?php
namespace Modules\Movement\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Movement\Repositories\User\Resources\MovementRepositoryInterface;
use Modules\Movement\Entities\Traits\User\MovementMethods;
use GeneralTrait;

class MovementRepository extends EloquentRepository implements MovementRepositoryInterface
{
    use GeneralTrait,MovementMethods;
    
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    } 
}
