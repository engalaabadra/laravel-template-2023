<?php
namespace Modules\Geocode\Repositories\API\Admin\AddressType\Additional;

interface AddressTypeRepositoryInterface
{
    public function getAddressesType($model,$request,$countryId);
   
}
