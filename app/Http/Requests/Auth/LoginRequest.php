<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Modules\Auth\Entities\User;
use Illuminate\Support\Facades\Hash;
use GeneralTrait;
class LoginRequest extends FormRequest
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
            'password'=>['required'],
            'fcm_token'=>['sometimes'],
        ];
    }


    /**
     * Check if the user have the correct Credentials.
     *
     * @return object
     */
    public function checkLogin($request,$type){
        $user=$this->checkEmailPhone($request);
        if(is_string($user)) return $user;
        $resultCheckPassword=$request->get('password') ?  $this->checkPassword($request->get('password'),$user) : null;
        $resultLogin=is_string($resultCheckPassword) ?  $resultCheckPassword :  $user;
        if($request->has('fcm_token')) $user->update(['fcm_token'=>$request->fcm_token]);
        return $resultLogin;
    }



    public function checkPassword($password,$user)
    {
        if (!Hash::check($password, $user->password)) {
            return trans('messages.Invalid credentials');
        }

    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCredentials()
    {
        // i have to check if user has entered one or another
        $email = $this->get('email');
        return [
            'email' => $email,
            'password' => $this->get('password')
        ];
        return $this->only('email', 'password');
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [

           ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->filled('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
