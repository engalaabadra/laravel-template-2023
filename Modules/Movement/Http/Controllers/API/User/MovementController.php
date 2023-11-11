<?php

namespace Modules\Movement\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Movement\Repositories\User\Additional\MovementRepository;
use Modules\Reservation\Entities\Reservation;
use GeneralTrait;
use Modules\Movement\Resources\User\MovementResource;
class MovementController extends Controller
{
    use GeneralTrait;
    /**
     * @var MovementRepository
     */
    protected $movementRepo;
        /**
     * @var Reservation
     */
    protected $reservation;
    
    /**
     * MovementController constructor.
     *
     * @param MovementRepository $movements
     */
    public function __construct( Reservation $reservation,MovementRepository $movementRepo)
    {
        $this->reservation = $reservation;
        $this->movementRepo = $movementRepo;
    }


}
