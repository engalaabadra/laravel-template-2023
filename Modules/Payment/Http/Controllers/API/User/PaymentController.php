<?php

namespace Modules\Payment\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Modules\Payment\Repositories\User\Additionals\PaymentRepository;
use Modules\Payment\Entities\Payment;
use GeneralTrait;
use Modules\Payment\Resources\User\PaymentResource;
use Modules\Reservation\Entities\Reservation;
use Modules\Reservation\Resources\User\ReservationResource;
use PaymentMethodService;
use Modules\Payment\Traits\PaymentTrait;
class PaymentController extends Controller
{
    use GeneralTrait,PaymentTrait;
    /**
     * @var PaymentRepository
     */
    protected $paymentRepo;
        /**
     * @var Payment
     */
    protected $payment;
    
    /**
     * PaymentResourceController constructor.
     *
     * @param PaymentRepository $payments
     */
    public function __construct( Payment $payment,PaymentRepository $paymentRepo)
    {
        $this->payment = $payment;
        $this->paymentRepo = $paymentRepo;
    }

    public function statusTap($tapId){
        return app(PaymentMethodService::class)->getStatusTap($tapId);      

    }
     /**
     * callback method.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback($reservationId){
        $resultCallback = app(PaymentMethodService::class)->callback($reservationId);
        if(is_string($resultCallback)) return clientError(0,$resultCallback);
        return successResponse(0,$resultCallback);
    }

    public function callbackWallet($walletId,$price){
        $resultCallbackWallet = app(PaymentMethodService::class)->callbackWallet($walletId,$price);
        if(is_string($resultCallbackWallet)) return clientError(0,$resultCallbackWallet);
        return successResponse(0,$resultCallbackWallet);
    }

    /**
     * paidReservation method.
     *
     * @return \Illuminate\Http\Response
     */
    public function paidReservation($reservationId,$referencePaymentId){
        $resultPaidReservation = $this->paymentRepo->paidReservation($reservationId,$referencePaymentId);      
        if(is_numeric($resultPaidReservation)) return clientError(4);
        if(is_string($resultPaidReservation)) return clientError(0,$resultPaidReservation);
        return successResponse(2,new ReservationResource($resultPaidReservation));
    }
}
