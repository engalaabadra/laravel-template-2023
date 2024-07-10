<?php

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class StorePaymentRequest extends FormRequest
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
        //Store Payment for only superadmin        
        $authorizeRes= $this->authorizeRole(['superadmin,admin']);
        if($authorizeRes==true){
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
            'name' => ['required',Rule::unique('payments'),'max:1000'],
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
