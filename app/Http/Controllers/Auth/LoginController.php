<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Adldap\Laravel\Facades\Adldap;
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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
      return 'samaccountname';
    }

    public function authenticated (Request $request, $user)
    {
        $this->userSession($user);
    }

    public function userSession($user)
    {   
        if(\Auth::user() && \DB::connection('mysql')->table('users')->where('uid',"=", \Auth::user()->samaccountname)->exists())
        {
            return redirect('/home');
        }
        else {
            \Auth::logout();
            
            return redirect('/login');
        }
    } 


}
