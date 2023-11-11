<?php
namespace Modules\Movement\Entities\Traits;
use Modules\Payment\Entities\Payment;
use Modules\Wallet\Entities\Wallet;
use Modules\Reservation\Entities\Reservation;
trait MovementRelations{
    
   
    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
