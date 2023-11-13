<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Address;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\Address\StoreAddressRequest;
use Modules\Geocode\Http\Requests\Address\UpdateAddressRequest;
use Modules\Geocode\Http\Requests\Address\DeleteAddressRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\Address\Resources\AddressRepository;
use Modules\Geocode\Entities\Address;
use GeneralTrait;
use Modules\Geocode\Resources\AddressResource;
class AddressResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var AddressRepository
     */
    protected $addressRepo;
        /**
     * @var Address
     */
    protected $address;
    
    /**
     * AddressController constructor.
     *
     * @param AddressRepository $addresses
     */
    public function __construct(EloquentRepository $eloquentRepo, Address $address,AddressRepository $addressRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->address = $address;
        $this->addressRepo = $addressRepo;
    }
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $addresses=$this->addressRepo->all($this->address);
        if(page()) $data=getDataResponse(AddressResource::collection($addresses));
        else $data=AddressResource::collection($addresses);
        return successResponse(0,$data);
    }
    /**
     * Store a newly cddressted resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $address=  $this->addressRepo->store($request->validated(),$this->address);
        if(is_string($address)) return  clientError(0,$address);
        return successResponse(1,new AddressResource($address));
    }

     /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $addresses=$this->addressRepo->search($this->address,$words,$col);
        if(page()) $data=getDataResponse(AddressResource::collection($addresses));
        else $data=AddressResource::collection($addresses);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $addresses=$this->addressRepo->trash($this->address);
        if(is_numeric($addresses)) return  clientError(4);
        if(page()) $data=getDataResponse(AddressResource::collection($addresses));
        else $data=AddressResource::collection($addresses);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreAddressRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $address=  $this->addressRepo->storeTrans($request->validated(),$this->address,$id);
        if(is_numeric($address)) return  clientError(4);
        return successResponse(1,new AddressResource($address));
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
        $address=$this->addressRepo->show($id,$this->address);
        if(is_numeric($address)) return  clientError(4,$address);
        return successResponse(0,new AddressResource($address));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $address= $this->addressRepo->update($request->validated(),$this->address,$id);
        if(is_numeric($address)) return  clientError(4,$address);
        return successResponse(2,new AddressResource($address));
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
        $address =  $this->addressRepo->restore($id,$this->address);
        if(is_numeric($address)) return  clientError(4);
        return successResponse(5,new AddressResource($address));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $addresses =  $this->addressRepo->restoreAll($this->address);
        if(is_numeric($addresses)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteAddressRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $address= $this->addressRepo->destroy($id,$this->address);
        if(is_numeric($address)) return  clientError(4);
        return successResponse(2,new AddressResource($address));  
    }
    public function forceDelete(DeleteAddressRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        //to make force destroy for a address must be this address  not found in addresses table  , must be found in trash Categories
        $address=$this->addressRepo->forceDelete($id,$this->address);
        if(is_numeric($address)) return  clientError(4);
        return successResponse(4);
    }  
}
