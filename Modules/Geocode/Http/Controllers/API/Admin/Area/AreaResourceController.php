<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\Area;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\Area\StoreAreaRequest;
use Modules\Geocode\Http\Requests\Area\UpdateAreaRequest;
use Modules\Geocode\Http\Requests\Area\DeleteAreaRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\Area\Resources\AreaRepository;
use Modules\Geocode\Entities\Area;
use GeneralTrait;
use Modules\Geocode\Resources\AreaResource;
class AreaResourceController extends Controller
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
     * @param AreaRepository $areas
     */
    public function __construct(EloquentRepository $eloquentRepo, Area $area,AreaRepository $areaRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->area = $area;
        $this->areaRepo = $areaRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $areas=$this->areaRepo->all($this->area);
        if(page()) $data=getDataResponse(AreaResource::collection($areas));
        else $data=AreaResource::collection($areas);
        return successResponse(0,$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaRequest $request)
    {
        $area=  $this->areaRepo->store($request->validated(),$this->area);
        if(is_string($area)) return  clientError(0,$area);
        return successResponse(1,new AreaResource($area));
    }
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $areas=$this->areaRepo->search($this->area,$words,$col);
        if(page()) $data=getDataResponse(AreaResource::collection($areas));
        else $data=AreaResource::collection($areas);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $areas=$this->areaRepo->trash($this->area);
        if(is_numeric($areas)) return  clientError(4);
        if(page()) $data=getDataResponse(AreaResource::collection($areas));
        else $data=AreaResource::collection($areas);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreAreaRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $area=  $this->areaRepo->storeTrans($request->validated(),$this->area,$id);
        if(is_numeric($area)) return  clientError(4);
        return successResponse(1,new AreaResource($area));
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
        $area=$this->areaRepo->show($id,$this->area);
        if(is_numeric($area)) return  clientError(4,$area);
        return successResponse(0,new AreaResource($area));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $area= $this->areaRepo->update($request->validated(),$this->area,$id);
        if(is_numeric($area)) return  clientError(4,$area);
        return successResponse(2,new AreaResource($area));
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
        $area =  $this->areaRepo->restore($id,$this->area);
        if(is_numeric($area)) return  clientError(4);
        return successResponse(5,new AreaResource($area));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $areas =  $this->areaRepo->restoreAll($this->area);
        if(is_numeric($areas)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteAreaRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $area= $this->areaRepo->destroy($id,$this->area);
        if(is_numeric($area)) return  clientError(4);
        return successResponse(2,new AreaResource($area));  
    }
    public function forceDelete(DeleteAreaRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        //to make force destroy for a area must be this area  not found in areas table  , must be found in trash Categories
        $area=$this->areaRepo->forceDelete($id,$this->area);
        if(is_numeric($area)) return  clientError(4);
        return successResponse(4);
    }  
}
