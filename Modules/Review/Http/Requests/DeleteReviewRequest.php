<?php

namespace Modules\Review\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;

/**
 * Class DeleteReviewRequest.
 */
class DeleteReviewRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Review is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Delete user for only superadmin   ,admin 
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
        ];
    }
}
