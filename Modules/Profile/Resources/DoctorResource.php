<?php

namespace Modules\Profile\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Modules\Review\Resources\User\ReviewResource;
use Modules\Profile\Resources\ProfileDoctorResource;
class DoctorResource extends JsonResource
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
            "doctor" => ProfileDoctorResource::make($this),
            "doctor_details" => [
                "patients_count" => 200,
                "reviews_count" => count($this->reviewsDoctor),
                "years_experience" => $this->profile ? $this->profile->years_experience : null,
            ],

            'reviews'      => $this->whenLoaded('reviewsDoctor', fn () => ReviewResource::collection($this->reviewsDoctor)),
        ];

    }
}
