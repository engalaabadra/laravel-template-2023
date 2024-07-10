<?php

namespace Modules\RequestWithdrawing\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\RequestWithdrawing\Http\Requests\Admin\StoreRequestWithdrawingRequest;
use Modules\RequestWithdrawing\Http\Requests\Admin\UpdateRequestWithdrawingRequest;
use Modules\RequestWithdrawing\Http\Requests\Admin\DeleteRequestWithdrawingRequest;
use App\Repositories\EloquentRepository;
use Modules\RequestWithdrawing\Repositories\Admin\Resources\RequestWithdrawingRepository;
use Modules\RequestWithdrawing\Entities\RequestWithdrawing;
use GeneralTrait;
use Modules\RequestWithdrawing\Resources\Admin\RequestWithdrawingResource;

class RequestWithdrawingResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var RequestWithdrawingRepository
     */
    protected $requestWithdrawingRepo;
        /**
     * @var RequestWithdrawing
     */
    protected $requestWithdrawing;
    
    /**
     * RequestWithdrawingsController constructor.
     *
     * @param RequestWithdrawingRepository $requestWithdrawings
     */
    public function __construct(EloquentRepository $eloquentRepo, RequestWithdrawing $requestWithdrawing,RequestWithdrawingRepository $requestWithdrawingRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->requestWithdrawing = $requestWithdrawing;
        $this->requestWithdrawingRepo = $requestWithdrawingRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $requestWithdrawings=$this->requestWithdrawingRepo->all($this->requestWithdrawing);
        if(page()) $data=getDataResponse(RequestWithdrawingResource::collection($requestWithdrawings));
        else $data=RequestWithdrawingResource::collection($requestWithdrawings);
        return successResponse(0,$data);
    }
     /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $requestWithdrawings=$this->requestWithdrawingRepo->search($this->requestWithdrawing,$words,$col);
        if(page()) $data=getDataResponse(RequestWithdrawingResource::collection($requestWithdrawings));
        else $data=RequestWithdrawingResource::collection($requestWithdrawings);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $requestWithdrawings=$this->requestWithdrawingRepo->trash($this->requestWithdrawing);
        if(is_numeric($requestWithdrawings)) return  clientError(4);
        if(page()) $data=getDataResponse(RequestWithdrawingResource::collection($requestWithdrawings));
        else $data=RequestWithdrawingResource::collection($requestWithdrawings);
        return successResponse(0,$data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requestWithdrawing=$this->requestWithdrawingRepo->show($id,$this->requestWithdrawing);
        if(is_numeric($requestWithdrawing)) return  clientError(4,$requestWithdrawing);
        return successResponse(0,new RequestWithdrawingResource($requestWithdrawing));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $requestWithdrawing =  $this->requestWithdrawingRepo->restore($id,$this->requestWithdrawing);
        if(is_numeric($requestWithdrawing)) return  clientError(4);
        return successResponse(5,new RequestWithdrawingResource($requestWithdrawing));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $requestWithdrawings =  $this->requestWithdrawingRepo->restoreAll($this->requestWithdrawing);
        if(is_numeric($requestWithdrawings)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequestWithdrawingRequest $request,$id)
    {
        $requestWithdrawing= $this->requestWithdrawingRepo->destroy($id,$this->requestWithdrawing);
        if(is_numeric($requestWithdrawing)) return  clientError(4);
        return successResponse(2,new RequestWithdrawingResource($requestWithdrawing));  
    }
    public function forceDelete(DeleteRequestWithdrawingRequest $request,$id)
    {
        //to make force destroy for a requestWithdrawing must be this requestWithdrawing  not found in requestWithdrawings table  , must be found in trash Categories
        $requestWithdrawing=$this->requestWithdrawingRepo->forceDelete($id,$this->requestWithdrawing);
        if(is_numeric($requestWithdrawing)) return  clientError(4);
        return successResponse(4);
    } 
}
