<?php

namespace App\Http\Requests;

use App\Helpers\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class HireRequestRequest extends FormRequest
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
            'v_id'       => 'required|exists:vehicles,id',
            'from_location' => 'required',
            'to_location' => 'required',
            'return_location' => 'nullable',
            'note' => 'nullable',
            'hire_status' => 'required|in:pending,accepted,ride_started,ride_completed,ride_cancel,unknown',
            'trip_date_time' => 'required',
            'trip_end_date_time' => 'required',
            'from_location_lat' => 'required|numeric',
            'from_location_long' => 'required|numeric',
            'to_location_lat' => 'required|numeric',
            'to_location_long' => 'required|numeric',
            'return_location_lat' => 'nullable|numeric',
            'return_location_long' => 'nullable|numeric',
        ];
    }


    public function messages()
    {
        return [
            'v_owner_id.reuired' => 'Vehicle owner ID required',
            'v_id.required' => 'Vehicle ID required',
            'v_id.exists' => 'Vehicle ID does not exist',
            'v_owner_id.exists' => 'Vehicle Owner ID does not exist',
        ];
    }
}
