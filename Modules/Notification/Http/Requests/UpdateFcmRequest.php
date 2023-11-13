<?php

namespace Modules\Notification\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class UpdateFcmRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Chat is authorized to make this request.
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
            'fcm_token' => ['required'],
        ];
    }

    /**
     * @return array
    */
    public function messages()
    {
        return [
        
        ];
    }
}
