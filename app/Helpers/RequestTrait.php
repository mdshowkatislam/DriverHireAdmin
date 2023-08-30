<?php

namespace App\Helpers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

trait RequestTrait
{
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            sendError(
                'Validation Error',
                $validator->errors()->toArray(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
