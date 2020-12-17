<?php

namespace App\Http\Requests;

use App\Exceptions\BadRequestParamsException;
use Illuminate\Support\Facades\Validator;

class PostClaimRequest extends Request
{
    /**
     * @param array $claimData
     * @throws BadRequestParamsException
     */
    static function validateClaim (array $claimData): void
    {
        $messages = [
            'required' => __('validation.required'),
            'max' => __('validation.max.array'),
            'string' => __('validation.string'),
            'integer' => __('validation.number'),
            'boolean' => __('validation.boolean'),
        ];

        $rules = [
            'title' => 'required|string|max:150',
            'text' => 'required|string|max:3000',
            'client_id' => 'required|integer|min:1|exists:App\Client,id',
            'in_work' => 'boolean|nullable',
        ];

        $bValid = Validator::make($claimData, $rules, $messages);

        self::checkValidationResult($bValid);
    }
}

