<?php
namespace Modules\Geocode\Entities\Traits\Country;
use Modules\Geocode\Entities\City;
use Modules\Auth\Entities\User;

trait CountryRelations{
    public function cities(){
        return $this->hasMany(City::class);
    }
    public function users(){
        $this->hasMany(User::class);
    }
}
