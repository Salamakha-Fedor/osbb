<?php


namespace App\Http\Requests;


use App\Exceptions\BadRequestParamsException;
use Illuminate\Support\Facades\Validator;

class PatchClaimRequest extends Request
{
    /**
     * @param array $claimData
     * @throws BadRequestParamsException
     */
    static function validateClaim (array $claimData): void
    {
        $messages = [
            'required' => __('validation.required'),
            'boolean' => __('validation.boolean'),
            'string' => __('validation.string'),
        ];

        $rules = [
            'in_work' => 'required|boolean',
            'title' => 'nullable|string|max:150',
            'text' => 'nullable|string|max:3000',
        ];

        $bValid = Validator::make($claimData, $rules, $messages);

        self::checkValidationResult($bValid);
    }
}
