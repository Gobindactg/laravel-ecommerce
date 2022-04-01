@extends('admin.layout.adminmaster')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Manage Orders</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Total Order</li>
        </ol>
      </nav>
    </div>
    
@section('content')

<div class="main-panel">
  <div class="content-wrapper">

    <div class="card">
      <div class="card-header">
        <h3>View Order #BD{{$order->id}}</h3>
      </div>
      <div class="card-body" >
      @include('admin.partial.message')
      <h3>Orders Information</h3>
     <div class="row">
       <div class="col-md-6">
        <p><strong>Customer Name : </strong>{{$order->name}}</p>
        <p><strong>Customer Email : </strong> {{$order->email}}</p>
        <p><strong>Customer Phone : </strong>{{$order->phone_no}}</p>
        <p><strong>Customer Shipping Address : </strong>{{$order->shipping_address}}</p>
       </div>
       <div class="col-md-6">
        <p><strong>Order Payment Method : </strong> {{$order->payment->name}}</p>
        <p><strong>Order Payment transaction : </strong> @if ($order->transaction_id == NULL)
            Not Applicable
            @else
            {{$order->transaction_id}}</p>
             @endif
       </div>
       <hr>
       <h3>Orders Item</h3>
       @if ($order->carts->count() > 0)
       
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
        @foreach ($order->carts as $cart)
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
                        
               <strong>Sub Total Amount</strong> 
          
            </td>
            <td>
                @if ($order->count() > 0)
                        
                <strong>BDT {{$total_price}}</strong> 
             @else

            @endif
                
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
               
                 @if ($order->count() > 0)
                        
                    <strong>Shipping Charge</strong> 
                 @else
                   <h3><strong>There is no shipping_charge</strong> </h3>
                
                @endif
            </td>
            <td>
                @if ($order->count() > 0)
                        
                <strong>BDT {{$order->shipping_charge}}</strong> 
             @else

            @endif
                
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
               
                 @if ($order->count() > 0)
                        
                    <strong>Discount</strong> 
                 @else
                   <h3><strong>There is no Discount</strong> </h3>
                
                @endif
            </td>
            <td>
                @if ($order->count() > 0)
                        
                <strong>BDT {{$order->custom_discount}}</strong> 
             @else

            @endif
                
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                    <strong>Total Amount</strong> 
             </td>
            <td>
                @if ($order->count() > 0)
                
                <strong>BDT {{$total_price + $order->shipping_charge - $order->custom_discount}}</strong> 
             @else

            @endif
                
            </td>
        </tr>
       
    </table>
    @endif
    <hr>
    <form action="{{route('admin.order.charge', $order->id)}}" method="post">
      @csrf
      <label for=""><strong>Shipping Cost</strong> </label>
      <input type="number" name="shipping_charge" value="60" id="shipping_charge" class="form-control" style="width:300px">
    <br>
      <label for=""><strong>Custom Discount</strong> </label>
      <input type="number" name="custom_discount" value="0" id="custom_discount" class="form-control" style="width:300px">
      <br>
      <input type="submit" name="" value="Update" id="" class="btn btn-primary">
      <a href="{{route('admin.order.invoice', $order->id)}}" class="btn btn-info">Generate Invoice</a>
    </form>
    <hr>
    <div class="form-inline">
        <form action="{{route('admin.order.completed', $order->id)}}" method="post" class="form-inline">
          @csrf
          @if($order->is_completed)
          <input type="submit" value="Cancel Order" class="btn btn-danger" name="" id="">
          @else
          <input type="submit" value="Complete Order" class="btn btn-success" name="" id="">
          @endif
        </form>

        <form action="{{route('admin.order.paid', $order->id)}}" method="POST" class="form-inline">
          @csrf
          @if($order->is_paid)
          <input type="submit" value="UnPaid Order" class="btn btn-danger" name="" id="">
          @else
          <input type="submit" value="Paid Order" class="btn btn-success" name="" id="">
          @endif
        </form>
    </div>
     </div>
      </div>
    </div>

  </div>
</div>

@endsection