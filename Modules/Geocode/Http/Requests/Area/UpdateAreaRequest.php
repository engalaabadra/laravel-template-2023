<?php

namespace Modules\Geocode\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;
  
use Illuminate\Validation\Rule;
use Modules\Auth\Entities\User;
use GeneralTrait;

/**
 * Class UpdateAreaRequest.
 */
class UpdateAreaRequest extends FormRequest
{
    use GeneralTrait;

    
    /**
     * Determine if the Area is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //update Area for only superadmin       
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
                'name' => ['required','max:100',Rule::unique('areas')->ignore($this->id)],
                'active' => ['in:1,0'],
                'state_id' => ['required','numeric','exists:states,id'],

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
            'state_id.required'=>trans('The state_id field is required.'),
            'state_id.numeric'=>trans('The state_id field must be a number.'),
            'state_id.exists'=>trans('The selected state_id is invalid.'),
            'active.in:1,0'=>trans('The selected active is invalid.')

        ];
    }
     

 
}
