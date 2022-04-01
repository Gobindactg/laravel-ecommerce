@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Add Offer</li>
        </ol>
      </nav>
    </div>
    
@section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header text-dark">
          Add Offer
        </div>
        <div class="card-body" style="background-color:gray; padding:5px">
          <form action="{{ route('admin/offer/create') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.partial.message')
            <div class="form-group py-2">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Offer title">
            </div>
         
            <div class="form-group py-2">
              <label for="exampleInputPassword1">Publication Status</label>
              <select class="form-control" name="parent_id" id="">
                <option value="">--Select Publication Status-</option>
                <option value="1">Published</option>
                <option value="0">Unpublished</option>
              </select>
            </div>
        
             <div class="form-group py-2">
              <label for="exampleInputEmail1">Offer Image</label>
              <div class="row">
                <div class="col-md-4">
                    <img style="width:150px; height:150px;" id="output"/>
                  <input type="file" class="form-control" name="offer_image" id="offer_image" accept="image/*" onchange="loadFile(event)" >
               </div>
              </div> 
            </div>
            <button type="submit" class="btn btn-primary">Add Offer</button>
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
