@extends('layout.master')
<style>
	.clock {
	  text-align: center;
	  font-size: 40px;
	  margin-top: 0px;
	}
	</style>
@section('content')
    @include('admin.partial.message')
    <div class="container">
        <div class="row">

            {{-- @include('partial.sidebar') --}}

            <div class="col-md-12">
                <div class="index_slider">
                    <div class="callbacks_container">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <!-- <div class="carousel-indicators">
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> -->
                            <div class="carousel-inner ">
                                @php $i = 1; @endphp
                                @foreach ($offer as $image)
                                    <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                        <img src="{{ asset('assets/offerImage/' . $image->image) }}" class="d-block w-100"
                                            alt="Frist Slide" style="height:420px">
                                        <h2 class="text-center text-danger">{{ $image->title }}</h2>
                                    </div>
                                    @php $i++; @endphp
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>


                    </div>
                </div>
            

                    <div class="column_center">
                        <h1>1 of the most Beautiful online store </h1>
                        <h2>Clothes is one of the word'd leading E-commerce companies that designs and develops online
                            stores</h2>
                    </div>
                </div>
            </div>
            <div class="sellers_grid">
                <ul class="sellers">
                    <i class="star"> </i>
                    <li class="sellers_desc">
                        <h2>Best Sellers</h2>
                    </li>
                    <div class="clearfix"> </div>
                </ul>
            </div>
            <div class="grid_2">
                @foreach ($products as $product)
                    <div class="col-md-3 span_6">
                        <div class="box_inner">
                            @php  $i = 1; @endphp
                            <!--this loop use for add one image for one product-->

                            <!--this loop use for add one image for one product-->
                            @foreach ($product->images as $image)
                                @if ($i > 0)
                                    <img src="{{ asset('images/' . $image->image) }}" class="img-responsive"
                                        style="width:100%; height:250px" alt="" />
                                @endif
                                @php  $i--;  @endphp
                                <!--this loop use for add one image for one product-->
                            @endforeach
                            <div class="sale-box"> </div>
                            <div class="desc">
                                <h3>{{ $product->title }}</h3>
                                <h4>BDT : {{ $product->price }}</h4>
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="btn btn-primary my-1 ">Details</a>

                                @include('partial.cart-button')
                                <div class="heart"> </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <nav aria-label="Page navigation container">
                <div class="pagination px-5 " style="width:100%; font-size:25px; padding:0px 10px">
                    {{ $products->links() }}
                </div>
            </nav>
        </div>

    </div>
    <div class="content_middle">
        <div class="container">
			<div class="sellers_grid">
                <ul class="sellers">
                    <i class="star"> </i>
                    <li class="sellers_desc">
                        <h2>Promotion</h2>
                    </li>
                    <div class="clearfix"> </div>
                </ul>
            </div>
            <div class="grid_2">
                @foreach ($promotion as $promotion)
                    <div class="col-md-3 span_6">
                        <div class="box_inner">
                            @php  $i = 1; @endphp
                            <!--this loop use for add one image for one product-->

                            <!--this loop use for add one image for one product-->
                            @foreach ($promotion->images as $image)
                                @if ($i > 0)
                                    <img src="{{ asset('images/' . $image->image) }}" class="img-responsive"
                                        style="width:100%; height:250px" alt="" />
                                @endif
                                @php  $i--;  @endphp
                                <!--this loop use for add one image for one promotion-->
                            @endforeach
                            <div class="sale-box"> </div>
                            <div class="desc">
                                <h3>{{ $promotion->title }}</h3>
                                <h4>BDT : {{ $promotion->price }}</h4>
                                <a href="{{ route('products.show', $promotion->slug) }}"
                                    class="btn btn-primary my-1 ">Details</a>

                                @include('partial.cart-button')
                                <div class="heart"> </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <nav aria-label="Page navigation container">
                <div class="pagination px-5 " style="width:100%; font-size:25px; padding:0px 10px">
                    {{ $products->links() }}
                </div>
        </div>

        </ul>
        <script type="text/javascript">
            $(window).load(function() {
                $("#flexiselDemo3").flexisel({
                    visibleItems: 6,
                    animationSpeed: 1000,
                    autoPlay: true,
                    autoPlaySpeed: 3000,
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: {
                        portrait: {
                            changePoint: 480,
                            visibleItems: 1
                        },
                        landscape: {
                            changePoint: 640,
                            visibleItems: 2
                        },
                        tablet: {
                            changePoint: 768,
                            visibleItems: 3
                        }
                    }
                });

            });
        </script>
        <script type="text/javascript" src="js/jquery.flexisel.js"></script>
    </div>
    </div>
    <div class="container">
        <div class="content_middle_bottom">
            <div class="col-md-4">
                <ul class="spinner">
                    <i class="spinner_icon"> </i>
                    <li class="spinner_head">
                        <h3>But I must explain</h3>
                    </li>
                    <div class="clearfix"> </div>
                </ul>
                <div class="timer_box">
                    <div class="thumb"> </div>
                    <div class="timer_grid">
                        <ul id="countdown">
                        </ul>
						<p id="demo" class="clock"></p>
                        <ul class="navigation text-center">
                            <li>
                                <p class="timeRefDays">DAYS</p>
                            </li>
                            <li>
                                <p class="timeRefHours">HOURS</p>
                            </li>
                            <li>
                                <p class="timeRefMinutes">MINUTES</p>
                            </li>
                            <li>
                                <p class="timeRefSeconds">SECONDS</p>
                            </li>
                        </ul>
                    </div>
                    <div class="thumb_desc">
                        <h3> Discount Up To</h3>
                        <div class="price">
                            <h2 class="reducedfrom"><strike>10%</strike> </h2>
                            <span class="actual" style="font-size: 30px">50% Or Up To BDT 4000</span>
                        </div>
                    </div>
                    <a href="#">
                        <div class="m_3 deal">
                            <div class="link3">Buy this deal</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <ul class="spinner">
                    <i class="paperclip"> </i>
                    <li class="spinner_head">
                        <h3>From the Blog</h3>
                    </li>
                    <div class="clearfix"> </div>
                </ul>
                <div class="a-top">
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
                <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="content_bottom">
            <div class="col-md-3 span_1">
                <ul class="spinner">
                    <i class="box_icon"> </i>
                    <li class="spinner_head">
                        <h3>OUR SERVICE</h3>
                    </li>
                    <div class="clearfix"> </div>
                </ul>
				<li>Web Design</li>
				<li>Web Development</li>
				<li>Ecommerce</li>
				<li>Portfolio</li>
				<li>Education Management</li>
                <img src="images/t8.jpg" class="img-responsive" alt="" />
            </div>
            <div class="col-md-3 span_1">
                <ul class="spinner">
                    <i class="bubble"> </i>
                    <li class="spinner_head">
                        <h3>About Us</h3>
                    </li>
					
                    <div class="clearfix"> </div>
                </ul>
                <div class="mb-3">
					<label for="exampleFormControlInput1" class="form-label">Email Subject</label>
					<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Write here Something for title">
				  </div>
				  <div class="mb-3">
					<label for="exampleFormControlTextarea1" class="form-label">Message</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write Here Your Message"></textarea>
				  </div>
				  <button type="button" class="btn btn-primary">Send</button>
            </div>
            <div class="col-md-3 span_1">
                <ul class="spinner">
                    <i class="mail"> </i>
                    <li class="spinner_head">
                        <h3>Contact Us</h3>
                    </li>
                    <div class="clearfix"> </div>
                </ul>
                <ul class="social text-center" >
                    <li style="font-size: 30px; color:blue"><a href=""  style="text-decoration: none"> <i class="fa fa-facebook" > </i> </a></li>
                    <li style="font-size: 30px; color:red" ><a href="" style="text-decoration: none"><i class="fa fa-twitter" style="color:red"> </i> </a></li>
                    <li style="font-size: 30px" ><a href="" style="text-decoration: none"><i class="fa fa-google" style="color:green"> </i> </a></li>
                    <li style="font-size: 30px" ><a href="" style="text-decoration: none"><i class="fa fa-linkedin" style="color:blue"> </i> </a></li>
                    <li style="font-size: 30px" ><a href="" style="text-decoration: none"><i class="fa fa-skype" style="color:orange"> </i> </a></li>
                </ul>
            </div>
            <div class="col-md-3 span_1">
                <ul class="spinner">
                    <i class="mail"> </i>
                    <li class="spinner_head">
                        <h3>Contact Us</h3>
                    </li>
                    <div class="clearfix"> </div>
                </ul>
                <p>8 No, Durgapur</p>
                <p>Mirsarai, Chattogram</p>
                <p>Phone:(00) 222 666 444</p>
                <p><a href="mailto:info@demo.com"> info@bd-shop.com</a></p>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
	<script>
		// Set the date we're counting down to
		var countDownDate = new Date("Apr 5, 2022 15:37:25").getTime();
		
		// Update the count down every 1 second
		var x = setInterval(function() {
		
		  // Get today's date and time
		  var now = new Date().getTime();
			
		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;
			
		  // Time calculations for days, hours, minutes and seconds
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
		  // Output the result in an element with id="demo"
		  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
		  + minutes + "m " + seconds + "s ";
			
		  // If the count down is over, write some text 
		  if (distance < 0) {
			clearInterval(x);
			document.getElementById("demo").innerHTML = "EXPIRED";
		  }
		}, 1000);
		</script>
@endsection
