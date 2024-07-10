<?php

namespace Modules\Banner\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;
use Illuminate\Validation\Rule;
  

/**
 * Class UpdateBannerRequest.
 */
class UpdateBannerRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Banner is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

    //update Banner for only superadmin  and prevent update on superadmin
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
            'description' => [Rule::unique('banners')->ignore($this->id),'max:1000'],
            'title' => [Rule::unique('banners')->ignore($this->id)],
            'url' => ['sometimes'],
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
