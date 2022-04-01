@extends('layout.master')
@section('content')
<div class="container">
  <div class="row">
    
    @include('partial.sidebar')
   
    <div class="col-md-9">
    <h2 >All Product In <span class="badge bg-primary"> {{$category->name}} Categorys</span> </h2>
<div class="row ">
  @php
    $products = $category->products()->paginate(9);
  @endphp
  @if($products->count() > 0)
  @foreach ($products as $product)
      <div class="col-md-4 py-2">
          <div  style="width:100%; margin:10px 0px;" >
              <!-- <img src="{{asset('product/mobile.png')}}" class="card-img-top" style="height:200px;" alt="..."> -->
              @php  $i = 1; @endphp  <!--this loop use for add one image for one product-->
            
            <!--this loop use for add one image for one product-->
              @foreach ($product->images as $image)
              @if($i >0)
              <a href="{{route('products.show', $product->slug)}}" >
                  <img src="{{asset('images/'.$image->image)}}" class="card-img-top " alt="{{$product->title}}" style="width:100%; height:300px">
                </a>
                  @endif
                  @php  $i--;  @endphp<!--this loop use for add one image for one product-->
              @endforeach
              <div class="card-body text-center">
              <a href="{{route('products.show', $product->slug)}}" style="text-decoration:none;"> <h3 class="card-text text-center">{{$product->title}}</h3></a>
            
              <span class="card-text text-center py-2">BDT : {{$product->price}}</span>
              <p class="card-text text-center">Stock Avaiable : {{$product->quantity}}</p>
              <a href="{{route('products.show', $product->slug)}}" class="btn btn-primary ">Details</a>
              <a href="#" class="btn btn-primary ">Add Card</a>
            </div>
          </div>
      </div>
      
      @endforeach

      @else
      <div class="alert alert-warning">
       <h4 class="text-danger">No  Product has added yet in this category!!</h4> 
      </div>
      @endif
  </div>

</div>
    </div>
  </div>

@endsection