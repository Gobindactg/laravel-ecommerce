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
          Manage Product
        </div>
        <div class="card-body" >
        @include('admin.partial.message')
         <table class="table table-striped table-bordered table-hover text-center display" id="dataTable">
          <thead>
            <tr>
              <th>Product id</th>
              <th>Product Title</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($products as $product)
           <tr>
             <td>{{$product->id}}</td>
             <td>{{$product->title}}</td>
             <td>{{$product->price}}</td>
             <td>{{$product->quantity}}</td>
             <td>
               <a href="{{route('admin.manage.edit', $product->id)}}" class="btn btn-outline-primary">Edit</a>
              <!-- start delete option -->
              <a href="#deleteModal{{ $product->id }}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
          
          <!-- Modal -->
          <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('admin.manage.delete', $product->id)}}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger" >Permanent Delete</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
            </td>
           </tr>
          </tbody>
           @endforeach
           <tfoot>
            <tr>
              <th>Product id</th>
              <th>Product Title</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
           </tfoot>
         </table>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
