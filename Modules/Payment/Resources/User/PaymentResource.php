<?php

namespace Modules\Payment\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use GeneralTrait;
use Modules\Wallet\Entities\Wallet;

class PaymentResource extends JsonResource
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
        $balanceWallet=null;
        if(authUser() && $this->checkIsUser(authUser()->id)){
            $wallet = Wallet::firstOrNew(['user_id' => authUser()->id]);

            if (!$wallet->exists) {
                $wallet->fill(['active' => "1", 'balance' => 0])->save();
            }
            $balanceWallet = $wallet->balance;
        }
            return [
                'id'            => $this->id,
                'main_lang'      => $this->main_lang,
                'translate_id'      => $this->translate_id,
                'name'      => $this->name,
                'image'      => $this->image,
                'active'         => $this->active,
                'original_active'         => $this->original_active,
                'created_at'         => $this->created_at,
                'balance'=> ($this->id==1) ?$balanceWallet : null
            ];
        }
}
