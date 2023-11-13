<?php
namespace Modules\Auth\Repositories\API\Admin\Role\Resources;

use App\Repositories\EloquentRepository;
use Modules\Auth\Repositories\API\Admin\Role\Resources\RoleRepositoryInterface;
use Modules\Auth\Entities\Traits\Role\GeneralRoleTrait;
use GeneralTrait;

class RoleRepository extends EloquentRepository implements RoleRepositoryInterface
{
    use GeneralRoleTrait,GeneralTrait;
    
    // public function all($requestTotal, $model){
    //     if(page()) return $this->getPaginatesDataMethod($requestTotal, $model);
    //     else return $this->getAllDataMethod($model);
    // }


    // public function store($request,$model){
    //     $user = $this->actionMethod($request,$model);
    //     return $user;
    // }
    // public function storeTrans($request,$model,$id){
    //     $user = $this->actionMethod($request,$model,$id);
    //     return $user;
    // }

    // public function update($request,$model,$id){
    //     $user = $this->actionMethod($request,$model,$id);
    //     return $user;
    // }
    

    
}
