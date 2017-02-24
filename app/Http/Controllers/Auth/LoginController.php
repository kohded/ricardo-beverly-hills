<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Set login redirect path based on role.
     *
     * @return string
     */
    public function redirectPath()
    {
        $redirectTo = '/';

        if(Auth::user()->hasRole('ricardo-beverly-hills')) {
            $this->$redirectTo = '/claim';
        } elseif(Auth::user()->hasRole('part-company')) {
            $this->$redirectTo = '/part-company-claim';
        } elseif(Auth::user()->hasRole('repair-center')) {
            $this->$redirectTo = '/repair-center-claim';
        }

        return $this->$redirectTo;
    }
}
