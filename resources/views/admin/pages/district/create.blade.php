@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage District</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Add District</li>
        </ol>
      </nav>
    </div>
    
@section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header text-dark">
          Add District
        </div>
        <div class="card-body" style="background-color:gray; padding:5px">
          <form action="{{ route('admin/district/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.partial.message')
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your District Name">
            </div>
            <div class="form-group py-2">
              <label for="exampleInputPassword1">Priority Number</label>
              <select name="division_id" id="" class="w-100 py-2">
              <option value="">-- Select Your District--</option>
                @foreach($division as $division)
                <option value="{{$division->id}}">{{$division->name}}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary ">Add District</button>
          </form>
        </div>
      </div>

    </div>
  </div>
 
@endsection
