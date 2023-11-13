<?php
namespace Modules\Payment\Traits;

trait PaymentTrait{
    public function setDataPayment($id,$data,$totalPrice){
        $user=authUser();
        $data['amount']= $totalPrice;
        $data['currency']= systemCurrency();
        $data['customer']['first_name']= $user ? $user->full_name : null;
        $email = $user ? $user->email : null;
        if(!$email){
            $email = $user ? $user->full_name.' '.'#'.$id.'@template.net' : null;
        }
        $data['customer']['email']= $email;
        // ra@gmail.com
        $data['customer']['phone']['number']= $user ? $user->phone_no : null;
        $data['source']['id']= "src_all";

        $headers= [
            "Content-Type:application/json",
            config('services.tap.secret'), 
        ];

        $ch=curl_init();
        $url="https://api.tap.company/v2/charges";
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);
        $response=json_decode($output);
        if($response&&isset($response->errors)){
            return $response;
        }
            return $response->transaction->url;
    }

    public function paymentProcessMethodReservation($id,$totalPrice){
        $data['redirect']['url']= url(route("api.payments.callback",[$id]));
        return $this->setDataPayment($id,$data,$totalPrice);

    }
    
    public function paymentProcessMethodWallet($id,$totalPrice){
        $data['redirect']['url']= url(route("api.payments.callback-wallet",[$id,$totalPrice]));
        return $this->setDataPayment($id,$data,$totalPrice+ precentageTemplate($totalPrice));
    }

    public function paymentProccessFinishingMethod($price,$reservationId,$user){  
        $reservation = Reservation::where('id',$reservationId)->first();
        if(!$reservation) return abort(404);
        //check if this reservation until now available it time(no reservation in this time)
        //if exit another reservation in same time and status it paid will return a msg and delete this reservation , because exist another reservation in same time and paid
        //1. get all reservations have same appointment this reservation , start_time, end_time, date
        $reservationsSameTime = Reservation::where(['appointment_id'=>$reservation->appointment_id,'start_time'=>$reservation->start_time,'end_time'=>$reservation->end_time,'date'=>$reservation->date])->where('id','!=',$reservationId)->get();
        if($reservationsSameTime){
            foreach($reservationsSameTime as $reservationSameTime){
                //check if this reservation is paid 
                if($reservationSameTime->status!=='-1'){//exist a nother reservation in same time
                    $data=['message'=>trans('messages.you cannt pay this reservation , because became this time reserved by another patient and paid it')];
		            return view('messages',$data);
                }
            }
        }
        return $reservation;
    }
    public function curl($url, $method = 'get', $header = null, $postdata = null, $timeout = 60)
	{
        $s = curl_init();
        // initialize curl handler 
        curl_setopt($s,CURLOPT_URL, $url);
        //set option  URL of the location 
        if ($header) 
            curl_setopt($s,CURLOPT_HTTPHEADER, $header);
            //set headers if presents
        	curl_setopt($s,CURLOPT_TIMEOUT, $timeout);
            //time out of the curl handler  		
            curl_setopt($s,CURLOPT_CONNECTTIMEOUT, $timeout);
            //time out of the curl socket connection closing 
            curl_setopt($s,CURLOPT_MAXREDIRS, 3);
            //set maximum URL redirections to 3 
            curl_setopt($s,CURLOPT_RETURNTRANSFER, true);
            // set option curl to return as string ,don't output directly
            curl_setopt($s,CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($s,CURLOPT_COOKIEJAR, 'cookie.txt');
            curl_setopt($s,CURLOPT_COOKIEFILE, 'cookie.txt'); 
            //set a cookie text file, make sure it is writable chmod 777 permission to cookie.txt
        if(strtolower($method) == 'post')
        {
            curl_setopt($s,CURLOPT_POST, true);
            //set curl option to post method
            curl_setopt($s,CURLOPT_POSTFIELDS, $postdata);
            //if post data present send them.
        }
        else if(strtolower($method) == 'delete')
        {
            curl_setopt($s,CURLOPT_CUSTOMREQUEST, 'DELETE');
            //file transfer time delete
        }
        else if(strtolower($method) == 'put')
        {
            curl_setopt($s,CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($s,CURLOPT_POSTFIELDS, $postdata);
            //file transfer to post ,put method and set data
        }
            curl_setopt($s,CURLOPT_HEADER, 0);			 
            // curl send header 
            curl_setopt($s,CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1');
            //proxy as Mozilla browser 
            curl_setopt($s, CURLOPT_SSL_VERIFYPEER, false);
            // don't need to SSL verify ,if present it need openSSL PHP extension
            $html = curl_exec($s);
            //run handler
            $status = curl_getinfo($s, CURLINFO_HTTP_CODE);
            // get the response status
            curl_close($s);
            //close handler
            return $html;
            //return output
    }
}
