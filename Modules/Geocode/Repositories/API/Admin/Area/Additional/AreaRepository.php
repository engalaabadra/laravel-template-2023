<?php
namespace Modules\Geocode\Repositories\API\Admin\Area\Additional;

use App\Repositories\EloquentRepository;
use Modules\Geocode\Entities\Area;
use Modules\Geocode\Repositories\API\Admin\Area\Additional\AreaRepositoryInterface;
use Modules\Geocode\Entities\Traits\Area\GeneralAreaTrait;

class AreaRepository extends EloquentRepository implements AreaRepositoryInterface
{
    use GeneralAreaTrait;
    
    public function getAddressesTypesArea($model,$request,$areaId){
        $AddressesTypesArea=$this->getRelationAddressesTypesArea($model,$request,$areaId);
      return  $AddressesTypesArea;
   }
}