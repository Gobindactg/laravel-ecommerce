<div class="bg-light py-2">
    <div class="container">
    <div class="brand">
        <span style="font-size:25px"><a href="{{route('home')}}" style="text-decoration:none">LaraEcommerce</a></span> 
    
    <div class="sign_up" style="float:right">

				
					<a href="{{route('carts')}}" class="btn btn-danger" ><i class="fa fa-shopping-cart" style="font-size: 20px; padding-right:5px"></i> <span  class=" badge bg-warning text-dark" id="totalItem">{{App\Models\Cart::totalItem()}}</span></a>
					<a href="#" class="btn btn-danger" ><i class="fa fa-credit-card" style="font-size: 20px; padding-right:5px"></i> <span  class=" badge bg-warning text-dark" id="totalItem">
						@php
						$total_price = 0;
					@endphp
						@foreach (App\Models\Cart::totalCarts() as $cart)
						@php
							$total_price += $cart->product->price * $cart->product_quantity;
						@endphp
						@endforeach
						<strong>{{$total_price}}</strong> Taka</span>
					</a>
		 <!-- Authentication Links -->
					 @guest
                            @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-outline-primary px-3"> {{ __('Login') }}</a>
                            @endif

                            @if (Route::has('register'))
                                    <a class="btn btn-outline-primary px-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                          @endif
                        @else
								@php
									$users_id = Auth::user()->id;
									$users_avatar = Auth::user()->image;
								@endphp
								@php
								if($users_avatar == NULL){
								@endphp
									<a href="{{route('profile', $users_id)}}" title="Change Image"><img src="{{asset('assets/userImage/default/user.png')}}" class="image rounded-circle" style="width:50px" ></a>
								@php
								}else{
								@endphp
									<a href="{{route('profile', $users_id)}}" title="Change Image"><img src="{{asset('assets/userImage/' . $users_avatar)}}" class="image rounded-circle" style="width:50px" ></a>
								@php
								}
								@endphp
								
							 	<a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-outline-info mx-2" href="#" role="button" data-bs-toggle="dropdown" style="float:right" aria-haspopup="true" aria-expanded="false" v-pre >
								{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
									</a>

                                <div class="dropdown-menu dropdown-menu-end " style="width:100px; padding:0px 5px" aria-labelledby="navbarDropdown">
									
                                    <!-- <a class="btn btn-outline-primary w-100 my-1"  href="{{route('profile/dashboard', $users_id)}}">
                                       
                                        {{ __('Profile') }}
                                    </a> -->
									<a class="btn btn-outline-primary w-100 my-1" href="{{ route('users/dashboard') }}">{{ __(' My Dashboard') }}</a>

                                    <a class="btn btn-outline-danger w-100 my-1"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                           
                        @endguest
				</ul>

      </div>
    </div>
    </div>
</div>
<div class="header_bottom">
	<div class="container">
	 <div class="header_bottom-box">
		<div class="header_bottom_left">
			<div class="logo">
				<a href="index.html"><img src="{{asset('images/logo.png')}}" alt=""/></a>
			</div>
			<ul class="clock">
				<i class="clock_icon"> </i>
				<li class="clock_desc">Justo 24/h</li>
			</ul>
			<div class="clearfix"> </div>
		</div>
		<div class="header_bottom_right">
			<form action="{{route('search')}}" method="get">
				<div class="search">
				<input type="text" placeholder="Enter Search Keyword" name="search">
				<input type="submit" value="Search" style="font-size:20px; color:white; padding:9px 12px; margin:0px">
				</div>
			  </form>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
</div>