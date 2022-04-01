@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Division</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Add Division</li>
        </ol>
      </nav>
    </div>
    
@section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header text-dark">
          Add Division
        </div>
        <div class="card-body" style="background-color:gray; padding:5px">
          <form action="{{ route('admin/division/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.partial.message')
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Division Name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Priority Number</label>
              <input name="priority" rows="8" cols="80" class="form-control" placeholder="Enter Your Priority Number"></input>

            </div>
          
            <button type="submit" class="btn btn-primary">Add Division</button>
          </form>
        </div>
      </div>

    </div>
  </div>
 
@endsection
