
@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit Division</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Edit Division</li>
        </ol>
      </nav>
    </div>
    
@section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header text-dark">
          Edit Division
        </div>
        <div class="card-body" style="background-color:gray; padding:5px">
          <form action="{{ route('admin/division/update', $division->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.partial.message')
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$division->name}}">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Priority Number</label>
              <input name="priority" rows="8" cols="80" class="form-control" placeholder="Enter Your Priority Number" value="{{$division->priority}}"></input>

            </div>
          
         
            <button type="submit" class="btn btn-primary">Update Division</button>
          </form>
        </div>
      </div>

    </div>
  </div>
 
  
@endsection
