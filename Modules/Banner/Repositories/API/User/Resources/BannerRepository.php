<?php
namespace Modules\Banner\Repositories\Resources\User;

use App\Repositories\EloquentRepository;
use Modules\Banner\Repositories\Resources\User\BannerRepositoryInterface;
use Modules\Banner\Entities\Traits\User\BannerMethods;
use GeneralTrait;

class BannerRepository extends EloquentRepository implements BannerRepositoryInterface
{
    use BannerMethods,GeneralTrait;
    
    public function all($request, $model){
        if(page()) return $this->getPaginatesData($request, $model);
        else return $this->getAllData($model);
    }

}
