<?php
namespace Modules\Geocode\Repositories\API\Admin\Area\Additional;

interface AreaRepositoryInterface
{
    public function getAddressesTypesArea($model,$request,$areaId);
   
}
