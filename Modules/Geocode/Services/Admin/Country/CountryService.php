<?php
namespace Modules\Geocode\Services\Admin\Country;

use Modules\Geocode\Entities\Country;
use Modules\Geocode\Services\Admin\Country\CountryServiceInterface;
use Modules\Geocode\Traits\Admin\GeneralGeocodeTrait;

class CountryService  implements CountryServiceInterface
{
    use GeneralGeocodeTrait;

}
