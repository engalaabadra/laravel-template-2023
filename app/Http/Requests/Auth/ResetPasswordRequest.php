<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules;
use Modules\Auth\Entities\User;

/**
 * Class ResetPasswordRequest.
 */
class ResetPasswordRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
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
            'password'=>['required', Rules\Password::defaults(),'confirmed'],
            'email' => 'required_if:phone_no,=,null|email|exists:users,email',
            'country_id' => 'required_if:phone_no,!=,null|numeric|exists:countries,id',
            'phone_no' => 'required_if:email,=,null|numeric|regex:/^\d+$/|digits_between:7,14|exists:users,phone_no',
            
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
