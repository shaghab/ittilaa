<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::guard('ADMIN')->attempt($credentials)) { 
                // ADMIN Authentication passed... 'admin' was used by default
                return redirect()->intended('pages.admin');
            }
            elseif (Auth::guard('DATA_ENTRY_OPERATOR')->attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('pages.data_entry_form');
            }
            elseif (Auth::guard('MEMBER')->attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('pages.home');//add user name??
            }
            else {  // GUEST - unregistered 
                // Authentication passed...
                return redirect()->intended('pages.home');
            }           
        }

        //return redirect()->intended('pages.home');
    }
}
