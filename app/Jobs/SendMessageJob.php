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

class SendMessageJob implements ShouldQueue
{
    use PaymentTrait;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {        
        if($this->data['type']=='welcome' || $this->data['type']=='check-code' || $this->data['type']=='new-reservation' || $this->data['type']=='cancel-reservation' || $this->data['type']=='reminder-reservation' || $this->data['type']=='rescheduling-reservation'){
            Mail::to($this->email)->send(new General($this));  
            
        } 
        return ;
    }
}
