@extends('layout.master')

@section('content')
<div class="container card card-body ">
@include('admin.partial.message')
  <h2 style="font-family: tahoma; font-style:italic">Confirm Item</h2>
  <hr>
    
      <div class="card card-body">
        <div class="row ">
      <div class="col-md-12 border-right">
            <table class="table table-bordered table-stripe table-hover">
              <tr>
                <th style="width:100px">
                  Item Serial
                </th>
                <th>
                  Product Title
                </th>
                <th>
                  Product Image
                </th>
                <th>
                  Product Quantity
                </th>
                <th>
                  Product Unit Price
                </th>
                <th>
                  Sub Total Price
                </th>
              </tr>
              @foreach (App\Models\Cart::totalCarts() as $cart)
              <tr>
                <td>
                  {{$loop->index+1}}
                </td>
                <td>
                  {{$cart->product->title}} 
                </td>
                <td>
                  @if($cart->product->images->count() > 0)
                    <img src="{{asset('images/'. $cart->product->images->first()->image)}}" style="width: 50px" alt="Frist Slide">
                  @endif
                </td>
                <td>
                  {{$cart->product_quantity}} item
                </td>
                <td>
                  <strong>{{$cart->product->price}} Taka</strong>
                </td>
                <td>
                  <strong>{{$cart->product->price * $cart->product_quantity}} Taka</strong>
                </td>
              </tr>
              @endforeach
              <tr>
                <td colspan="5" class="text-right"><strong>Total Price</strong></td>
                <td class="text-left">
                  @php
                  $total_price = 0;
                 @endphp
                  @foreach (App\Models\Cart::totalCarts() as $cart)
                    @php
                        $total_price += $cart->product->price * $cart->product_quantity;
                    @endphp
                  @endforeach
                    <strong>{{$total_price}}</strong> Taka
                </td>
              </tr>
              <tr>
                <td colspan="5" class="text-right"><strong>Shipping Cost</strong></td>
                <td class="text-left">
                   <strong>{{App\Models\Setting::first()->shipping_cost}}</strong> Taka
                </td>
              </tr>
              <tr>
                <td colspan="5" class="text-right"><strong>Total Cost With shipping Cost</strong></td>
                <td class="text-left">
                  <strong>{{$total_price + App\Models\Setting::first()->shipping_cost}}</strong> Taka
                </td>
              </tr>
            </table>
            <a href="{{route('carts')}}" class="text-decoration-none btn btn-outline-info"><strong>Change Cart Items</strong> </a>
          </div>
    
    </div>
  </div>
    <div class="row card card-body">
      <div class="col-md-12">
      <h2>Shipping Address</h2>
      <form method="POST" action="{{route('checkouts.store')}}">
        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Receiver_Name') }}</label>
                            <div class="col-md-6">
                                <input id="user_name" name="user_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="user_name" value="@if(Auth::check()){{ Auth::user()->first_name . ' ' . Auth::user()->last_name}} @endif "  required autocomplete="user_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email (Not Changeable)') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="" value="@if (Auth::check()) {{ Auth::user()->email }} @endif " required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                   
                        <div class="row mb-3">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                              <input id="phone_no" type="phone_no" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" name="" value="@if (Auth::check()) {{ Auth::user()->phone_no }} @endif " required autocomplete="phone_no">

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                       
                       
                        <div class="row mb-3">
                            <label for="division_id" class="col-md-4 col-form-label text-md-end">{{ __('Shipping Address (*) ')}}</label>
                            <div class="col-md-6">
                               <textarea rows="5" cols="82" name="shipping_address"></textarea>

                                @error('Shipping_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                          <label for="division_id" class="col-md-4 col-form-label text-md-end">{{ __('Additional Message (optional) ')}}</label>
                          <div class="col-md-6">
                             <textarea rows="5" cols="82" name="message"></textarea>

                              @error('Shipping_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                        <div class="row mb-3">
                            <label for="division_id" class="col-md-4 col-form-label text-md-end">{{ __('Payment Method')}}</label>
                            <div class="col-md-6">
                              <select name="payment_method_id"  required class="form-control" id="payments">
                                <option value="">--Select a Payment Method Please</option>
                                @foreach ($payments as $payment)
                                <option value="{{$payment->short_name}}">{{$payment->name}}</option>
                                @endforeach
                              </select>

                              @foreach ($payments as $payment)
                              
                                @if($payment->short_name == "cash")

                                  <div id="payment_{{$payment->short_name}}" class="hidden ">
                                    <div class="card card-body text-center my-2 ">
                                      <img src="{{asset('assets/payment/cash_in.png')}}" alt="" width="200px" style="margin:0 auto">
                                      <h3 class="text-center card card-body">For Cash in there is nothing neccessary . <br> Just Click Finish Order</h3>
                                      <p class="text-center">You Will get your product in two or three working days</p>
                                      <h3 class="text-center py-2 card card-body">Thanks For Choosing Us</h3>
                                    </div>
                                  </div>
                              
                                  
                                @elseif($payment->short_name == "bkash")
                                  <div id="payment_{{$payment->short_name}}" class="hidden " >
                                    <div class="card card-body text-center ">
                                      <img src="{{asset('assets/payment/bkash.gif')}}" alt="" width="400px" style="margin:0 auto">
                                      <div class="card card-body my-1">
                                       <p><span><strong>Invoice No : #5695</strong></span> || <span>Total Cost : <strong>{{$total_price + App\Models\Setting::first()->shipping_cost}}</strong> Taka</span></p>
                                     </div>
                                      <div class="card card-body" style="background-color: #E91E63; color:white">
                                        <h4 class="py-2"><strong>{{$payment->name}} No : {{$payment->no}}</strong></h4>
                                        <h5><strong>Account Type : {{$payment->type}}</strong></h5>
                                      </div>      
                                    </div>
                                  </div>

                                  @elseif($payment->short_name == "roket")
                                  <div id="payment_{{$payment->short_name}}" class="hidden">
                                    <div class="card card-body text-center my-2 ">
                                      <img src="{{asset('assets/payment/Rocket.png')}}" alt="" width="200px" style="margin:0 auto">
                                      <div class="card card-body my-1">
                                        <p><span><strong>Invoice No : #5695</strong></span> || <span>Total Cost : <strong>{{$total_price + App\Models\Setting::first()->shipping_cost}}</strong> Taka</span></p>
                                      </div>
                                       <div class="card card-body my-1" style="background-color: #b510c7 ; color:white">
                                         <h4 class="py-2"><strong>{{$payment->name}} No : {{$payment->no}}</strong></h4>
                                         <h5><strong>Account Type : {{$payment->type}}</strong></h5>
                                       </div>
                                    </div>
                                  </div>
                              
                                @endif
                                @endforeach
                                <div class="hidden my-1" id="payment_method_id">
                                  <input type="text" class="form-control" name="transaction_id" placeholder="Please Enter Your Transaction Code">
                              </div>
                              </div>
                              <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Order Now
                                    </button>
                                </div>
                            </div>
                              
                            </div>
                        </div>
                    </form>
    </div>
  </div>
 
@endsection
@section('scripts')

<script type="text/javascript">
  $(document).ready(function(){
    $("#payments").change(function(){
      $payment_method = $("#payments").val();

      if($payment_method == "cash"){
        $("#payment_cash").removeClass('hidden');
        
        $("#payment_bkash").addClass('hidden');
        $("#payment_roket").addClass('hidden');
        
      } else if ($payment_method == "bkash"){
        $("#payment_bkash").removeClass('hidden');
        $("#payment_method_id").removeClass('hidden');
        $("#payment_cash").addClass('hidden');
        $("#payment_roket").addClass('hidden');
      }
       else if ($payment_method == "roket"){
        $("#payment_roket").removeClass('hidden');
        $("#payment_method_id").removeClass('hidden');
        $("#payment_bkash").addClass('hidden');
        $("#payment_cash").addClass('hidden');
      }


  
    });
  });
  

  // animation start here
  $(".part1").waypoint(function(){
    $(".part1").addClass('animated adeInLeft')
  }, {
    offset:'50%'
  })
    
    </script>
@endsection