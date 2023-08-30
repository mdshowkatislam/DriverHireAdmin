<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverInfoRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'licence_no' => 'nullable|string|max:255',
            'present_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'nid' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'profile_photo_path' => 'nullable|image',
            'licence_copy_front' => 'nullable|image',
            'licence_copy_back' => 'nullable|image',
            'password' => 'nullable|string|min:8',
        ];
    }
}
