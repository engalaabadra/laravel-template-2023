<?php

namespace Modules\Favorite\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Review\Traits\ReviewTraits;
use GeneralTrait;
use Modules\Profile\Resources\ProfileDoctorResource;
class FavoriteResource extends JsonResource
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
            'user'      => $this->user ? $this->user->full_name :null,
            'doctor'=> ProfileDoctorResource::make($this->doctor),            
            'reviews_count'      => $this->doctor ? count($this->doctor->reviewsDoctor) :null,
        ];
    }
}
