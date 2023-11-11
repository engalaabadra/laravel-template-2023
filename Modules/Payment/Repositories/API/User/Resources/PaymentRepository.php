<?php
namespace Modules\Payment\Repositories\User\Resources;

use Modules\Payment\Entities\Payment;
use Modules\Reservation\Entities\Reservation;
use Modules\Payment\Repositories\User\Resources\PaymentRepositoryInterface;
use App\Repositories\EloquentRepository;
use GeneralTrait;
use Modules\Payment\Entities\Traits\PaymentMethods;

class PaymentRepository extends EloquentRepository implements PaymentRepositoryInterface
{
    use GeneralTrait,PaymentMethods;
    public function all($request, $model){
        if(page()) return $this->getPaginatesDataMethod($request, $model);
        else return $this->getAllDataMethod($model);
    }
    

    public function paidReservation($reservationId,$referencePaymentId){
        $reservation = Reservation::where('id',$reservationId)->first();
        if(!$reservation) return 404;
        if($reservation->user_id !== authUser()->id) return trans('messages.This reservation not for you to pay it');
        if($reservation->status=='1') return trans('messages.This reservation has been already paid');
        if($reservation->status=='0') return trans('messages.You cannt pay this reservation , because its canceled');
        if($reservation->is_end=='1') return trans('messages.You cannt pay this reservation , because its completed');
        $reservation->reference_payment_id=$referencePaymentId;
        $reservation->status='1';//paid
        $reservation->save();
        return $reservation;
    }
    

}