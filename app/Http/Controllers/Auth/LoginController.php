<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\User;

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
    protected $redirectTo;

    public function redirectTo()
    {
        switch(Auth::user()->role->id)
        {
            case 1:
                $this->redirectTo ='/admin/dashboard';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo ='/author/dashboard';
                return $this->redirectTo;
                break;
            default:
            $this->redirectTo ='/';
            return $this->redirectTo; 
            break;   

        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // if (Auth::check() && Auth::user()->role->id == 1)
        // {
        //     $this->redirectTo = route('admin.dashboard');
        // } else{
        //     $this->redirectTo = route('author.dashboard');
        // }
       

        $this->middleware('guest')->except('logout');

     

       

    }
}
