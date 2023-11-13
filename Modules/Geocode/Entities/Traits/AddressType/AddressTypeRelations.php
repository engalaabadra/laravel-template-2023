<?php
namespace Modules\Geocode\Entities\Traits\AddressType;

use Modules\Geocode\Entities\Address;

trait AddressTypeRelations{
    
    //relations
    public function addresses(){
        return $this->hasMany(Address::class);
    }
}