<?php
namespace Modules\Geocode\Entities\Traits\Address;
use Modules\Geocode\Entities\AddressType;
use Modules\Geocode\Entities\Country;
use Modules\Geocode\Entities\City;
use Modules\Geocode\Entities\State;
use Modules\Geocode\Entities\Area;

trait AddressRelations{
    
    public function addressType(){
        return $this->belongsTo(AddressType::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);

    }
    public function city(){
        return $this->belongsTo(City::class);

    }
    public function state(){
        return $this->belongsTo(State::class);

    }
    public function area(){
        return $this->belongsTo(Area::class);

    }
    
}