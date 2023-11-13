<?php
namespace Modules\RequestWithdrawing\Entities\Traits;
use Modules\Wallet\Entities\Wallet;
trait RequestWithdrawingRelations{
    
    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
}
