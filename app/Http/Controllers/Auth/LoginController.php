<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request, Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Lang;
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

    use AuthenticatesUsers{
        login as traitLogin;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    // Override trait function and call it from the overriden function
    public function login(Request $request)
    {
        //Set session as 'login'
        Session::put('last_auth_attempt', 'login');
        //The trait is not a class. You can't access its members directly.
        return $this->traitLogin($request);
    }

    public function username()
    {
        return 'username';
    }

//    protected function redirectTo()
//    {
//        if (Auth::user()->role == 'Admin')
//          return '/admin';
//        else if (Auth::user()->role == 'Cashier')
//          return '/cashier';
//    }

    public function ajaxLogin(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

//        return $this->sendFailedLoginResponse($request);
        return Response::json(
            [
                $this->username() => Lang::get('auth.failed'),
            ], 422);
    }
}
