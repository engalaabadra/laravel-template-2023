<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\Reservation\Entities\Reservation;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\Traits\User\WalletMethods;
use Modules\Reservation\Traits\ReservationTrait;
use App\Services\SendingNotificationsService;
use App\Services\SendingMessagesService;
use Modules\Payment\Traits\PaymentTrait;
use Modules\Movement\Traits\MovementTrait;
use Modules\Auth\Entities\User;
use Modules\Wallet\Traits\User\WalletTrait;
use Modules\Payment\Entities\PaymentLog;

class PaymentMethodService{
        use ReservationTrait,PaymentTrait,MovementTrait,WalletMethods,WalletTrait;

    public function getDataPayment(){
        $token=getTokenPayment();
        $payment=Http::baseUrl('https://api.moyasar.com/v1')
                    ->withBasicAuth(config("services.moyasar.key_live"),'')
                    ->get('payments/{$id}')
                    ->json();
        return $payment;
    }
    public function getCapturePayment(){
        $capture = Http::baseUrl('https://api.moyasar.com/v1')
                    ->withHeaders([
                        'Authorization' => 'Basic {$token}',
                    ])
                    ->post('payments/{$id}/capture')
                    ->json();
        return $capture;

    }

    public function getStatusTap($tapId){
        $url = "https://api.tap.company/v2/charges/".$tapId;
        $header = array(config('services.tap.secret'),'accept : application/json');
        $data = $this->curl($url, $method = 'get', $header, $postdata = null, $timeout = 60);
       $status = json_decode($data)->status;
       if ($status == "CAPTURED"){
           return response()->json(['status' => true]);
       }
       return response()->json(['status' => false]);
    }
    public function dataPaymentCallback(){
        $headers= [
            "Content-Type:application/json",
            config('services.tap.secret'),
        ];
        
         
        $ch=curl_init();
        $url="https://api.tap.company/v2/charges/".tapId();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);
        $response=json_decode($output);
        if($response&&isset($response->errors)){
         return $response->errors;
        }
        return $response;

    }
    public function callback(){//type=1 : reservation , type=2 : wallet
        $response = $this->dataPaymentCallback();
        if(isset($response->errors)) return $response->errors;
        // $paymentLog = PaymentLog::create(['reservation_id'=>$reservationId,'transaction_id'=>$response->id,'customer_id'=>$response->customer->id,'source'=>json_encode($response->source),'status'=>$response->status]);
        if($response->status == 'CAPTURED'){
            //paid
            //$this->paid();

            //send notification
           // app(SendingNotificationsService::class)->sendNotification();

            $capture = Http::baseUrl('https://api.moyasar.com/v1')
                    ->withHeaders([
                        'Authorization' => 'Basic {$token}',
                    ])
                    ->post('payments/{$id}/capture')
                    ->json();

            //send to email
            //app(SendingMessagesService::class)->sendingMessage();

            //add a movement
            //$this->createMovement();
    
        }else{
            return $response->status;
        }
                
            
    }
    public function callbackWallet(){
        $response = $this->dataPaymentCallback();
        if(isset($response->errors)) return $response->errors;
        // $paymentLog = PaymentLog::create(['wallet_id'=>$wallet->id,'transaction_id'=>$response->id,'customer_id'=>$response->customer->id,'source'=>json_encode($response->source),'status'=>$response->status]);

        if($response->status == 'CAPTURED'){
            //add into wallet
        //    $this->addIntoWalletCallback();

        $capture = Http::baseUrl('https://api.moyasar.com/v1')
                ->withHeaders([
                    'Authorization' => 'Basic {$token}',
                ])
                ->post('payments/{$id}/capture')
                ->json();

        }else{
            return $response->status;
        } 
    }
    
    

}
