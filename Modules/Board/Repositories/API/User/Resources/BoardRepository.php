<?php
namespace Modules\Board\Repositories\Resources\User;

use Modules\Board\Entities\Board;
use Modules\Board\Repositories\Resources\User\BoardRepositoryInterface;
use Modules\Board\Entities\Traits\BoardMethods;
use GeneralTrait;

class BoardRepository implements BoardRepositoryInterface
{
    use BoardMethods,GeneralTrait;
    public function all($request, $model){
        if(page()) return $this->getPaginatesData($request, $model);
        else return $this->getAllData($model);
    }

}