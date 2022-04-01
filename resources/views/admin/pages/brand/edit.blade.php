@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Edit Category</li>
        </ol>
      </nav>
    </div>
    
@section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header text-dark">
          Edit Category
        </div>
        <div class="card-body" style="background-color:gray; padding:5px">
          <form action="{{ route('admin/category/update', $brand->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.partial.message')
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brand->name}}">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control" placeholder="Enter Your Product Description">{{$brand->description}}</textarea>

            </div>
          
           <div class="row">
             <div class="col-md-6">
             <div class="form-group">
              <label for="exampleInputEmail1">Category New Image</label>
              <div class="row py-2">
                <div class="col-md-4">
                <div style="padding:5px 0px">
                  <img style="width:150px; height:150px;" id="output"/>
                </div>
                  <input type="file" class="form-control" name="category_image" id="product_image" accept="image/*" onchange="loadFile(event)" >
               </div>
              </div> 
            </div>
             </div>
             <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Category Old Image</label>
                <div class="row py-2">
                  <div class="col-md-12">
                  <img style="width:150px" src="{{asset('assets/brandImage/'.$brand->image)}}" alt="">
                  </div>
                </div> 
              </div>
             </div>
           </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
          </form>
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
