@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit Product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Edit Product</li>
        </ol>
      </nav>
    </div>
    
@section('content')

  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          edit Product
        </div>
        <div class="card-body" style="background-color:gray; padding:5px">
          <form action="{{ route('admin.manage.update', $product->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.partial.message')
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$product->title}}">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea name="description" rows="8" cols="80" class="form-control" placeholder="Enter Your Product Description">{{$product->description}}</textarea>

            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Price</label>
              <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$product->price}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$product->quantity}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1"> Product Category </label>
              <select class="form-control" name="category_id" id="">
                <option value="">--Select Product Category--</option>
                @foreach ($category as $parent)
                <option value="{{$parent->id}}"@if($parent->id == $product->category->id) selected @endif > {{$parent->name}}</option>
                @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
                  <option value="{{$child->id}}" @if($child->id == $product->category->id) selected @endif> ==={{$child->name}}</option>
                @endforeach
              @endforeach
              </select>
            </div>
            
            <div class="form-group">
              <label for="exampleInputEmail1">Brand Category</label>
              <select class="form-control" name="brand_id" id="">
              <option value="">--Select Product Brand--</option>
              @foreach($main_brand as $brand)
              <option value="{{$brand->id}}" @if($brand->id = $product->brand->id) selected @endif >{{$brand->name}}</option>
              @endforeach
                
                </select>
           </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Product Image</label>
              <div class="row">
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image" id="product_image" >
                </div>
               <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
                <br>
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
              </div> 
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update Product</button>
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
@endsection
