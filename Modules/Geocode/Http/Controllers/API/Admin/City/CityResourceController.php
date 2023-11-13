<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\City;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\City\StoreCityRequest;
use Modules\Geocode\Http\Requests\City\UpdateCityRequest;
use Modules\Geocode\Http\Requests\City\DeleteCityRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\City\Resources\CityRepository;
use Modules\Geocode\Entities\City;
use GeneralTrait;
use  Modules\Geocode\Resources\Admin\CityResource;
class CityResourceController extends Controller
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
     * CitiesController constructor.
     *
     * @param CityRepository $cities
     */
    public function __construct(EloquentRepository $eloquentRepo, City $city,CityRepository $cityRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->city = $city;
        $this->cityRepo = $cityRepo;
    }
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $cities=$this->cityRepo->all($this->city);
        if(page()) $data=getDataResponse(CityResource::collection($cities));
        else $data=CityResource::collection($cities);
        return successResponse(0,$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        $city=  $this->cityRepo->store($request->validated(),$this->city);
        if(is_string($city)) return  clientError(0,$city);
        return successResponse(1,new CityResource($city));
    }   

    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $countries=$this->cityRepo->search($this->city,$words,$col);
        if(page()) $data=getDataResponse(cityResource::collection($countries));
        else $data=cityResource::collection($countries);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $countries=$this->cityRepo->trash($this->city);
        if(is_numeric($countries)) return  clientError(4);
        if(page()) $data=getDataResponse(cityResource::collection($countries));
        else $data=cityResource::collection($countries);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreCityRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $city=  $this->cityRepo->storeTrans($request->validated(),$this->city,$id);
        if(is_numeric($city)) return  clientError(4);
        return successResponse(1,new cityResource($city));
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
        $city=$this->cityRepo->show($id,$this->city);
        if(is_numeric($city)) return  clientError(4,$city);
        return successResponse(0,new cityResource($city));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecityRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $city= $this->cityRepo->update($request->validated(),$this->city,$id);
        if(is_numeric($city)) return  clientError(4,$city);
        return successResponse(2,new cityResource($city));
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
        $city =  $this->cityRepo->restore($id,$this->city);
        if(is_numeric($city)) return  clientError(4);
        return successResponse(5,new cityResource($city));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $countries =  $this->cityRepo->restoreAll($this->city);
        if(is_numeric($countries)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletecityRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $city= $this->cityRepo->destroy($id,$this->city);
        if(is_numeric($city)) return  clientError(4);
        return successResponse(2,new cityResource($city));  
    }
    public function forceDelete(DeletecityRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        //to make force destroy for a city must be this city  not found in countries table  , must be found in trash Categories
        $city=$this->cityRepo->forceDelete($id,$this->city);
        if(is_numeric($city)) return  clientError(4);
        return successResponse(4);
    }  
}