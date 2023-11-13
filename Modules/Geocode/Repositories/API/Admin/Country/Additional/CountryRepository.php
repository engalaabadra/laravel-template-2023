<?php
namespace Modules\Geocode\Repositories\API\Admin\Country\Additional;

use App\Repositories\EloquentRepository;
use Modules\Geocode\Entities\Country;
use Modules\Geocode\Repositories\Admin\Country\Additional\CountryRepositoryInterface;
use Modules\Geocode\Entities\Traits\Country\GeneralCountryTrait;

class CountryRepository extends EloquentRepository implements CountryRepositoryInterface
{
    use GeneralCountryTrait;
    public function getCitiesCountry($model,$request,$countryId){
        $citiesCountry=$this->getRelationCitiesCountry($model,$request,$countryId);
        return  $citiesCountry;
   }
}
