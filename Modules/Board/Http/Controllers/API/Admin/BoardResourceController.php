<?php

namespace Modules\Board\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Board\Http\Requests\StoreBoardRequest;
use Modules\Board\Http\Requests\UpdateBoardRequest;
use Modules\Board\Http\Requests\DeleteBoardRequest;
use App\Repositories\EloquentRepository;
use Modules\Board\Repositories\API\Admin\Resources\BoardRepository;
use Modules\Board\Entities\Board;
use GeneralTrait;
use Modules\Board\Resources\Admin\BoardResource;

class BoardResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var BoardRepository
     */
    protected $boardRepo;
        /**
     * @var Board
     */
    protected $board;
    
    /**
     * BoardsController constructor.
     *
     * @param BoardRepository $boards
     */
    public function __construct(EloquentRepository $eloquentRepo, Board $board,BoardRepository $boardRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->board = $board;
        $this->boardRepo = $boardRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $boards=$this->boardRepo->all($this->board);
        if(page()) $data=getDataResponse(BoardResource::collection($boards));
        else $data=BoardResource::collection($boards);
        return successResponse(0,$data);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardRequest $request)
    {
        $board=  $this->boardRepo->store($request->validated(),$this->board);
        if(is_string($board)) return  clientError(0,$board);
        return successResponse(1,new BoardResource($board));
    }
    
/**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $boards=$this->boardRepo->search($this->board,$words,$col);
        if(page()) $data=getDataResponse(BoardResource::collection($boards));
        else $data=BoardResource::collection($boards);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(){
        $boards=$this->boardRepo->trash($this->board);
        if(is_numeric($boards)) return  clientError(4);
        if(page()) $data=getDataResponse(BoardResource::collection($boards));
        else $data=BoardResource::collection($boards);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StoreboardRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $board=  $this->boardRepo->storeTrans($request->validated(),$this->board,$id);
        if(is_numeric($board)) return  clientError(4);
        return successResponse(1,new BoardResource($board));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $board=$this->boardRepo->show($id,$this->board);
        if(is_numeric($board)) return  clientError(4,$board);
        return successResponse(0,new BoardResource($board));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateboardRequest $request,$id)
    {
        $board= $this->boardRepo->update($request->validated(),$this->board,$id);
        if(is_numeric($board)) return  clientError(4,$board);
        return successResponse(2,new BoardResource($board));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $board =  $this->boardRepo->restore($id,$this->board);
        if(is_numeric($board)) return  clientError(4);
        return successResponse(5,new BoardResource($board));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $boards =  $this->boardRepo->restoreAll($this->board);
        if(is_numeric($boards)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteBoardRequest $request,$id)
    {
        $board= $this->boardRepo->destroy($id,$this->board);
        if(is_numeric($board)) return  clientError(4);
        return successResponse(2,new BoardResource($board));  
    }
    public function forceDelete(DeleteBoardRequest $request,$id)
    {
        //to make force destroy for a board must be this board  not found in boards table  , must be found in trash Categories
        $board=$this->boardRepo->forceDelete($id,$this->board);
        if(is_numeric($board)) return  clientError(4);
        return successResponse(4);
    }    
}
