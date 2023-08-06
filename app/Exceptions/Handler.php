<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Http;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $response = [
            'message' => $exception->getMessage(),
        ];
        $statusCode = 500;

        if ($exception instanceof ModelNotFoundException) {
            $statusCode = 404;
        } elseif ($exception instanceof \Illuminate\Validation\ValidationException) {
            $statusCode = 400;
            $response['errors'] = $exception->errors();
        } elseif (method_exists($exception, 'getStatusCode')) {
            error_log('dsadsa');
            $statusCode = $exception->getStatusCode();
        }

        return response()->json($response, $statusCode);
    }

}
