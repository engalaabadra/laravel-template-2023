<?php
namespace Modules\Board\Repositories\API\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Board\Repositories\API\Admin\Resources\BoardRepositoryInterface;
use Modules\Board\Entities\Traits\Admin\BoardMethods;
use GeneralTrait;

class BoardRepository extends EloquentRepository implements BoardRepositoryInterface
{
    use BoardMethods,GeneralTrait;
    
    public function search($model,$words,$col){
        $modelData = $this->searchMethod($model,$words,$col);
        return  $modelData;
    }
    public function store($data,$model){
        $user = $this->actionMethod($data,$model);
        return $user;
    }
    public function storeTrans($data,$model,$id){
        $board = $this->actionMethod($data,$model,$id);
        return $board;
    }

    public function update($data,$model,$id){
        $board = $this->actionMethod($data,$model,$id);
        return $board;
    }
    
}

