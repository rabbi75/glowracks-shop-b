<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Closure;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->role->id==1) {
            return redirect('superadmin/dashboard');
        }elseif (Auth::guard($guard)->check() && Auth::user()->role->id==2){
            return redirect('admin/dashboard');
        }elseif (Auth::guard($guard)->check() && Auth::user()->role->id==3){
            return redirect('editor/dashboard');
        }elseif (Auth::guard($guard)->check() && Auth::user()->role->id==4){
            return redirect('author/dashboard');
        }else{
            return $next($request);
        }
    }
}
