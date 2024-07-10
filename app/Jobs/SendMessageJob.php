<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Modules\Payment\Traits\PaymentTrait;
use Illuminate\Support\Facades\Mail;
use App\Mail\General;

class SendMessageJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emailData;
    // /**
    //  * Create a new job instance.
    //  */
    // public function __construct($data)
    // {
    //     // $this->emailData = $data;
    // }

    // /**
    //  * Execute the job.
    //  */
    // public function handle(): void
    // {        
        
    //     // Mail::to($this->emailData['email'])->send(new General($this->emailData));  
    //     // if($this->data['type']=='welcome' || $this->data['type']=='check-code' || $this->data['type']=='new-reservation' || $this->data['type']=='cancel-reservation' || $this->data['type']=='reminder-reservation' || $this->data['type']=='rescheduling-reservation'){
            
    //     // } 
    //     return ;
    // }
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->emailData = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->data['type']=='welcome' || $this->data['type']=='check-code' || $this->data['type']=='new-reservation' || $this->data['type']=='cancel-reservation' || $this->data['type']=='reminder-reservation' || $this->data['type']=='rescheduling-reservation'){
            Mail::to($this->emailData['email'])->send(new General($this->emailData));  
        } 
        return ;
    }
}
