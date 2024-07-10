<?php

namespace Modules\Geocode\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class CountryResource extends JsonResource
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
            'id'            => $this->id,
            'translate_id'     => $this->translate_id,
            'main_lang'     => $this->main_lang,
            'name'      => $this->name,
            'flag'      => $this->flag,
            'code'      => $this->code,
            'code2'      => $this->code2,
            'numcode'      => $this->numcode,
            'phone_code'      => $this->phone_code,
            'active'      => $this->active,
            'origina_active'      => $this->origina_active,
        ];
    }
}
