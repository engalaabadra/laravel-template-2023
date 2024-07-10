<?php

namespace Modules\Profile\Http\Requests\Doctor;

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
            'phone_no' => ['sometimes','integer', 'min:0','regex:/^\d+$/','digits_between:7,14',Rule::unique('users')->ignore($userId)],
            'full_name' => ['sometimes','min:3','max:255'],
            'nick_name' => ['nullable','min:3','max:255'],
            'email' => ['sometimes','max:255',Rule::unique('users')->ignore($userId)],
            'country_id' => ['required_if:phone_no,!=,null','max:20','exists:countries,id'],
            'bio' => ['sometimes','min:6','max:1000'],
            'years_experience' => ['sometimes','integer', 'min:0'],
            // 'license_number'=>['sometimes','max:225',Rule::unique('profiles')->ignore($userId,'license_number')],
            'license_number'=>['sometimes','max:225'],
            'specialties' => ['sometimes'],
            'specialties.*'=>['exists:specialties,id'],
            'price_half_hour' => ['sometimes','integer', 'min:0'],
            'gender' => ['nullable','in:1,0'],
            'birth_date' => ['date'],
            'image'=>['nullable','mimes:jpeg,bmp,png,gif,svg']
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
