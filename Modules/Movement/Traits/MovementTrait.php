<?php
namespace Modules\Movement\Traits;
use GeneralTrait;
use Modules\Movement\Entities\Movement;
use Modules\Reservation\Entities\Reservation;

trait MovementTrait{
    use GeneralTrait;

    public function createMovement($model,$price,$id,$nameMovement,$type,$reservation_id=null){
        $movementWallet=new Movement;
        if($reservation_id) $reservation = Reservation::where('id',$reservation_id)->first();  
        if(is_string($model)){
            $movementWallet->name=$nameMovement;
            $movementWallet->original_value=$price;
            if($reservation_id) $movementWallet->reservation_id=$reservation->id;

        }else{
            $wallet = $this->find($model,$id,'user_id');
            $movementWallet->wallet_id=$wallet->id; 
            $movementWallet->name=$nameMovement;
            $movementWallet->original_value=$price;
            if($type=='1'){//Deposition
                $movementWallet->balance_before=$wallet->balance-$price;
                $movementWallet->balance_after=$wallet->balance;
                if($reservation_id) $movementWallet->reservation_id=$reservation->id;
            }elseif($type=='-1'){//withdrawing
                $movementWallet->balance_before=$wallet->balance+$price;
                $movementWallet->balance_after=$wallet->balance;
                if($reservation_id) $movementWallet->reservation_id=$reservation->id;

            } 
        }

        $movementWallet->type=$type;
        $movementWallet->save();  
    }
}

