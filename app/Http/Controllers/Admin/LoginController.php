<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LoginController;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistation;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController;
use Hash;
use Image;
use File;


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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

  
 
    public function adminLogin()
    {
        return view('admin.pages.auth.login');
    }
    public function adminRegister()
    {
        return view('admin.pages.auth.register');
    }
  
    public function adminRegisterstore(Request $request)
    {
        // this section used for validation email or phone number
      
        $email = $request->email;
        $phone_no = $request->phone_no;
       
        $users = Admin::where('email', $email)->get();
        $users_no = Admin::where('phone_no', $phone_no)->get();
        if (count($users) > 0 ) {
            session()->flash('NotRegistered', 'Sorry !! Your Email Already Used, Try Again New Email');
            return redirect('/admin/register');
        } elseif( count($users_no) >0) {
            session()->flash('NotRegistered', 'Sorry !! Your Phone Number Already Used, Try Again New Phone Number');
            return redirect('/admin/register'); // this section used for validation email or phone number
        }else {
            $admin = new Admin;
            $admin->name = $request->name;
            $admin->user_name = $request->user_name;
            $admin->email = $request->email;
            $admin->phone_no = $request->phone_no;
            $admin->type = $request->admin_type;
            $admin->password = Hash::make($request->password);
            if ($request->hasFile('admin_image')) {
                //   //insert that image
                  $image = $request->file('admin_image');
                  $img = time() . '.'. $image->getClientOriginalExtension();
                  $location = public_path('assets/adminImage/' .$img);
                  Image::make($image)->save($location);
                  $admin->image = $img;
              }else{
                  $admin->image = 'user.png';
              }

            $admin->save();
              session()->flash('success', 'Your Admin Registation Complete Successfully');
            return redirect('/admin/register');
            }
    }


  
   
    public function admin_login(Request $request)
    {
     
            $check = $request->only('email','password');

            $admin = Admin::where('email', $request->email)->first();
            $status = Admin::where('status', 0)->first();
            if(!is_null($admin)){
                if($admin->status == 0){
                    if(Auth::guard('admin')->attempt($check)){
                        session()->flash('success', 'Your Registation has Completed successfully !! Please login');
                         return redirect()->route('admin/home');
                     }else{
                         session()->flash('LoginFail', 'Please Enter Your Correct Email or Password !!  Or reset password');
                        return redirect()->route('admin.login');
                     }
                }else{
                    session()->flash('LoginFail', 'Your Account Is currently Disable !! Please contact Admin');
                return redirect()->route('admin.login');
                }
               
            }else{
                session()->flash('LoginFail', 'You Are Not Athentic Admin User !!');
                return redirect()->route('admin.login');
            }
           
          
        }
       public function admin_logout(){
           Auth::guard('admin')->logout();
           return redirect()->route('admin.login');
       }

       public function admin_manage()
       {
           $admin = Admin::orderBy('name', 'desc')->get();
           return view('admin.pages.admin.manage', compact('admin'));
       }

       public function admin_status(Request $request, $id)
       {
        $admin = Admin::find($id);
        $admin->status = $request->status;
        $admin->save();
        return redirect()->route('admin/manage/user');
       }
       public function admin_delete(Request $request, $id)
       {
        $admin = admin::find($id);
        if (!is_null($admin)) {
          $admin->delete();
        }
        session()->flash('delete', 'An Admin Has Been Deleted Successfully!!');
        return redirect()->route('admin/manage/user');
       }
   
  
}

      
      


  