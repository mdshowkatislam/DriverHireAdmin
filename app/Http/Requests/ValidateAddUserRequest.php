<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAddUserRequest extends FormRequest
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

        $final = [];
        $common = [
            'type_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'password' => 'required',
        ];

        if ($this->type_id == 'owner') {
            $owner = [
                'user-photo' => 'required',
                'dob' => 'required',
            ];
            $final = array_merge($common, $owner);
        } else {
            $driver = [
                'nid' => 'required',
                'licence_number' => 'required',
                'lcf' => 'required',
                'lcb' => 'required',
                'user-photo' => 'required',
                'dob' => 'required',
            ];
            $final = array_merge($common, $driver);
        }

        return $final;
    }


    public function messages()
    {
        return [
            'type_id.required' => 'The user type field is required.',
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'password.required' => 'The password field is required.',
            'user-photo.required' => 'The profile photo field is required.',
            'dob.required' => 'The date of birth field is required.',
            'licence_number.required' => 'The licence number field is required.',
            'lcf.required' => 'The licence copy front field is required.',
            'lcb.required' => 'The licence copy back field is required.',
        ];
    }
}
