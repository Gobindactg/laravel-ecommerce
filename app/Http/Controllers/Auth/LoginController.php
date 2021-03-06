<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistation;
use App\Models\User;
use App\Models\Admin;
use Auth;

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
  
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required', 
        ]);
        // find user by this email
        $user = User::where('email', $request->email)->first();
            if(!is_null($user)){
                if($user->status == 1){
                    //user login
                    if(Auth::guard('web')->attempt(['email'=>$request->email, 'password' => $request->password], $request->remember))
                    {
                        //login now
                        return redirect()->route('users/dashboard');
                    }else{
                            session()->flash('NotRegistered', 'Your Email Address or Password is not correct!! Please Try Again With Correct Information !! Or Reset Password');
                                    return redirect('/login');
                        }
                    }else{ 
                    //send email token again
                        if(!is_null($user)){
                        $user->notify(new VerifyRegistation($user, $user->remember_token));
                        session()->flash('success', 'A New Confirmation email sent to you. Please check your email to confirm');
                        return redirect('/login');
                         }
                    }                 
                 }else{
                    session()->flash('NotRegistered', 'Your are Not Complete Registation; Please Registation First');
                    return redirect('/register');
                }
        }

        public function user_logout(){
            Auth::guard('web')->logout();
            return redirect()->route('login');
        }


    

}

  