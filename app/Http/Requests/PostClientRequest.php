<?php

namespace App\Http\Requests;

use App\Exceptions\BadRequestParamsException;
use Illuminate\Support\Facades\Validator;

class PostClientRequest extends Request
{

    /**
     * @param array $clientData
     * @throws BadRequestParamsException
     */
    static function validateClient (array $clientData): void
    {
        $messages = [
            'required' => __('validation.required'),
            'max' => __('validation.max.array'),
            'string' => __('validation.string'),
        ];

        $rules = [
            'name' => 'required|string|max:200',
            'address' => 'required|string|max:1000',
        ];

        $bValid = Validator::make($clientData, $rules, $messages);

        self::checkValidationResult($bValid);
    }
}

