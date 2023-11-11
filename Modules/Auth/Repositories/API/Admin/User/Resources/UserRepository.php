<?php
namespace Modules\Auth\Repositories\API\Admin\User\Resources;

use App\Repositories\EloquentRepository;
use Modules\Auth\Entities\Traits\User\GeneralUserTrait;
use Modules\Auth\Entities\Traits\User\UserMethods;
use GeneralTrait;
use  Modules\Auth\Repositories\API\Admin\User\Resources\UserRepositoryInterface;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    use UserMethods,GeneralTrait;

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
