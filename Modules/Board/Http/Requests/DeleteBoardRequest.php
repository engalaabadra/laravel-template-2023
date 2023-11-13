<?php

namespace Modules\Board\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use GeneralTrait;

/**
 * Class DeleteBoardRequest.
 */
class DeleteBoardRequest extends FormRequest
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
