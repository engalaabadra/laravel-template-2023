<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Address;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\AddressType\Additional\AddressTypeRepository;
use Modules\Geocode\Entities\AddressType;
use GeneralTrait;
use Modules\Geocode\Resources\AddressResource;
use Modules\Geocode\Http\Controllers\API\Admin\Address\AddressTypeResourceController;
class AddressTypeController extends AddressTypeResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var AddressTypeRepository
     */
    protected $addressTypeRepo;
        /**
     * @var AddressType
     */
    protected $addressType;
    
    /**
     * AddressController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param AddressRepository $addressTypeRepo
     * @param AddressType $addressType
     */
    public function __construct(EloquentRepository $eloquentRepo, AddressType $addressType,AddressTypeRepository $addressTypeRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->addressType = $addressType;
        $this->addressTypeRepo = $addressTypeRepo;
    }

    public function getAddressesType(Request $request,$addressTypeId){
        $AddressesType=$this->addressTypeRepo->getAddressesType($this->addressType,$request,$addressTypeId);
        if(is_string($AddressesType)){
            return customResponse(404);
        }
        $data=AddressResource::collection($AddressesType)->getDataResponse();
        return customResponse(200,$data);

    }
}