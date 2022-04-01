@extends('layout.master')
@section('content')
<div class="container">
    <div class="row">
    @include('partial.sidebar')
        <div class="col-md-9">
            <div class="row">
                 <div class="col-md-3">
                  <h2> <a href="{{route('blog.create')}}" class="btn btn-outline-primary">Create Blog</a></h2>
                </div>
                <div class="col-md-9">
                    <form action="{{route('blog.search')}}" method="get">
                        <div class="search w-100" >
                            <input type="text" placeholder="Enter Search Keyword" name="search">
                            <input type="submit" value="">
                        </div>
			        </form>
                </div>
            </div>
            @include('partial.message')
         @foreach ($blogs as $blog)   
            <div class="accordion accordion-flush" id="accordionFlushExample">
               
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#main{{$blog->id}}" aria-expanded="false" aria-controls="flush-collapseOne" style="font-size:20px">
                        {{$blog->title}}
                    </button>
                    <hr>
                    </h2>
                    <div id="main{{$blog->id}}" class="accordion-collapse collapse text-justify" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <img  style="width:250px" src="{{asset('assets/blogImage/'.$blog->image)}}"  alt=""><br>
                        <strong >{{$blog->description}}</strong><br>
                         <a href="{{route('blog.edit', $blog->id)}}" class="btn btn-outline-primary mx-2 my-2">Edit</a>
                        <a href="#deleteModal{{ $blog->id }}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
                       

                                        <!-- The Modal -->
                        <div class="modal" id="deleteModal{{ $blog->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> 
                                </button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('blog.delete', $blog->id)}}" method="post">
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

                        <!-- end delete model -->
                    </div>
                </div>
             </div>
        @endforeach
                   
        <div class="pagination" style="width:100%; font-size:25px; padding:0px 10px">
            {{$blogs->links()}}
        </div>
        </div>
        
    </div>
    

  
@endsection