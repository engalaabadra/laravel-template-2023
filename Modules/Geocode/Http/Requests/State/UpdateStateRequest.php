<?php

namespace Modules\Geocode\Http\Requests\State;

use Illuminate\Foundation\Http\FormRequest;
  
use Illuminate\Validation\Rule;
use Modules\Auth\Entities\User;
use GeneralTrait;


/**
 * Class UpdateStateRequest.
 */
class UpdateStateRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the State is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //update State for only superadmin       
        $authorizeRes= $this->authorizeRole(['superadmin']);
        if($authorizeRes==true){
            return true;
        }else{
            return failedAuthorization();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->id=="1"){
                
            return $this->failedAction();
        }else{
            return [
                'name' => 'required|unique:countries|max:100',
                'code' => ['required', 'max:100'],
                'active' => ['sometimes', 'in:1,0'],
                'city_id' => ['required','numeric','exists:cities,id'],

            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [ 
            'name.required'=>trans('The name field is required.'),
            'name.max:225'=>trans('The name must not be greater than 225.'),
            'code.required'=>trans('The code field is required.'),
            'code.max:100'=>trans('The code must not be greater than 100.'),
            'city_id.required'=>trans('The city_id field is required.'),
            'city_id.numeric'=>trans('The city_id field must be a number.'),
            'city_id.exists'=>trans('The selected city_id is invalid.'),
            'active.in:1,0'=>trans('The selected active is invalid.')

        ];
    }
     

 
}
