<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Auth;

use App\Models\ClientBlog;
use Image;
class AdminController extends Controller


{

  public function admin()
  {
      return view('admin.index');
    }
  public function welcome()
  {
      return view('admin.welcome');
    }

  public function blog()
  {
      return view('admin.partial.blog');
    }
  
 
  
}
