<?php

namespace Modules\Geocode\Http\Requests\AddressType;

use Illuminate\Foundation\Http\FormRequest;
  
use Illuminate\Validation\Rule;
use Modules\Auth\Entities\User;
use GeneralTrait;

/**
 * Class UpdateAddressTypeRequest.
 */
class UpdateAddressTypeRequest extends FormRequest
{
    use GeneralTrait;

    
    /**
     * Determine if the AddressType is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //update AddressType for only superadmin       
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
                'name' => ['required','max:100'],
                'description' => ['max:1000'],
                'active' => ['in:1,0']

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
            'description.max:1000'=>trans('The description must not be greater than 1000.'),
            'active.in:1,0'=>trans('The selected active is invalid.')
        ];
    }
     

 
}
