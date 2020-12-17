<?php

namespace App\Exceptions;

use HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            if ($exception instanceof NotFoundHttpException) {
                $message = 'Route not found';
                $errorCode = ErrorCodes::NOT_FOUND;
                $responseCode = 404;
            } elseif ($exception instanceof ModelNotFoundException) {
                $message = 'Item not found';
                $errorCode = ErrorCodes::NOT_FOUND;
                $responseCode = 404;
            } elseif ($exception instanceof MethodNotAllowedHttpException) {
                $message = $exception->getMessage();
                $errorCode = ErrorCodes::METHOD_NOT_EXISTS;
                $responseCode = 405;
            } elseif ($exception instanceof ValidationException) {
                $message = $exception->getMessage();
                $errorCode = ErrorCodes::VALIDATION_ERROR;
                $responseCode = 422;
            } elseif ($exception instanceof BadRequestParamsException) {
                $message = $exception->getMessage();
                $errorCode = ErrorCodes::VALIDATION_ERROR;
                $responseCode = 422;
            } else {
                info($exception->getMessage() . ' on line '
                    . $exception->getLine() . ' in file '
                    . $exception->getFile());

                $message = $exception->getMessage();
                $errorCode = ErrorCodes::SERVER_ERROR;
                $responseCode = 500;
            }

            return response()->json([
                'success' => false,
                'error' => [
                    'message' => $message,
                    'errorCode' => $errorCode,
                ]
            ], $responseCode);
        }

        return parent::render($request, $exception);
    }
}
