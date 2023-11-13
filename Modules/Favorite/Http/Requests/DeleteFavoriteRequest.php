<?php

namespace Modules\Favorite\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;

/**
 * Class DeleteFavoriteRequest.
 */
class DeleteFavoriteRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Favorite is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'doctor_id' => ['numeric','exists:users,id','required'],

        ];
    }
}
