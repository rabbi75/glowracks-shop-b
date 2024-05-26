<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class ValidDeliveryman
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('deliveryman')->user()){
            return $next($request);
        }
        return redirect('deliveryman/login');
    }
}
