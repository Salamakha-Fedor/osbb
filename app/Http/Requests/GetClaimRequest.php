<?php


namespace App\Http\Requests;


use App\Exceptions\BadRequestParamsException;
use Illuminate\Support\Facades\Validator;

class GetClaimRequest extends Request
{
    /**
     * @param array $claimData
     * @throws BadRequestParamsException
     */
    static function validateClaim (array $claimData): void
    {
        $messages = [
            'min' => __('validation.min.integer'),
            'integer' => __('validation.integer'),
        ];

        $rules = [
            'client_id' => 'integer|nullable|min:1',
            'pageRows' => 'integer|nullable|min:1',
        ];

        $bValid = Validator::make($claimData, $rules, $messages);

        self::checkValidationResult($bValid);
    }
}
