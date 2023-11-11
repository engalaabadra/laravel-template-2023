<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Country;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\Country\Additional\CountryRepository;
use Modules\Geocode\Entities\Country;
use GeneralTrait;
use Modules\Geocode\Resources\CityResource;
use Modules\Geocode\Http\Controllers\API\Admin\Country\CountryResourceController;
class CountryController extends CountryResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var CountryRepository
     */
    protected $countryRepo;
        /**
     * @var Country
     */
    protected $country;
    
    /**
     * CountryController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param CountryRepository $countryRepo
     * @param Country $country
     */
    public function __construct(EloquentRepository $eloquentRepo, Country $country,CountryRepository $countryRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->country = $country;
        $this->countryRepo = $countryRepo;
    }

    public function getCitiesCountry(Request $request,$countryId){
            $CitiesCountry=$this->countryRepo->getCitiesCountry($this->country,$request,$countryId);
            if(is_string($CitiesCountry)){
                return customResponse(404);
            }
            $data=CityResource::collection($CitiesCountry)->getDataResponse();
            return customResponse(200,$data);

    }
}