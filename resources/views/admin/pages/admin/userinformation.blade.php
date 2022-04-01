@extends('pages.users.dashboard')
@section('sub-content')
    @include('admin.partial.message')
    <div class="card">
    <div class="card-header">
      Basic Information 
    </div>
    <div class="card-body">
      <table class="table table-borded">
        <tr>
          <th class="w-25">Name</th>
          <th>{{$user->first_name . ' ' . $user->last_name}}</th>
        </tr>
        <tr>
          <th class="w-25">User Name</th>
          <th>{{$user->username}}</th>
        </tr>
        <tr>
          <th class="w-25">Email</th>
          <th>{{$user->email}}</th>
        </tr>
        <tr>
          <th class="w-25">Phone Number</th>
          <th>{{$user->phone_no}}</th>
        </tr>
        <tr>
          <th class="w-25">Address</th>
          <th>{{$user->street_address}}</th>
        </tr>
        <tr>
          <th class="w-25">Shipping Address</th>
          <th>{{$user->shipping_address}}</th>
        </tr>
      </table>
      </div>
    </div>
        @endsection
                      
    