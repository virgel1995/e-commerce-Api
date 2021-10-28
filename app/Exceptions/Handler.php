<?php

namespace App\Exceptions;
use App\Exceptions\ExceptionTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
class Handler extends ExceptionHandler
{
    use ExceptionTrait;

    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $exception, $request) {

            if ($request->expectsJson()) {
               return $this->apiException($request,$exception);
            }
        });
    }
}
