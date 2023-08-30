<?php

namespace App\Http\Requests;

use App\Helpers\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ApiRegisterRequest extends FormRequest
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
        return (
            strtolower($this->request->get('role')) == 'user'
            || strtolower($this->request->get('role')) == 'owner'
        ) ? $this->commonPart() : array_merge($this->commonPart(), $this->driverDetails());
    }


    private function commonPart(){
        return [
            'first_name'         => 'required',
            'last_name'          => 'required',
            'phone'              => 'required|unique:users,phone',
            'password'           => 'required',
            'role'               => 'required|in:owner,driver',
            'photo'              => 'nullable',
            'present_address'    => 'required',
            'permanent_address'  => 'required',
            'dob'                => 'required',
        ];
    }


    private function driverDetails(){
        return [
            'nid'        => 'required',
            'licence_no' => 'required',
            'licence_copy_front' => 'required',
            'licence_copy_back' => 'required'
        ];
    }
}
