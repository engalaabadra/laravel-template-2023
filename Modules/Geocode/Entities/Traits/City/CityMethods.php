<?php
namespace Modules\Geocode\Entities\Traits\City;

trait CityMethods{
    public function getRelationStatesCity($model,$request,$cityId){
        $city=$this->find($cityId,$model);
        if(is_string($city)){
            return $city;
        }
        $StatesCity = $city->states()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        return  $StatesCity;
    }
}