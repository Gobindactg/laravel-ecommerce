@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Manage Admin</li>
        </ol>
      </nav>
    </div>
@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Manage Admin
        </div>
        <div class="card-body" >
        @include('admin.partial.message')
         <table class="table table-striped table-bordered table-hover text-center">
           <tr>
             <th>Admin id</th>
             <th>Name</th>
             <th>User Name</th>
             <th>Email</th>
             <th>image</th>
             <th>Status</th>
             <th>Action</th>
           </tr>
           @foreach ($admin as $Admin)
           <tr>
             <td>{{$Admin->id}}</td>
             <td>{{$Admin->name}}</td>
             <td>{{$Admin->user_name}}</td>
             <td>{{$Admin->email}}</td>
             <td><img style="width:50px" src="{{asset('assets/AdminImage/'.$Admin->image)}}" alt=""></td>
             <td>
                 @if($Admin->status == 0)
                   <h5 style="color: green">Active</h5>
                  @else
                  <h5 style="color: red">Deactive</h5>
                 @endif
               
             </td>
             <td>
               <a href="{{route('admin/manage/user/edit', $Admin->id)}}" class="btn btn-outline-primary">Edit</a>
              
               <a href="#statusModal{{ $Admin->id }}" data-toggle="modal" class="btn btn-outline-danger">Update Status</a>
          
               <!-- start Admin Status model -->
               <div class="modal fade" id="statusModal{{ $Admin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">
                     
                     </div>
                     <div class="modal-body">
                      <form action="{{ route('admin/manage/user/status', $Admin->id) }}" method="post" >
                        {{ csrf_field() }}
                        <div class="form-group">
                          <h4 class="text-primary">Select Admin Status</h4>
                          <select name="status" id="" class="form-select">
                            <option value="">--Select Admin Status--</option>
                              <option value="0">Active</option>
                              <option value="1">Deactive</option>
                          </select>
                          <div class="text-center py-2">
                            <button type="submit" class="btn btn-primary ">Update Admin Status</button>
                          </div>
                        </div>
                      </form>
                      <form action="{{ route('admin/manage/user/delete', $Admin->id)}}" method="post">
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
              <!-- End Admin Status model -->
{{-- 
              <!-- start permanent delete option -->
              <a href="#deleteModal{{ $Admin->id }}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
          
          <!-- Start Permanent Delete Modal -->
                  <div class="modal fade" id="deleteModal{{ $Admin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> 
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('admin/manage/user/delete', $Admin->id)}}" method="post">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger" >Permanent Delete</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div> --}}

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
