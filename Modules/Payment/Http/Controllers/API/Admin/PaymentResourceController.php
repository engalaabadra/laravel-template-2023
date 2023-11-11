<?php

namespace Modules\Payment\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Payment\Http\Requests\StorePaymentRequest;
use Modules\Payment\Http\Requests\UpdatePaymentRequest;
use Modules\Payment\Http\Requests\DeletePaymentRequest;
use App\Repositories\EloquentRepository;
use Modules\Payment\Repositories\API\Admin\Resources\PaymentRepository;
use Modules\Payment\Entities\Payment;
use GeneralTrait;
use Modules\Payment\Resources\Admin\PaymentResource;

class PaymentResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var PaymentRepository
     */
    protected $paymentRepo;
        /**
     * @var Payment
     */
    protected $payment;
    
    /**
     * PaymentsController constructor.
     *
     * @param PaymentRepository $payments
     */
    public function __construct(EloquentRepository $eloquentRepo, Payment $payment,PaymentRepository $paymentRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->payment = $payment;
        $this->paymentRepo = $paymentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $payments=$this->paymentRepo->all($this->payment);
        if(page()) $data=getDataResponse(PaymentResource::collection($payments));
        else $data=PaymentResource::collection($payments);
        return successResponse(0,$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $payment=  $this->paymentRepo->store($request,$this->payment);
        if(is_string($payment)) return  clientError(0,$payment);
        return successResponse(1,new PaymentResource($payment));
    }
    
    /**
     * Display a listing of the resource via pagintation from search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($words,$col=null){
        $payments=$this->paymentRepo->search($this->payment,$words,$col);
        if(page()) $data=getDataResponse(PaymentResource::collection($payments));
        else $data=PaymentResource::collection($payments);
        return successResponse(0,$data);
    }
    /**
     * Display a listing of the resource (all , pagination) from trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request){
        $payments=$this->paymentRepo->trash($this->payment,$request);
        if(is_numeric($payments)) return  clientError(4);
        if(page()) $data=getDataResponse(PaymentResource::collection($payments));
        else $data=PaymentResource::collection($payments);
        return successResponse(0,$data);
    }

   
    public function storeTrans(StorepaymentRequest $request,$id)
    {
        if(!is_numeric($id)) return clientError(0);
        $payment=  $this->paymentRepo->storeTrans($request->validated(),$this->payment,$id);
        if(is_numeric($payment)) return  clientError(4);
        return successResponse(1,new PaymentResource($payment));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment=$this->paymentRepo->show($id,$this->payment);
        if(is_numeric($payment)) return  clientError(4,$payment);
        return successResponse(0,new PaymentResource($payment));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepaymentRequest $request,$id)
    {
        $payment= $this->paymentRepo->update($request->validated(),$this->payment,$id);
        if(is_numeric($payment)) return  clientError(4,$payment);
        return successResponse(2,new PaymentResource($payment));
    }
    /**
     * Restore the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $payment =  $this->paymentRepo->restore($id,$this->payment);
        if(is_numeric($payment)) return  clientError(4);
        return successResponse(5,new PaymentResource($payment));
    }
    /**
     * Restore All.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(){
        $payments =  $this->paymentRepo->restoreAll($this->payment);
        if(is_numeric($payments)) return  clientError(4);
        return successResponse(5);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletepaymentRequest $request,$id)
    {
        $payment= $this->paymentRepo->destroy($id,$this->payment);
        if(is_numeric($payment)) return  clientError(4);
        return successResponse(2,new PaymentResource($payment));  
    }
    public function forceDelete(DeletepaymentRequest $request,$id)
    {
        //to make force destroy for a payment must be this payment  not found in payments table  , must be found in trash Categories
        $payment=$this->paymentRepo->forceDelete($id,$this->payment);
        if(is_numeric($payment)) return  clientError(4);
        return successResponse(4);
    }

}