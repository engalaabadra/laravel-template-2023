<?php
namespace Modules\Favorite\Repositories\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Favorite\Repositories\User\Resources\FavoriteRepositoryInterface;
use Modules\Favorite\Entities\Traits\FavoriteMethods;
use GeneralTrait;

class FavoriteRepository extends EloquentRepository implements FavoriteRepositoryInterface
{
    use GeneralTrait,FavoriteMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }
    //method normal delete
    public function delete($id,$model){
        return $this->normalDeleteItemMethod($id,$model);
    }
}
