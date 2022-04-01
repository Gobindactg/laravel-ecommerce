@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Brand</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Manage Brand</li>
        </ol>
      </nav>
    </div>
@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Manage Brand
        </div>
        <div class="card-body" >
        @include('admin.partial.message')
         <table class="table table-striped table-bordered table-hover text-center">
           <tr>
             <th>Brand id</th>
             <th>Brand Name</th>
             <th>Brand Description</th>
             <th>image</th>
             <th>Action</th>
           </tr>
           @foreach ($brand as $brand)
           <tr>
             <td>{{$brand->id}}</td>
             <td>{{$brand->name}}</td>
             <td>{{$brand->description}}</td>
             <td><img style="width:50px" src="{{asset('assets/brandImage/'.$brand->image)}}" alt=""></td>
             <td>
               <a href="{{route('admin/brand/edit', $brand->id)}}" class="btn btn-outline-primary">Edit</a>
              <!-- start delete option -->
              <a href="#deleteModal{{ $brand->id }}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
          
          <!-- Modal -->
          <div class="modal fade" id="deleteModal{{ $brand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('admin/brand/delete', $brand->id)}}" method="post">
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
           @endforeach
         </table>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection
