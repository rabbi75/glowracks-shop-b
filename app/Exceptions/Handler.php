<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Auth; 
use Response;
use Exception;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
class Handler extends ExceptionHandler
{
    protected $dontReport = [
        
    ];
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
    public function register()
    {

        $this->renderable(function(TokenInvalidException $e, $request){
                return Response::json(['error'=>'Invalid token'],401);
        });
        $this->renderable(function (TokenExpiredException $e, $request) {
            return Response::json(['error'=>'Token has Expired'],401);
        });

        $this->renderable(function (JWTException $e, $request) {
            return Response::json(['error'=>'Token not parsed'],401);
        });

    }
}
