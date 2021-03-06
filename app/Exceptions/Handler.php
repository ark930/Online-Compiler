<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof BadRequestException) {
            return response()->json([
                'error' => $exception->getCode(),
                'message' => $exception->getMessage()
            ], 400);
        } else if ($exception instanceof ValidationException) {
            foreach ($exception->errors() as $error) {
                return response()->json([
                    'error' => 400,
                    'message' => $error[0]
                ], 400);
            }
        } else if($exception instanceof AuthenticationException) {
            return response()->json([
                'error' => 401,
                'message' => $exception->getMessage()
            ], 401);
        }

        return response()->json([
            'error' => $exception->getCode(),
            'message' => $exception->getMessage()
        ], 500);
//        return parent::render($request, $exception);
    }
}
