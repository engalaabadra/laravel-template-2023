<?php
namespace Modules\Geocode\Repositories\API\Admin\City\Additional;

interface CityRepositoryInterface
{
    public function getStatesCity($model,$request,$cityId);
   
}
