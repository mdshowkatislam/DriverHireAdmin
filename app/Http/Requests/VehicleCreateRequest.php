<?php

namespace App\Http\Requests;

use App\Helpers\RequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VehicleCreateRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'v_name' => 'required',
            'v_type' => 'required',
            'v_year' => 'nullable',
            'v_model' => 'nullable',
            'v_chassis' => 'nullable',
            'v_engine' => 'nullable',
            'v_tax_token' => 'nullable',
            'v_fitness_certificate' => 'nullable',
            'v_root_permit' => 'nullable',
            'v_number_plate' => 'nullable',
            'v_color' => 'nullable',
            'v_insurance' => 'nullable',
            'status' => 'integer|in:1,0',
            'v_photo' => 'nullable'
        ];
    }
}