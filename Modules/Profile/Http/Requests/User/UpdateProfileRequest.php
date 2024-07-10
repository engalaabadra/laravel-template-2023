<?php

namespace Modules\Profile\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules;

/**
 * Class UpdateProfileRequest.
 */
class UpdateProfileRequest extends FormRequest
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
        $userId=authUser()->id;
        return [
            'phone_no' => ['sometimes','numeric','regex:/^\d+$/','digits_between:7,14',Rule::unique('users')->ignore($userId)],
            'email' => ['sometimes','max:255',Rule::unique('users')->ignore($userId)],
            'country_id' => ['required_if:phone_no,!=,null','max:20','exists:countries,id'],
            'full_name' => ['sometimes','min:3','max:255'],
            'nick_name' => ['nullable','min:3','max:255'],
            'bio' => ['nullable'],
            'gender' => ['nullable','in:1,0'],
            'birth_date' => ['date'],
            'image'=>['mimes:jpeg,bmp,png,gif,svg']
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
