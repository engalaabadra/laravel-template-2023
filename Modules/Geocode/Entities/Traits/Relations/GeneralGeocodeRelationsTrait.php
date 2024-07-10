<?php
namespace Modules\Geocode\Entities\Traits\Relations;
use Modules\Geocode\Entities\Traits\Relations\AddressRelation;
use Modules\Geocode\Entities\Traits\Relations\AddressTypeRelation;
use Modules\Geocode\Entities\Traits\Relations\CityRelation;
use Modules\Geocode\Entities\Traits\Relations\CountryRelation;
use Modules\Geocode\Entities\Traits\Relations\AreaRelation;
use Modules\Geocode\Entities\Traits\Relations\StateRelation;

trait GeneralGeocodeRelationsTrait{
   use CountryRelation;
   use CityRelation;
   use AreaRelation;
   use StateRelation;
   use AddressRelation;
   use AddressTypeRelation;
   
}
