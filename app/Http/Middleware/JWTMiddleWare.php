<?php

namespace App\Http\Middleware;
use Closure;
use JWTAuth;
class JWTMiddleWare
{
    
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();
        return $next($request);
    }
}
