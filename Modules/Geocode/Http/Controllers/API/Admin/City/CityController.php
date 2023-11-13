<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\City;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\City\Additional\CityRepository;
use Modules\Geocode\Entities\City;
use GeneralTrait;
use Modules\Geocode\Resources\StateResource;
use Modules\Geocode\Http\Controllers\API\Admin\City\CityResourceController;
class CityController extends CityResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var CityRepository
     */
    protected $cityRepo;
        /**
     * @var City
     */
    protected $city;
    
    /**
     * CityController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param CityRepository $cityRepo
     * @param City $city
     */
    public function __construct(EloquentRepository $eloquentRepo, City $city,CityRepository $cityRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->city = $city;
        $this->cityRepo = $cityRepo;
    }

    public function getStatesCity(Request $request,$cityId){
            $StatesCity=$this->cityRepo->getStatesCity($this->city,$request,$cityId);
            if(is_string($StatesCity)){
                return customResponse(404);
            }
            $data=StateResource::collection($StatesCity)->getDataResponse();
            return customResponse(200,$data);

    }
}