<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

    function index(Request $request){
        if($request->method() == 'GET'){
            return view('auth.login');
        }elseif($request->method() == 'POST'){
            if(Auth::attempt([
                'email'     => $request->email,
                'password'  => $request->password
            ])){
                return redirect()->route('candidate');
            }else{
                if(!$request->email && !$request->password){
                    Session::put('sweetalert', 'warning');
                    return redirect('login')->with('alert', 'Email dan Password Harus Diisi!');
                }
                Session::put('sweetalert', 'warning');
                return redirect('login')->with('alert', 'Email atau Password Salah!');
            }
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
