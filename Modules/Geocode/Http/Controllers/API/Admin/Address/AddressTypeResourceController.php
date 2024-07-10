<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Address;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\AddressType\StoreAddressTypeRequest;
use Modules\Geocode\Http\Requests\AddressType\UpdateAddressTypeRequest;
use Modules\Geocode\Http\Requests\AddressType\DeleteAddressTypeRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\AddressType\Resources\AddressTypeRepository;
use Modules\Geocode\Entities\AddressType;
use GeneralTrait;
use Modules\Geocode\Resources\AddressTypeResource;
class AddressTypeResourceController extends Controller
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
     * @param AddressTypeRepository $addressTypees
     */
    public function __construct(EloquentRepository $eloquentRepo, AddressType $addressType,AddressTypeRepository $addressTypeRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->addressType = $addressType;
        $this->addressTypeRepo = $addressTypeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $typesAddresses=$this->addressTypeRepo->all($this->addressType);
        if(page()) $data=getDataResponse(AddressTypeResource::collection($typesAddresses));
        else $data=AddressTypeResource::collection($typesAddresses);
        return successResponse(0,$data);
    }
    /**
     * Store a newly cddressted resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressTypeRequest $request)
    {
        $addressType=  $this->addressTypeRepo->store($request->validated(),$this->addressType);
        if(is_string($addressType)) return  clientError(0,$addressType);
        return successResponse(1,new AddressTypeResource($addressType));
    }

   /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $addressTypes=$this->addressTypeRepo->search($this->addressType,$words,$col);
        if(page()) $data=getDataResponse(AddressTypeResource::collection($addressTypes));
        else $data=AddressTypeResource::collection($addressTypes);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $addressTypes=$this->addressTypeRepo->trash($this->addressType);
        if(is_numeric($addressTypes)) return  clientError(4);
        if(page()) $data=getDataResponse(AddressTypeResource::collection($addressTypes));
        else $data=AddressTypeResource::collection($addressTypes);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreAddressTypeRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $addressType=  $this->addressTypeRepo->storeTrans($request->validated(),$this->addressType,$id);
        if(is_numeric($addressType)) return  clientError(4);
        return successResponse(1,new AddressTypeResource($addressType));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!is_numeric($id)) return clientError(0);
        $addressType=$this->addressTypeRepo->show($id,$this->addressType);
        if(is_numeric($addressType)) return  clientError(4,$addressType);
        return successResponse(0,new AddressTypeResource($addressType));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressTypeRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $addressType= $this->addressTypeRepo->update($request->validated(),$this->addressType,$id);
        if(is_numeric($addressType)) return  clientError(4,$addressType);
        return successResponse(2,new AddressTypeResource($addressType));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        if(!is_numeric($id)) return clientError(0);
        $addressType =  $this->addressTypeRepo->restore($id,$this->addressType);
        if(is_numeric($addressType)) return  clientError(4);
        return successResponse(5,new AddressTypeResource($addressType));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $addressTypes =  $this->addressTypeRepo->restoreAll($this->addressType);
        if(is_numeric($addressTypes)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteAddressTypeRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $addressType= $this->addressTypeRepo->destroy($id,$this->addressType);
        if(is_numeric($addressType)) return  clientError(4);
        return successResponse(2,new AddressTypeResource($addressType));  
    }
    public function forceDelete(DeleteAddressTypeRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        //to make force destroy for a addressType must be this addressType  not found in addressTypes table  , must be found in trash Categories
        $addressType=$this->addressTypeRepo->forceDelete($id,$this->addressType);
        if(is_numeric($addressType)) return  clientError(4);
        return successResponse(4);
    }  
}
