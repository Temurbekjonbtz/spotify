<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (TokenBlacklistedException $e,$request) {
            return response(['error'=>'Token can not be used, get new one'], Response::HTTP_BAD_REQUEST);
        });
        $this->renderable(function (TokenInvalidException $e,$request) {
            return response(['error'=>'Token is invalid'], Response::HTTP_BAD_REQUEST);
        });
        $this->renderable(function (TokenExpiredException $e,$request) {
            return response(['error'=>'Token is expired','action'=>'logout'], Response::HTTP_BAD_REQUEST);
        });
        $this->renderable(function (JWTException $e,$request) {
            return response(['error'=>'Token is not provided'], Response::HTTP_BAD_REQUEST);
        });
    }
}
