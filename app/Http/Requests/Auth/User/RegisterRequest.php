<?php

namespace App\Http\Requests\Auth\User;

use App\Models\RegisterCodeNum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules;
use Modules\Auth\Entities\User;
use GeneralTrait;
use Modules\Appointment\Entities\Appointment;
use Modules\Profile\Entities\Profile;
use Modules\Wallet\Entities\Wallet;
use ProccessCodesService;
use App\Services\SendingMessagesService;
use App\Services\MsegatSmsService;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
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
            'email' => 'required_if:phone_no,=,null|email|unique:users,email',
            'country_id' => 'required_if:phone_no,!=,null|numeric|exists:countries,id',
            'phone_no' => 'required_if:email,=,null|numeric|regex:/^\d+$/|digits_between:7,14|unique:users,phone_no',
            'password' => ['required', Rules\Password::defaults()],
            'fcm_token' => ['sometimes'],
        ];
    }

    /**
    * Methods being called.
    *
    * @return object
    */
    public function addRoleUser($user,$roleId){
        return $user->roles()->attach([$roleId]);
    }
    

    /**
    * Registration User In db .
    *
    * @return object
    */
    public function actionRegister($request,$model){//model2:registerCodeNum
        $data=$request->validated();
        $data['code'] = "0000"; //TODO::strRandom()
        if ($request->has('phone_no')) {
            $msg ="كود التفعيل:". $data['code'] ." يرجى استخدامه فورًا.";
            $result = app(ProccessCodesService::class)->processRegPhone($model,$request,$data['code'],$msg);
            if(is_string($result)) return $result;
        } if ($request->has('email')) {
            $result = app(ProccessCodesService::class)->processRegEmail($model,$request,$data['code']);
            $data=[
                'email'=>$data['email'],
                'type'=>'check-code',
                'code'=>$data['code']
            ];
            app(SendingMessagesService::class)->sendingMessage($data);
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

