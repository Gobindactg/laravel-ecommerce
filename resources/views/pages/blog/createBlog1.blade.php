@extends('layout.master')

@section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Blog
        </div>
        <div class="card-body" style="background-color:gray; padding:5px">
          <form action=""{{ route('blog.store') }}"" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('partial.message')
            <div class="form-group">
              <label for="exampleInputEmail1">Blog Title</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Blog Title">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Blog Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control" placeholder="Enter Your Blog Description"></textarea>

            </div>
          
             <div class="form-group">
              <label for="exampleInputEmail1">Blog Image</label>
              <div class="row">
                <div class="col-md-4">
                  <input type="file" class="form-control" name="blog_image" id="blog_image" >
                </div>
          
              </div> 
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit Blog</button>
          </form>
        </div>
      </div>

    </div>
  </div>
 
@endsection
