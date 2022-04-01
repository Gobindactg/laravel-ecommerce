@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Add Category</li>
        </ol>
      </nav>
    </div>
    
@section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header text-dark">
          Add Category
        </div>
        <div class="card-body" style="background-color:gray; padding:5px">
          <form action="{{ route('admin/category/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.partial.message')
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Product title">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control" placeholder="Enter Your Product Description"></textarea>

            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Parent Category</label>
              <select class="form-control" name="parent_id" id="">
                <option value="">--Select Primary Category--</option>
                @foreach($main_categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                
              </select>
            </div>
        
             <div class="form-group">
              <label for="exampleInputEmail1">Product Image</label>
              <div class="row">
                <div class="col-md-4">
                  <input type="file" class="form-control" name="category_image" id="product_image" >
                </div>
              
              </div> 
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
          </form>
        </div>
      </div>

    </div>
  </div>
 
@endsection
