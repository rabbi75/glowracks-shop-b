<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         if(Auth::check() && Auth::user()->role->id==1) {
            $this->redirectTo=route('superadmin.dashboard');
        }elseif(Auth::check() && Auth::user()->role->id==2){
            $this->redirectTo=route('admin.dashboard');     
        }elseif(Auth::check() && Auth::user()->role->id==3){
            $this->redirectTo=route('editor.dashboard');     
        }else{
            $this->redirectTo=route('author.dashboard');     
        }
        $this->middleware('guest:customer')->except('logout');
        $this->middleware('guest')->except('logout');
    }
    protected function credentials(Request $request)
    {
        return ['email'=>$request->{$this->username()},'password'=>$request->password,'status'=>'1'];
    }
}
