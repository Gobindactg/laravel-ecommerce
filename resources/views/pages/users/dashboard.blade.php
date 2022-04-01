@extends('layout.master')
@section('content')
<div class="container ">
  <div class="row ">
    <div class="col-md-4">
      <div class="card text-center">
      <div class="card-header">
      <h4 class="text-center text-info "> WELCOME <br> <span style="font-family:tahoma; font-style:italic; color:#fb4d01">{{$user->first_name}}  {{$user->last_name}}</span></h4>
      </div>
        <div class="card-body">
            @php
                $users_id = Auth::user()->id;
                  $users_avatar = Auth::user()->image;
                @endphp
            @php
              if($users_avatar == NULL){
            @endphp
              <a href="{{route('profile', $users_id)}}" title="Change Image"><img src="{{asset('assets/userImage/default/user.png')}}" class="image rounded-circle" style="width:150px" ></a>
            @php
              }else{
            @endphp
              <a href="{{route('profile', $users_id)}}" title="Change Image"><img src="{{asset('assets/userImage/' . $users_avatar)}}" class="image rounded-circle" style="width:150px" ></a>
            @php
              }
          @endphp<br>
          
        </div>
      <div class="card-footer text-muted">
      <ul class="list-group dashboard_hover">
        <li class="list-group-item {{Route::is('users/dashboard') ? 'active' : ''}}"><a href="{{route('users/dashboard')}}" >Dashboard</a></li>
        <li class="list-group-item {{Route::is('users/dashboard/profile') ? 'active' : ''}}" ><a href="{{route('users/dashboard/profile')}}" >Profile Update</a></li>
        <li class="list-group-item {{Route::is('users/dashboard/image') ? 'active' : ''}}"><a href="{{route('users/dashboard/image')}}" >Profile Image Update</a></li>
        <li class="btn btn-outline-danger my-1">
        <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
        </li>
        <li class="list-group-item social_hover" style="font-size:25px">
            <a href="#" class="fa fa-facebook px-2" ></a>
            <a href="#" class="fa fa-instagram px-2" ></a>
            <a href="#" class="fa fa-twitter px-2" ></a>
            <a href="#" class="fa fa-whatsapp px-2" ></a>
            <a href="#" class="fa fa-linkedin px-2" ></a>
        </li>
    </ul>
     
    </div>
  </div>
  </div>
    <div class="col-md-8">
        @yield('sub-content')
    </div>
  </div>
        @endsection