<?php

namespace Modules\Chat\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class StoreFilesChatRequest extends FormRequest
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
            'files'=>['required', 'array','max:2048']
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
