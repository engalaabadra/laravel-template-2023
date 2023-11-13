<?php
namespace Modules\Payment\Repositories\API\Admin\Resources;

use App\Repositories\EloquentRepository;
use Modules\Payment\Repositories\API\Admin\Resources\PaymentRepositoryInterface;
use Modules\Payment\Entities\Traits\Admin\PaymentMethods;
use GeneralTrait;

class PaymentRepository extends EloquentRepository implements PaymentRepositoryInterface
{
    use PaymentMethods,GeneralTrait;
    
    public function store($request,$model){
        $user = $this->actionMethod($request,$model);
        return $user;
    }
    public function storeTrans($request,$model,$id){
        $payment = $this->actionMethod($request,$model,$id);
        return $payment;
    }

    public function update($request,$model,$id){
        $payment = $this->actionMethod($request,$model,$id);
        return $payment;
    }
}
