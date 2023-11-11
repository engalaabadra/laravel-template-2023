<?php
namespace Modules\Geocode\Entities\Traits\Area;
use Modules\Geocode\Entities\State;
use Modules\Geocode\Entities\AddressType;

trait AreaRelations{

    //relations
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function addressesTypes(){
        return $this->hasMany(AddressType::class);
    }
}
