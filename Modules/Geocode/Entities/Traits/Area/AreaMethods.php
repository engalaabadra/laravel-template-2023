<?php
namespace Modules\Geocode\Entities\Traits\Area;

trait AreaMethods{
    public function getRelationAddressesTypesArea($model,$request,$areaId){
        $area=$this->find($areaId,$model);
        if(is_string($area)){
            return $area;
        }
        $AddressesTypesArea = $area->addressesTypes()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        return  $AddressesTypesArea;
    }
}