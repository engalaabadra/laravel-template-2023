<?php

namespace Modules\Board\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Modules\Board\Repositories\Resources\User\BoardRepository;
use Modules\Board\Entities\Board;
use GeneralTrait;
use Modules\Board\Resources\User\BoardResource;
use Illuminate\Http\Request;

class BoardResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var BoardRepository
     */
    protected $boardRepo;
        /**
     * @var Board
     */
    protected $board;
    
    /**
     * BoardResourceController constructor.
     *
     * @param BoardRepository $boards
     */
    public function __construct( Board $board,BoardRepository $boardRepo)
    {
        $this->board = $board;
        $this->boardRepo = $boardRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $boards=$this->boardRepo->all($request, $this->board);
        if(page()) $data = getDataResponse(BoardResource::collection($boards));
        else $data = BoardResource::collection($boards);
        return successResponse(0,$data);
    }
}
