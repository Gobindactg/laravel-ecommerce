@extends('layout.master')
@section('content')
<div class="container">
    <div class="card">
        <h3 class="card-title text-center" style="font-family: tahoma; font-style:italic">My Cart Details</h3>
    </div>
    <table class="table table-bordered table-stripe text-center">
        <tr>
            <th>Serial No</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th> Product Quantity </th>
            <th>Unit Price</th>
            <th>Sub Total</th>
            <th>Action</th>
        </tr>
        @php
        $total_price = 0;
        @endphp
        @foreach (App\Models\Cart::totalCarts() as $cart)
        <tr>
           <td>{{$loop->index+1}}</td>
           <td><strong> <a href="{{route('products.show', $cart->product->slug)}}" style="text-decoration: none">{{$cart->product->title}}</a> </strong></td>
           <td>
         
            @if($cart->product->images->count() > 0)
                <img src="{{asset('images/'. $cart->product->images->first()->image)}}" style="width: 50px" alt="Frist Slide">
            @endif
           </td>
           <td>
            <form action="{{route('carts.update', $cart->id)}}" class="form-inline" method="post">
                @csrf
                <input type="number" name="product_quantity" class="form-control" value="{{$cart->product_quantity}}">
                <button type="submit" class="btn btn-success">Update</button>
            </form>
           </td>
           <td>BDT {{$cart->product->price}}</td>
           <td>
               @php
               $total_price += $cart->product->price * $cart->product_quantity;
               @endphp
                BDT {{$cart->product->price * $cart->product_quantity}}
            </td>
           <td>
            <form action="{{route('carts.delete', $cart->id)}}" class="form-inline" method="post">
                @csrf
                <input type="hidden" name="cart_id">
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
           </td>
        </tr>
      
        @endforeach
        <tr>
            <td colspan="5" class="text-right">
               
                 @if (App\Models\Cart::totalCarts()->count() > 0)
                        
                    <strong>Total Amount</strong> 
                 @else
                   <h3><strong>There is no Item in your Cart</strong> </h3>
                
                @endif
            </td>
            <td>
                @if (App\Models\Cart::totalCarts()->count() > 0)
                        
                <strong>BDT {{$total_price}}</strong> 
             @else

            @endif
                
            </td>
        </tr>
       
    </table>
    <div class="float-end my-2">
        <a href="{{route('products')}}" class="btn btn-info btn-lg ">Continue Shipping...</a>
        <a href="
        @if (App\Models\Cart::totalCarts()->count() > 0)
        {{route('checkouts')}}
        @else
        {{route('products')}}
        @endif
        " class="btn btn-warning  btn-lg ml-3">Checkout</a>
    </div>
</div>

@endsection