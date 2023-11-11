<?php

namespace Modules\Wallet\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use GeneralTrait;
use Modules\Profile\Resources\ProfileDoctorResource;

class WalletResource extends JsonResource
{
    use GeneralTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'user'=> $this->user ? $this->user : null,
            'balance'      => $this->balance     ,
            'count_movements'=>$this->countMovements($this->id),

        ];
    }
}
