<?php

namespace Modules\Payment\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Payment\Repositories\User\Resources\PaymentRepository;
use Modules\Payment\Entities\Payment;
use GeneralTrait;
use Modules\Payment\User\Resources\PaymentResource;
class PaymentResourceController extends Controller
{
    use GeneralTrait;
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $payments=$this->paymentRepo->all($request, $this->payment);
        if(page()) $data=getDataResponse(PaymentResource::collection($payments));
        else $data=PaymentResource::collection($payments);
        return customResponse(200,$data);
    }
}
