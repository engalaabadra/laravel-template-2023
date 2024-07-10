<?php

namespace Modules\Payment\Http\Controllers\WEB;

use Illuminate\Routing\Controller;
use Modules\Reservation\Entities\Reservation;
// use Modules\Payment\Traits\PaymentTrait;
use Modules\Reservation\Traits\ReservationTrait;

class PaymentController extends Controller
{
    // use PaymentTrait;
    use ReservationTrait;
    public function paymentProccessFinishing($price,$reservationId,$user){
        //$reservation = $this->paymentProccessFinishingMethod($price,$reservationId,$user);
        $reservation = Reservation::where('id',$reservationId)->first();
        if(!$reservation) return abort(404);

        
        $resultForm = view('payments.form')->with(compact('price','reservationId','user'));
        return $resultForm;
    }
}
