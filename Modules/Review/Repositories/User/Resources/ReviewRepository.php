<?php
namespace Modules\Review\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Review\Repositories\User\Resources\ReviewRepositoryInterface;
use Modules\Review\Entities\Traits\User\ReviewMethods;
use GeneralTrait;

class ReviewRepository extends EloquentRepository implements ReviewRepositoryInterface
{
    use GeneralTrait,ReviewMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }

    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }
    public function update($request,$id,$model){
        $user = $this->actionMethod($request,$model,$id);
        return $user;
    }
    public function delete($id,$model){
        $user = $this->deleteReview($id,$model);
        return $user;
    }


}
