<?php
namespace Modules\Wallet\Repositories\User\Additional;

use Modules\Wallet\Repositories\User\Additional\WalletRepositoryInterface;
use Modules\Wallet\Entities\Traits\User\WalletMethods;

class WalletRepository implements WalletRepositoryInterface
{
    use WalletMethods;

    // public function payToReservation($request, $model,$reservationId){
    //     return   $this->payToReservationMethod($model,$reservationId);
    // }
 
   
}
