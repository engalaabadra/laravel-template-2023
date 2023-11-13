<?php

namespace Modules\Movement\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Movement\Repositories\User\Resources\MovementRepository;
use Modules\Movement\Entities\Movement;
use GeneralTrait;
use Modules\Movement\Resources\User\MovementResource;
use Modules\Movement\Http\Requests\AddToMovementRequest;
use Modules\Movement\Http\Requests\DeleteFromMovementRequest;
class MovementResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var MovementRepository
     */
    protected $movementRepo;
        /**
     * @var Movement
     */
    protected $movement;
    
    /**
     * MovementResourceController constructor.
     *
     * @param MovementRepository $movements
     */
    public function __construct( Movement $movement,MovementRepository $movementRepo)
    {
        $this->movement = $movement;
        $this->movementRepo = $movementRepo;
    }
    /**
     * Display a listing of the resource via (all , pagination).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $movements = $this->movementRepo->all($request,$this->movement);
        if(page()) $data=getDataResponse(MovementResource::collection($movements));
        else $data=MovementResource::collection($movements);
        return successResponse(0,$data);
    }
}
