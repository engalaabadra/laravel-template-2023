<?php

namespace Modules\Review\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;


class UpdateReviewRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Review is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Update Review for only superadmin        
        $authorizeRes= $this->authorizeRole(['user']);
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
            'description'=>['nullable'],
            'rating'=>['required','numeric'],
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
