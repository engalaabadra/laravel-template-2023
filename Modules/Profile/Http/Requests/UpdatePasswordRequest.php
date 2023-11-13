<?php

namespace Modules\Profile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
 
use Illuminate\Validation\Rules;

/**
 * Class UpdatePasswordRequest.
 */
class UpdatePasswordRequest extends FormRequest
{
    /**
     * StoreUserRequest constructor.
     */
 
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
            'old_password' => ['required','max:255',Rules\Password::defaults()],
            'new_password' => ['required','max:255',Rules\Password::defaults()],
            'confirmation_new_password' => ['required','max:255',Rules\Password::defaults()]
        ];
    }


}
