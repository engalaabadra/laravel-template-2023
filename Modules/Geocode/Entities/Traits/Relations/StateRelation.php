<?php
namespace Modules\Geocode\Entities\Traits\Relations;
use Modules\Geocode\Entities\City;
use Modules\Geocode\Entities\State;

trait StateRelation{
 //relations
 public function city(){
    return $this->belongsTo(City::class);
}
public function areas(){
    return $this->hasMany(Area::class);
}
}
