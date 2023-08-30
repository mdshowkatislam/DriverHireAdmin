<?php

namespace App\Http\Requests;

use App\Helpers\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ValidateUserRequest extends FormRequest
{
    use RequestTrait;
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
            'user_id' => 'required|integer',
            'otp'     => 'required|exists:otps,otp',
        ];
    }


    public function messages()
    {
        return [
            'user_id.required' => 'User id is required',
            'user_id.integer'  => 'User id must be an integer',
            'otp.required'     => 'OTP is required',
            'otp.exists'       => 'OTP is not found',
        ];
    }
}
