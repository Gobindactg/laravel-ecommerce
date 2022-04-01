@extends('layout.master')
@section('content')
<div class="container">
    <div class="row">
    @include('partial.sidebar')
        <div class="col-md-9" >
          <h2> <a href="{{ route('blog.create') }}" class="btn btn-outline-primary">Create Blog</a></h2>
           
               <div class="main-panel">
                <div class="content-wrapper">

                <div class="card">
                    
                    <div class="card-body" style="background-color:gray; padding:5px">
                    <form action="{{ route('blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('partial.message')
                        <div class="form-group">
                        <label for="exampleInputEmail1">Blog Title</label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$blog->title}}">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Blog Description</label>
                        <textarea name="description" rows="8" cols="80" class="form-control" >{{$blog->description}}"</textarea>

                        </div>
                    
                        <div class="form-group">
                        <label for="exampleInputEmail1">Blog Image</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Blog New Image</label>
                                        <div class="row py-2">
                                            <div class="col-md-4">
                                                <div style="padding:5px 0px">
                                                    <img style="width:150px; height:150px;" id="output"/>
                                                </div>
                                                <input type="file" class="form-control" name="blog_image" id="product_image" accept="image/*" onchange="loadFile(event)" >
                                            </div>
                                         </div> 
                                    </div>
                                </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Old Image</label>
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <img style="width:150px" src="{{asset('assets/blogImage/'.$blog->image)}}" alt="">
                                        </div>
                                    </div> 
                            </div>
                         </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Blog</button>
                    </form>
                    </div>
                </div>

                </div>
            </div>
        </div>
</div>
  <script type="text/javascript">
        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
       output.onload = function() {
       URL.revokeObjectURL(output.src) 
           }
         };
    </script>
@endsection