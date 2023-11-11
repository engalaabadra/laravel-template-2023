<?php

namespace Modules\Board\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;

/**
 * Class UpdateBoardRequest.
 */
class UpdateBoardRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Board is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

    //update Board for only superadmin  and prevent update on superadmin
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
            'description' => ['max:1000',Rule::unique('boards')->ignore($this->id)],
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
