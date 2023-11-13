<?php

namespace Modules\Chat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class StoreChatRequest extends FormRequest
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
        //Store Chat for only superadmin        
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
