<?php

namespace App\Http\Requests\Auth;

use App\Services\MsegatSmsService;
use App\Services\ProccessCodesService;
use App\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules;
use Modules\Auth\Entities\User;
/**
 * Class ForgotPasswordRequest.
 */
class ForgotPasswordRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the user is authorized to make this request.
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
        return [
            'email' => 'required_if:phone_no,=,null|email|exists:users,email',
            'country_id' => 'required_if:phone_no,!=,null|numeric|exists:countries,id',
            'phone_no' => 'required_if:email,=,null|numeric|regex:/^\d+$/|digits_between:7,14|exists:users,phone_no',
            
        ];
    }
    /**
     * Process Forgot Password.
     *
     * @return array
     */
    public function processForgotPassword($request,$code,$model){//model :reset_passd
        $data=$request->validated();
        $data['code'] = "0000"; //TODO::strRandom()
        if ($request->has('phone_no')) {
            $msg ="رمز تغيير كلمة المرور:" . $data['code']." يرجى استخدامه فورًا.";
            $result = app(ProccessCodesService::class)->processRegPhone($model,$request,$data['code'],$msg);
            if(is_string($result)) return $result;
        } if ($request->has('email')) {
            $result = app(ProccessCodesService::class)->processRegEmail($model,$request,$data['code']);
            if(is_string($result)) return $result;
        }
        return $data;

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
