<?php

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;

/**
 * Class DeletePaymentRequest.
 */
class DeletePaymentRequest extends FormRequest
{
    use GeneralTrait;

    /**
     * Determine if the Payment is authorized to make this request.
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
        ];
    }

}
