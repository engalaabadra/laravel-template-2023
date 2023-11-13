<?php
namespace Modules\Geocode\Repositories\API\Admin\AddressType\Additional;

use App\Repositories\EloquentRepository;
use Modules\Geocode\Entities\AddressType;
use Modules\Geocode\Repositories\API\Admin\AddressType\Additional\AddressTypeRepositoryInterface;
use Modules\Geocode\Entities\Traits\AddressType\GeneralAddressTypeTrait;

class AddressTypeRepository extends EloquentRepository implements AddressTypeRepositoryInterface
{
    use GeneralAddressTypeTrait;
    public function getAddressesType($model,$request,$TypeId){
        $addressesType=$this->getRelationAddressesType($model,$request,$TypeId);
        return  $addressesType;
   }
}