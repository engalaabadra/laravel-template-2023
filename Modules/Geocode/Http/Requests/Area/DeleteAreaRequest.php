<?php

namespace Modules\Geocode\Http\Requests\Area;

  
use Illuminate\Foundation\Http\FormRequest;
use Modules\Auth\Entities\User;
use GeneralTrait;


/**
 * Class DeleteAreaRequest.
 */
class DeleteAreaRequest extends FormRequest
{
    use GeneralTrait;


 
    /**
     * Determine if the State is authorized to make this request.
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
            if($this->id=="1"){
                
                return $this->failedAction();
            }else{
                return [
                ];
            }
    }



     

 
}
