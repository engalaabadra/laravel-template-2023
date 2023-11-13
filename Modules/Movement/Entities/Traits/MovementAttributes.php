<?php
namespace Modules\Movement\Entities\Traits;
use Modules\Payment\Entities\Payment;
use Modules\Wallet\Entities\Wallet;
trait MovementAttributes{
    
    public function getTypeAttribute(){
        return  intval($this->attributes['type']);
     }
    public function getOriginalTypeAttribute(){
        $value=$this->attributes['type'];
        if($value=='1'){
            return trans('attributes.Deposition');
        }elseif ($value=='-1') {
            return trans('attributes.Withdrawing');
        }
    }
 
}
