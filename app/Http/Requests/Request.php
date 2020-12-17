<?php


namespace App\Http\Requests;


use App\Exceptions\BadRequestParamsException;
use App\Exceptions\ErrorCodes;
use \Illuminate\Contracts\Validation\Validator;

class Request
{
    /**
     * @param Validator $bValid
     * @throws BadRequestParamsException
     */
    public static function checkValidationResult (Validator $bValid)
    {
        if ($bValid->fails()) {
            $errorMessage = implode(", ", $bValid->messages()->all());
            throw new BadRequestParamsException($errorMessage, 422);
        }
    }
}
