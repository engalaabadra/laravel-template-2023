<?php
namespace Modules\Geocode\Entities\Traits\City;
use Modules\Geocode\Entities\Country;
use Modules\Geocode\Entities\State;

trait CityRelations{
    //relations
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function states(){
        return $this->hasMany(State::class);
    }

}
