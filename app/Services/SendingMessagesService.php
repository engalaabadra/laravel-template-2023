<?php

namespace App\Services;

use App\Jobs\ExternalApiJob;
use App\Mail\SendingMessage;
use Nexmo\Laravel\Facade\Nexmo;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Http;
use Modules\Payment\Traits\PaymentTrait;
use App\Jobs\SendMessageJob;
// use Illuminate\Support\Facades\Mail;

class SendingMessagesService
{
    use PaymentTrait;
    protected $username;
    protected $password;
    protected $api;
    protected $sender;

    public function __construct()
    {
        $this->username = config('services.msegat.username');
        $this->password = config('services.msegat.password');
        $this->api = 'https://www.msegat.com/gw/sendsms.php';
        $this->sender = 'Template';
    }
    public function sendToEmail($data)
    {
        dispatch(new SendMessageJob($data));
    }

    public function sendToPhone($data,$msg)
    {
        $response = Http::post($this->api, [
            'userName' => $this->username,
            'apiKey' => $this->password,
            'numbers' => $data['phone_no'],
            'userSender' => $this->sender,
            'msg' => $msg,
        ]);

        if ($response->ok()) {
            // SMS sent successfully
            return true;
        }
        // SMS sending failed
        return false;
    }


    public function sendToPhoneWattsapp($phone_no, $message)
    {
        

    }

    public function sendMessage($data,$msg)
    {
        if (isset($data['email'])) {
            $this->sendToEmail($data);
        }
        if (isset($data['phone_no'])) {
            //send to phone_no
            $this->sendToPhone($data,$msg);
            //  $this->sendToPhoneWattsapp($user->phone_no,$message);
        }
        return true;
    }

    public function sendingMessage($data,$msg=null)
    {
        $resultSending = $this->sendMessage($data,$msg);
        if (!$resultSending) return serverError(0);
        return $resultSending;
    }
}
