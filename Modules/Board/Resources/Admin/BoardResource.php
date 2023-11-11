<?php

namespace Modules\Board\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class BoardResource extends JsonResource
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
            'description'      => $this->description,
            'image'      => $this->image
        ];
    }
}