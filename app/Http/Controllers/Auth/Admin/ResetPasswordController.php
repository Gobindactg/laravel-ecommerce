<?php

namespace App\Http\Controllers\Auth\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     *
    * Display the password reset view for the given token.
    *
    * If no token is present, display the link request form.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
   public function showResetForm(Request $request)
   {
       $token = $request->route()->parameter('token');

       return view('admin.pages.auth.passwords.reset')->with(
           ['token' => $token, 'email' => $request->email]
       );
   }

    // protected $redirectTo = '/admin';
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin/login';

    
    public function broker(){
        return Password::broker('admins');
    }
}
