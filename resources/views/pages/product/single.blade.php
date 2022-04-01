@extends('layout.master')

@section ('title')

{{$product->title}} || Laravel Ecommerce
@endsection

@section('content')

<div class="container">
<div class="row">
  <div class="col-md-4">
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner ">
    @php $i = 1; @endphp
    @foreach ($product->images as $image)
    <div class="carousel-item {{$i == 1 ? 'active':''}}">
      <img src="{{asset('images/'.$image->image)}}" class="d-block w-100" alt="Frist Slide">
    </div>
    @php $i++; @endphp
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
 </div>
 <div class="col-md-8 px-3 ">
   <h2>{{$product->title}}
   <span class="badge bg-primary"> 
     {{$product->quantity < 1 ? 'No Item Is Avaiable !!' : $product->quantity .' item in Stock ' }}
   </span> </h2>
   <h5> Category <a href="#"><span class="badge bg-info">{{$product->category->name}}</span></a>  Brand : <a href="#"><span class="badge bg-info"> {{$product->brand->name}}</span></a> </h5>
   <p class="text-justify ">{{$product->description}}</p>
   <h3> BDT : {{$product->price}}</h3>
     <div class="form-group">
        <label for="exampleInputEmail1">Quantity</label>
        <input type="number" class="form-control" name="quantity" id="exampleInputEmail1" aria-describedby="emailHelp" style="width:150px" placeholder=1>
      </div>
   <a href="#" class="btn btn-lg btn-primary my-1">Buy Now</a><span></span>
   @include('partial.cart-button')
 </div>
</div>
</div>
<!-- 



<div class="container">

<div class="row ">

    <div class="col-md-3 py-2">
       
            <div class="card-body text-center">
            <h3 class="card-text text-center">{{$product->name}}</h3>
            <p class="card-text text-center">{{$product->description}}</p>
            <p class="card-text text-center">BDT : {{$product->price}}</p>

            <a href="#" class="btn btn-primary ">Details</a>
            <a href="#" class="btn btn-primary ">Add Card</a>
          </div>
        </div>
    </div>
  </div>

</div> -->
@endsection