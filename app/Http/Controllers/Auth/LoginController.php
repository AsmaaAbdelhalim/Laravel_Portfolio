<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    //protected $redirectTo;
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected function redirectTo()
    {
        if (Auth::user()->role == 1) {
            return '/admin/dashboard';
        } else {
            return '/';
        }
    }

    protected function authenticated(Request $request, $user)
{
    if ($user->role == 1) {
        Session::flash('message', 'Welcome back, Admin!');
        return redirect('/admin/dashboard');
    } else {
        Session::flash('message', 'Welcome back!');
        return redirect('/');
    }
}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
      //if (Auth::check() && Auth::user()->role == 1) {
      //    $this->redirectTo = '/admin/dashboard';
      //} else {
      //    $this->redirectTo = '/';
      //}
    } 
}
