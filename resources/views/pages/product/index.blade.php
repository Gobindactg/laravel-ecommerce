@extends('layout.master')



@section('content')
    <div class="container">
        @include('admin.partial.message')
        <div class="row ">
            @foreach ($products as $product)
                <div class="col-md-3 py-2">
                    <div style="width:100%; margin:10px 0px;">
                        <!-- <img src="{{ asset('product/mobile.png') }}" class="card-img-top" style="height:200px;" alt="..."> -->
                        @php  $i = 1; @endphp
                        <!--this loop use for add one image for one product-->

                        <!--this loop use for add one image for one product-->
                        @foreach ($product->images as $image)
                            @if ($i > 0)
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <img src="{{ asset('images/' . $image->image) }}" class="card-img-top "
                                        alt="{{ $product->title }}" style="width:80%; height:200px">
                                </a>
                            @endif
                            @php  $i--;  @endphp
                            <!--this loop use for add one image for one product-->
                        @endforeach
                        <div class="card-body text-center">
                            <a href="{{ route('products.show', $product->slug) }}"
                                style="text-decoration:none; color:black">
                                <h3 class="card-text text-center">{{ $product->title }} </h3>
                            </a>

                            <span class="card-text text-center py-2">BDT : {{ $product->price }}</span>
                            <p class="card-text text-center">Stock Avaiable : {{ $product->quantity }}</p>

                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary my-1 ">Details</a>

                            @include('partial.cart-button')



                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
