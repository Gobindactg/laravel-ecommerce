@extends('pages.users.dashboard')
@section('sub-content')
    @include('admin.partial.message')
    <div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('profile/update', $user->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="col-md-6">
             <div class="form-group">
              <label for="exampleInputEmail1">User New Image</label>
              <div class="row py-2">
                <div class="col-md-4">
                <div style="padding:5px 0px">
                  <img style="width:150px; height:150px;" id="output"/>
                </div>
                  <input type="file" class="form-control" name="user_image" id="user_image" accept="image/*" onchange="loadFile(event)" >
               </div>
              </div> 
            </div>
             </div>
             <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">User Old Image</label>
                <div class="row py-2">
                  <div class="col-md-12">
                  <img style="width:150px" src="{{asset('assets/userImage/' . $user->image)}}" alt="">
                  </div>
                </div> 
              </div>
             </div>
           </div>
            <button type="submit" class="btn btn-primary">Update User Image</button>
          </form>
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
                      
    