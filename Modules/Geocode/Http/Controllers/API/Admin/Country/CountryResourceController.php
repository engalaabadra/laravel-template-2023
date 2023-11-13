<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Country;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\Country\StoreCountryRequest;
use Modules\Geocode\Http\Requests\Country\UpdateCountryRequest;
use Modules\Geocode\Http\Requests\Country\DeleteCountryRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\Country\Resources\CountryRepository;
use Modules\Geocode\Entities\Country;
use GeneralTrait;
use Modules\Geocode\Resources\Admin\CountryResource;
class CountryResourceController extends Controller
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
     * @param CountryRepository $countries
     */
    public function __construct(EloquentRepository $eloquentRepo, Country $country,CountryRepository $countryRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->country = $country;
        $this->countryRepo = $countryRepo;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $countries=$this->countryRepo->all($this->country);
        if(page()) $data=getDataResponse(CountryResource::collection($countries));
        else $data=CountryResource::collection($countries);
        return successResponse(0,$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $country=  $this->countryRepo->store($request->validated(),$this->country);
        if(is_string($country)) return  clientError(0,$country);
        return successResponse(1,new CountryResource($country));
    }

    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $countries=$this->countryRepo->search($this->country,$words,$col);
        if(page()) $data=getDataResponse(countryResource::collection($countries));
        else $data=countryResource::collection($countries);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $countries=$this->countryRepo->trash($this->country);
        if(is_numeric($countries)) return  clientError(4);
        if(page()) $data=getDataResponse(countryResource::collection($countries));
        else $data=countryResource::collection($countries);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreCountryRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $country=  $this->countryRepo->storeTrans($request->validated(),$this->country,$id);
        if(is_numeric($country)) return  clientError(4);
        return successResponse(1,new countryResource($country));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country=$this->countryRepo->show($id,$this->country);
        if(is_numeric($country)) return  clientError(4,$country);
        return successResponse(0,new countryResource($country));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecountryRequest $request,$id)
    {
        $country= $this->countryRepo->update($request->validated(),$this->country,$id);
        if(is_numeric($country)) return  clientError(4,$country);
        return successResponse(2,new countryResource($country));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $country =  $this->countryRepo->restore($id,$this->country);
        if(is_numeric($country)) return  clientError(4);
        return successResponse(5,new countryResource($country));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $countries =  $this->countryRepo->restoreAll($this->country);
        if(is_numeric($countries)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletecountryRequest $request,$id)
    {
        $country= $this->countryRepo->destroy($id,$this->country);
        if(is_numeric($country)) return  clientError(4);
        return successResponse(2,new countryResource($country));  
    }
    public function forceDelete(DeletecountryRequest $request,$id)
    {
        //to make force destroy for a country must be this country  not found in countries table  , must be found in trash Categories
        $country=$this->countryRepo->forceDelete($id,$this->country);
        if(is_numeric($country)) return  clientError(4);
        return successResponse(4);
    }    
}
