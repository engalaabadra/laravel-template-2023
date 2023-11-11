<?php
namespace Modules\Geocode\Entities\Traits\AddressType;

trait AddressTypeMethods{
    public function getRelationAddressesType($model,$request,$TypeId){
        $Type=$this->find($TypeId,$model);
        if(is_string($Type)){
            return $Type;
        }
        $addressesType = $Type->addresses()->withoutGlobalScope(ActiveScope::class)->withoutGlobalScope(LanguageScope::class)->paginate($request->total);
        return  $addressesType;
    }
}