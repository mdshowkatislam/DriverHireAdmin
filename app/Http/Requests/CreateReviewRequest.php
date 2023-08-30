<?php

namespace App\Http\Requests;

use App\Helpers\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateReviewRequest extends FormRequest
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
            'rating' => 'required|numeric|min:1|max:5',
            'rate_by' => 'required|exists:users,id',
            'rate_to' => 'required|exists:users,id',
            'review_text' => 'required|string',
        ];
    }
}
