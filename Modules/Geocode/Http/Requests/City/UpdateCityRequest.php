<?php

namespace Modules\Geocode\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;
  
use Illuminate\Validation\Rule;
use Modules\Auth\Entities\User;
use GeneralTrait;


/**
 * Class UpdateCityRequest.
 */
class UpdateCityRequest extends FormRequest
{
  
    use GeneralTrait;

    /**
     * Determine if the City is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //update City for only superadmin  
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
                'name' => ['required','max:225',Rule::unique('cities')->ignore($this->id)],
                'code' => ['required', 'max:100'],
                'active' => ['sometimes', 'in:1,0'],
                'country_id' => ['required','numeric','exists:countries,id'],

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
            'country_id.required'=>trans('The country_id field is required.'),
            'country_id.numeric'=>trans('The country_id field must be a number.'),
            'country_id.exists'=>trans('The selected country_id is invalid.'),
            'active.in:1,0'=>trans('The selected active is invalid.')

        ];
    }
     

 
}
