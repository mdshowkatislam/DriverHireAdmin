<?php

namespace App\Http\Requests;

use App\Helpers\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VehicleUpdateRequest extends FormRequest
{
    use RequestTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('api')->check();
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
            'v_name'  => 'nullable',
            'v_type'  => 'nullable',
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
