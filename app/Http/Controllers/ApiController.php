<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorCodes as Codes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $data
     * @param int $code
     * @param null $error
     * @return JsonResponse
     */
    public function success($data = [], $code = 200, $error = null)
    {
        $aResponseData = [
            'success' => true,
            'data' => $data,
            'error' => [
                'message' => $error
            ],
        ];

        return response()->json($aResponseData, $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @param int $errorCode
     * @param array $headers
     * @return JsonResponse
     */
    public function failure($message = 'Request Failed', $code = 400, $headers = [])
    {
        $aContent = [
            'success' => false,
            'error' => [
                'message' => $message,
            ]
        ];

        return response()->json($aContent, $code, $headers);
    }
}
