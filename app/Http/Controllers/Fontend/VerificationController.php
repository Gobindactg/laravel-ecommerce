<?php

namespace App\Http\Controllers\Fontend;
use App\Http\Controllers\Controller;
use App\Models\User;// this function use for data add from database
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($token){
        $user = User::where('remember_token', $token)->first();
        if (!is_null($user)){
            $user->status = 1;
            $user->remember_token = NULL;
            $user->save();
            session()->flash('success', 'You are registered successfully !! Please Login');
            return redirect('login');
        }else{
            session()->flash('errors', 'Sorry !! Your Token Code does not match!! ');
            return redirect ('/');
        }
        
}
}