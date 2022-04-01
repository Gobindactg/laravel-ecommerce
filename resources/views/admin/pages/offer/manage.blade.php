@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Manage Offer</li>
        </ol>
      </nav>
    </div>
@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Manage Category
        </div>
        <div class="card-body" >
        @include('admin.partial.message')
         <table class="table table-striped table-bordered table-hover text-center">
           <tr>
             <th>Category id</th>
             <th>Category Name</th>
             <th>Category Description</th>
             <th>Parent Category</th>
             <th>image</th>
             <th>Action</th>
           </tr>
           @foreach ($categories as $category)
           <tr>
             <td>{{$category->id}}</td>
             <td>{{$category->name}}</td>
             <td>{{$category->description}}</td>
             <td>@if($category->parent_id == NULL) Primary Category
               @else
               {{$category->parent->name}}
               @endif
             </td>
             <td><img style="width:50px" src="{{asset('assets/categoryImage/'.$category->image)}}" alt=""></td>
             <td>
               <a href="{{route('admin/category/edit', $category->id)}}" class="btn btn-outline-primary">Edit</a>
              <!-- start delete option -->
              <a href="#deleteModal{{ $category->id }}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
          
          <!-- Modal -->
          <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('admin/category/delete', $category->id)}}" method="post">
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
