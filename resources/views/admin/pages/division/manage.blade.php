@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Division</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Manage Division</li>
        </ol>
      </nav>
    </div>
@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Manage Division
        </div>
        <div class="card-body" >
        @include('admin.partial.message')
         <table class="table table-striped table-bordered table-hover text-center">
           <tr>
             <th>Division id</th>
             <th>Division Name</th>
             <th>Division Priority</th>
             <th>Action</th>
           </tr>
           @foreach ($division as $division)
           <tr>
             <td>{{$division->id}}</td>
             <td>{{$division->name}}</td>
             <td>{{$division->priority}}</td>
             <td>
               <a href="{{route('admin/division/edit', $division->id)}}" class="btn btn-outline-primary">Edit</a>
              <!-- start delete option -->
              <a href="#deleteModal{{ $division->id }}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
          
          <!-- Modal -->
          <div class="modal fade" id="deleteModal{{ $division->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('admin/division/delete', $division->id)}}" method="post">
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
