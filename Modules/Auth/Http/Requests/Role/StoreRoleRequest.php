<?php

namespace Modules\Auth\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class StoreRoleRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Banner is authorized to make this request.
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
            'name' => ['required',Rule::unique('roles')],
            'display_name' => ['nullable'],
            'description' => ['max:1000'],
            'active' => ['sometimes',  'in:1,0'],
        
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
