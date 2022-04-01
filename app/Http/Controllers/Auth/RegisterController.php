<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use App\Notifications\VerifyRegistation;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // for use str_slug 
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
      /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegistrationForm()
    {
       
        $division = Division::orderBy('priority', 'asc')->get();
        $district= District::orderBy('id', 'asc')->get();
        return view('auth.register')->with('district', $district)->with('division', $division);
    }

  
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['nullable', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'division_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'phone_no' => ['required', 'max:15'],
            'street_address' => ['required', 'max:100'],
        ]);
      
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $request)
    {
        // this section used for validation email or phone number
        $email = $request->email;
        $phone_no = $request->phone_no;
        $users = User::where('email', $email)->get();
        $users_no = User::where('phone_no', $phone_no)->get();
        if (count($users) > 0 ) {
            session()->flash('NotRegistered', 'Sorry !! Your Email Already Used, Try Again New Email');
            return redirect('/register');
        } elseif( count($users_no) >0) {
            session()->flash('NotRegistered', 'Sorry !! Your Phone Number Already Used, Try Again New Phone Number');
            return redirect('/register'); // this section used for validation email or phone number
        }else {
             $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username'=> Str::slug($request->first_name.$request->last_name),
                'email' => $request->email,
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'phone_no' => $request->phone_no,
                'street_address' => $request->street_address,
                'ip_address' => request()->ip(),
                'password' => Hash::make($request->password),
                'remember_token' =>Str::random(40),
                'status' => 0,
            ]);

            $user->notify(new VerifyRegistation($user, $user->remember_token));
            session()->flash('success', 'A Confirmation email sent to you. Please check your email to confirm');
            return redirect('/register');
            }
        }
    }

