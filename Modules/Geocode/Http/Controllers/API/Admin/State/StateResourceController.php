<?php

namespace Modules\Geocode\Http\Controllers\API\Admin\State;
use App\Http\Controllers\Controller;
use Modules\Geocode\Http\Requests\State\StoreStateRequest;
use Modules\Geocode\Http\Requests\State\UpdateStateRequest;
use Modules\Geocode\Http\Requests\State\DeleteStateRequest;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Modules\Geocode\Repositories\API\Admin\State\Resources\StateRepository;
use Modules\Geocode\Entities\State;
use GeneralTrait;
use Modules\Geocode\Resources\StateResource;
class StateResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var StateRepository
     */
    protected $stateRepo;
        /**
     * @var State
     */
    protected $state;
    
    /**
     * StateController constructor.
     *
     * @param StateRepository $states
     */
    public function __construct(EloquentRepository $eloquentRepo, State $state,StateRepository $stateRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->state = $state;
        $this->stateRepo = $stateRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $states=$this->stateRepo->all($this->state);
        if(page()) $data=getDataResponse(StateResource::collection($states));
        if(is_numeric($states)) return  clientError(4);
        else $data=StateResource::collection($states);
        return successResponse(0,$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStateRequest $request)
    {
        $state=  $this->stateRepo->store($request->validated(),$this->state);
        if(is_string($state)) return  clientError(0,$state);
        return successResponse(1,new StateResource($state));
    }

    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $countries=$this->stateRepo->search($this->state,$words,$col);
        if(page()) $data=getDataResponse(StateResource::collection($countries));
        else $data=StateResource::collection($countries);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $countries=$this->stateRepo->trash($this->state);
        if(is_numeric($countries)) return  clientError(4);
        if(page()) $data=getDataResponse(StateResource::collection($countries));
        else $data=StateResource::collection($countries);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreStateRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $state=  $this->stateRepo->storeTrans($request->validated(),$this->state,$id);
        return successResponse(1,new StateResource($state));
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
        $state=$this->stateRepo->show($id,$this->state);
        if(is_numeric($state)) return  clientError(4,$state);
        return successResponse(0,new StateResource($state));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStateRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $state= $this->stateRepo->update($request->validated(),$this->state,$id);
        if(is_numeric($state)) return  clientError(4,$state);
        return successResponse(2,new StateResource($state));
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
        $state =  $this->stateRepo->restore($id,$this->state);
        if(is_numeric($state)) return  clientError(4);
        return successResponse(5,new StateResource($state));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $countries =  $this->stateRepo->restoreAll($this->state);
        if(is_numeric($countries)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteStateRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $state= $this->stateRepo->destroy($id,$this->state);
        if(is_numeric($state)) return  clientError(4);
        return successResponse(2,new StateResource($state));  
    }
    public function forceDelete(DeleteStateRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        //to make force destroy for a state must be this state  not found in countries table  , must be found in trash Categories
        $state=$this->stateRepo->forceDelete($id,$this->state);
        if(is_numeric($state)) return  clientError(4);
        return successResponse(4);
    }  
}
