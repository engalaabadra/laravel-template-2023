<?php
namespace Modules\Geocode\Repositories\API\Admin\City\Additional;

use App\Repositories\EloquentRepository;
use Modules\Geocode\Entities\City;
use Modules\Geocode\Repositories\API\Admin\City\Additional\CityRepositoryInterface;
use Modules\Geocode\Entities\Traits\City\GeneralCityTrait;

class CityRepository extends EloquentRepository implements CityRepositoryInterface
{
    use GeneralCityTrait;
    public function getStatesCity($model,$request,$cityId){
        $StatesCity=$this->getRelationStatesCity($model,$request,$cityId);
        return  $StatesCity;
   }
}