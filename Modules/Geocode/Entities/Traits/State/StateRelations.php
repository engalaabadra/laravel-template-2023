<?php
namespace Modules\Geocode\Entities\Traits\State;
use Modules\Geocode\Entities\City;
use Modules\Geocode\Entities\AddressType;

trait StateRelations{

    //relations
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function addressesTypes(){
        return $this->hasMany(AddressType::class);
    }
}
