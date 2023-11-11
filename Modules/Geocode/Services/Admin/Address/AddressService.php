<?php
namespace Modules\Geocode\Services\Admin\Address;

use Modules\Geocode\Entities\Address;
use Modules\Geocode\Services\Admin\Address\AddressServiceInterface;
use Modules\Geocode\Traits\Admin\GeneralGeocodeTrait;

class AddressService  implements AddressServiceInterface
{
    use GeneralGeocodeTrait;

}
