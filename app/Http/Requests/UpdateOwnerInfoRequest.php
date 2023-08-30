<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerInfoRequest extends FormRequest
{
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
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'phone' => 'nullable',
            'profile_photo_path' => 'nullable',
            'present_address' => 'nullable',
            'permanent_address' => 'nullable',
            'dob' => 'nullable',
            'password' => 'nullable',
        ];
    }
}
