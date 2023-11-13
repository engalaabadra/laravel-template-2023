<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Area;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\Area\Additional\AreaRepository;
use Modules\Geocode\Entities\Area;
use GeneralTrait;
use Modules\Geocode\Resources\AddressTypeResource;
use Modules\Geocode\Http\Controllers\API\Admin\Area\AreaResourceController;
class AreaController extends AreaResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var AreaRepository
     */
    protected $areaRepo;
        /**
     * @var Area
     */
    protected $area;
    
    /**
     * AreaController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param AreaRepository $areaRepo
     * @param Area $area
     */
    public function __construct(EloquentRepository $eloquentRepo, Area $area,AreaRepository $areaRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->area = $area;
        $this->areaRepo = $areaRepo;
    }

    public function getAddressesTypesArea(Request $request,$areaId){
            $AddressesTypesArea=$this->areaRepo->getAddressesTypesArea($this->area,$request,$areaId);
 if(is_string($AddressesTypesArea)){
                return customResponse(404);
            }
            $data=AddressTypeResource::collection($AddressesTypesArea)->getDataResponse();
return customResponse(200,$data);

    }
}