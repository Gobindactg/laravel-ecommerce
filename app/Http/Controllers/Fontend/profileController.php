<?php

namespace App\Http\Controllers\Fontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;// this function use for data add from database
use App\Models\ProductImage;
use Image;
use File;
use Illuminate\Support\Facades\Hash;
use App\Models\Division;
use App\Models\District;
use App\Models\User;
use Auth;

class profileController extends Controller
{
 
    public function user_edit($id)
    {
      $user = User::find($id);
   
      return view('partial.user_image')->with('user', $user);
    }

    public function profile_update(Request $request, $id)
    {
      $user = User::find($id);
      if ($request->hasFile('user_image')) {
        // old image delete
         if (File::exists('assets/userImage/' . $user->image)) {
              File::delete('assets/userImage/' . $user->image);
            }
            //insert that image
            $image = $request->file('user_image');
            $img = time() . '.'. $image->getClientOriginalExtension();
            $location = public_path('assets/userImage/' .$img);
            Image::make($image)->save($location);
            $user->image = $img;
        }
      $user->save();
      session()->flash('success', 'Your Image has Updated successfully !!');
      return back();
    }

    // profile information

    public function dashboard($id)
    {
      $user = User::find($id);
      $division = Division::orderBy('priority', 'asc')->get();
      $district= District::orderBy('id', 'asc')->get();
   
      return view('partial.dashboard')->with('user', $user)->with('division', $division)->with('district', $district);
    }

    public function info_update(Request $request, $id)
    { 
      $user = User::find($id);
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->username = $request->user_name;
      $user->phone_no = $request->phone_no;
      $user->street_address = $request->street_address;
      $user->division_id = $request->division_id;
      $user->district_id = $request->district_id;
      $user->shipping_address = $request->shipping_address;
      if($request->password !=NULL || $request->password !=''){
        $user->password = Hash::make($request->password);
      }
      
      $user->save();
      session()->flash('success', 'Your Profile has updated successfully !!');
      return back();
    }
      
}

  