<?php

namespace App\Http\Requests;

use App\Helpers\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateHireRequestRequest extends FormRequest
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
            'bid_winner_id' => 'nullable|exists:users,id',
            'accepted_bid_id' => 'nullable|exists:bids,id',
            'v_id'       => 'nullable|exists:vehicles,id',
            'from_location' => 'nullable',
            'to_location' => 'nullable',
            'return_location' => 'nullable',
            'note' => 'nullable',
            'hire_status' => 'nullable|in:pending,accepted,ride_started,ride_completed,ride_cancel,unknown',
            'trip_date_time' => 'nullable',
            'trip_end_date_time' => 'nullable',
            'from_location_lat' => 'nullable',
            'from_location_long' => 'nullable',
            'to_location_lat' => 'nullable',
            'to_location_long' => 'nullable',
            'return_location_lat' => 'nullable',
            'return_location_long' => 'nullable',
        ];
    }
}
