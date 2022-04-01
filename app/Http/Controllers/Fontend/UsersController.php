<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Division;
use App\Models\District;
class UsersController extends Controller
{
  

   public function dashboard()
   {
       $user = Auth::user();
       return view('pages.users.userinformation', compact('user'));
   }
   public function dashboard_profile()
   {
        $division = Division::orderBy('priority', 'asc')->get();
        $district= District::orderBy('id', 'asc')->get();
       $user = Auth::user();
       return view('pages.users.userinfo')->with('user', $user)->with('division', $division)->with('district', $district);
   }
   public function dashboard_image()
   {   
       $user = Auth::user();
       return view('pages.users.imageupload', compact('user'));
   }
 
}
