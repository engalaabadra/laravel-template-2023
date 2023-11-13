<?php

namespace Modules\Chat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;
  

/**
 * Class UpdateChatRequest.
 */
class UpdateChatRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Chat is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    //update Chat for only superadmin  and prevent update on superadmin
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
        
        return [
            'body' => ['required','max:10000'],
            'image'=>['mimes:jpeg,bmp,png,gif, svg'],
            'file'=>['mimes:pdf'],
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
