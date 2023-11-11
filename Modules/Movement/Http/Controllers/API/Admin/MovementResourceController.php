<?php

namespace Modules\Movement\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Movement\Http\Requests\StoreMovementRequest;
use Modules\Movement\Http\Requests\UpdateMovementRequest;
use Modules\Movement\Http\Requests\DeleteMovementRequest;
use App\Repositories\EloquentRepository;
use Modules\Movement\Repositories\Admin\Resources\MovementRepository;
use Modules\Movement\Entities\Movement;
use GeneralTrait;
use Modules\Movement\Resources\Admin\MovementResource;

class MovementResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var MovementRepository
     */
    protected $movementRepo;
        /**
     * @var Movement
     */
    protected $movement;
    
    /**
     * MovementsController constructor.
     *
     * @param MovementRepository $movements
     */
    public function __construct(EloquentRepository $eloquentRepo, Movement $movement,MovementRepository $movementRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->movement = $movement;
        $this->movementRepo = $movementRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $movements=$this->movementRepo->all($this->movement);
        if(page()) $data=getDataResponse(MovementResource::collection($movements));
        else $data=MovementResource::collection($movements);
        return successResponse(0,$data);
    }
     /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $movements=$this->movementRepo->search($this->movement,$words,$col);
        if(page()) $data=getDataResponse(MovementResource::collection($movements));
        else $data=MovementResource::collection($movements);
        return successResponse(0,$data);
    }
 /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $movements=$this->movementRepo->trash($this->movement);
        if(is_numeric($movements)) return  clientError(4);
        if(page()) $data=getDataResponse(MovementResource::collection($movements));
        else $data=MovementResource::collection($movements);
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
        $movement=$this->movementRepo->show($id,$this->movement);
        if(is_numeric($movement)) return  clientError(4,$movement);
        return successResponse(0,new MovementResource($movement));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $movement =  $this->movementRepo->restore($id,$this->movement);
        if(is_numeric($movement)) return  clientError(4);
        return successResponse(5,new MovementResource($movement));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $movements =  $this->movementRepo->restoreAll($this->movement);
        if(is_numeric($movements)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteMovementRequest $request,$id)
    {
        $movement= $this->movementRepo->destroy($id,$this->movement);
        if(is_numeric($movement)) return  clientError(4);
        return successResponse(2,new MovementResource($movement));  
    }
    public function forceDelete(DeleteMovementRequest $request,$id)
    {
        //to make force destroy for a movement must be this movement  not found in movements table  , must be found in trash Categories
        $movement=$this->movementRepo->forceDelete($id,$this->movement);
        if(is_numeric($movement)) return  clientError(4);
        return successResponse(4);
    } 
}
