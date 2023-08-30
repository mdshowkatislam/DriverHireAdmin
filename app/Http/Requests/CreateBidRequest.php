<?php

namespace App\Http\Requests;

use App\Helpers\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBidRequest extends FormRequest
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
            'hire_request_id' => 'required|exists:hire_requests,id',
            'driver_id'      => 'required|exists:users,id',
            'bid_amount'      => 'required|numeric',
            'note'            => 'nullable|string',
        ];
    }
}
