<?php

namespace Modules\Geocode\Http\Requests\City;

use App\Domains\Auth\Models\City;
  
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Modules\Geocode\Entities\City as ModelsCity;
use Modules\Auth\Entities\User;
use GeneralTrait;


/**
 * Class DeleteCityRequest.
 */
class DeleteCityRequest extends FormRequest
{
    use GeneralTrait;

  
    /**
     * Determine if the City is authorized to make this request.
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

    
     
    protected function failedAction()
     {
         throw new AuthorizationException(trans('You cannt make this action'));
     }
}
