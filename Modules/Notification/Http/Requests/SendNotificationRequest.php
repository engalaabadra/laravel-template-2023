<?php

namespace Modules\Notification\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class SendNotificationRequest extends FormRequest
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
            'title' => ['required','max:225'],
            'body' => ['required','max:225'],
            'type' => ['required','max:225'],
            
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
