<?php

namespace Modules\Chat\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Profile\Resources\ProfileDoctorResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'credentials' => [
                'app_id'=>config('services.pusher.app_id'),
                'app_key'=>config('services.pusher.app_key'),
                'app_secret'=>config('services.pusher.app_secret'),
                'app_cluster'=>config('services.pusher.app_cluster'),
                'event'=>'MessageCreated',
                'chanel_name'=>'Message.User.'.$this->user_id. '.Doctor.' . $this->doctor_id
            ],
            'id'   => $this->id,
            'body'      => $this->body,
            'user'      => $this->user ? $this->user :null,
            'doctor'=> ProfileDoctorResource::make($this->doctor),
            'sender_id'      => $this->sender_id,
            'recipient_id'      => $this->recipient_id,
            'image'      => $this->image,
            'time'=>$this->created_at
            
        ];
    }
}
