<?php
namespace Modules\Geocode\Repositories\API\Admin\Country\Additional;

interface CountryRepositoryInterface
{
    public function getCitiesCountry($model,$request,$countryId);
   
}
