<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'v_name' => 'nullable',
            'v_type' => 'nullable',
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
            'v_photo' => 'nullable'
        ];
    }
}
