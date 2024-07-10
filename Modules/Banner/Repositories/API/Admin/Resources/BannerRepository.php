<?php
namespace Modules\Banner\Repositories\API\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Banner\Repositories\API\Admin\Resources\BannerRepositoryInterface;
use Modules\Banner\Entities\Traits\Admin\BannerMethods;
use GeneralTrait;

class BannerRepository extends EloquentRepository implements BannerRepositoryInterface
{
    use BannerMethods,GeneralTrait;



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
