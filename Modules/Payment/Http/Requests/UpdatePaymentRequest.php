<?php

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;

/**
 * Class UpdatePaymentRequest.
 */
class UpdatePaymentRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Payment is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

    //update Payment for only superadmin  and prevent update on superadmin
        $authorizeRes= $this->authorizeRole(['superadmin,admin']);
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
        
        return [
            'name' => ['max:1000',Rule::unique('payments')->ignore($this->id)],
            'image'=>['mimes:jpeg,bmp,png,gif, svg'],
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
