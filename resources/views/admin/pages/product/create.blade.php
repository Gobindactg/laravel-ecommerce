@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Manage Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Add Product</li>
            </ol>
        </nav>
    </div>

    @section('content')
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="card">
                    <div class="card-header">
                        Add Product
                    </div>
                    <div class="card-body" style="background-color:gray; padding:5px">
                        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include('admin.partial.message')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter Your Product title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea name="description" rows="8" cols="80" class="form-control"
                                    placeholder="Enter Your Product Description"></textarea>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" class="form-control" name="price" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter Product Price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input type="number" class="form-control" name="quantity" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter Product quantity">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Product Category </label>
                                <select class="form-control" name="category_id" id="">
                                    <option value="">--Select Product Category--</option>
                                    @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', null)->get()
        as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get()
        as $child)
                                            <option value="{{ $child->id }}">---------{{ $child->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Category</label>
                                <select class="form-control" name="brand_id" id="">
                                    <option value="">--Select Product Brand--</option>
                                    @foreach ($brand as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Publish Category</label>
                             <select name="publish_category" id="" class="form-control">
                               <option value=""> --Select Published Category--</option>
                               <option value="1">Best Seller</option>
                               <option value="2"> Promotion</option>
                               <option value="3"> Offer</option>
                               <option value="4"> Discount</option>
                             </select>
                          </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Image</label>
                                <div class="row">
                                    <div class="col-md-4 py-1">
                                        <input type="file" class="form-control" name="product_image[]" id="product_image">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="product_image[]" id="product_image">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="product_image[]" id="product_image">
                                    </div>
                                    <br>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="product_image[]" id="product_image">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="product_image[]" id="product_image">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="product_image[]" id="product_image">
                                    </div>
                                </div>
                            </div>
                            <div class="py-2">
                                <button type="submit" class="btn btn-primary ">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endsection
