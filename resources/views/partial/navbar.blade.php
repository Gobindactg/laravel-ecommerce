{{-- 
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav  skyblue">
            <li class=" nav-item">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Menu</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Link</a></li>
                  <li><a class="dropdown-item" href="#">Another link</a></li>
                  <li><a class="dropdown-item" href="#">A third link</a></li>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link" href="{{ asset('/') }}">Home</a></li>
              <li class="nav-item" ><a class="nav-link" href="{{ asset('products') }}">Product</a></li>
              <li class="nav-item" ><a class="nav-link" href="{{ asset('contact') }}">Contact</a></li>
              <li class="nav-item" ><a class="nav-link" href="{{ asset('admin/home') }}">admin</a></li>
              <li class="nav-item" ><a class="nav-link" href="men.html">Special</a></li>
              <li class="nav-item"><a  class="nav-link" href="#">Men Fashion</a>
              <li>
              <li class="nav-item"><a class="nav-link" href="404.html">Accessories</a></li>
      
              <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">Blog</a></li>
       
        </ul>
        <form class="d-flex" action="{{route('search')}}" method="get">
            <input class="form-control me-2" type="text" placeholder="Enter Search Keyword" name="search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>
      </div>
    </div>
  </nav> --}}

  <nav class="navbar navbar-expand-sm  sticky-top bg-dark " >
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto ">
           <li class=" nav-item ">
                <a class="nav-link dropdown-toggle text-light " href="#" role="button" data-bs-toggle="dropdown">Menu</a>
              
                <ul class="dropdown-menu " style="width: 350px">
                    <div class="list-group w-100">
                        @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', NUll)->get() as $parent)
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item search_custom">
                                    <h2 class="accordion-header search_custom" id="flush-headingOne">
                                        <a  href="#main-{{$parent->id}}" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#main-{{$parent->id}}" aria-expanded="false" aria-controls="flush-collapseOne" style="text-decoration: none;">
                                        <img src="{{ asset('assets/categoryImage/'. $parent->image) }}" alt="$parent->name" style="width:40px; height:30px; padding-right:5px">
                                            {{$parent->name}}
                                        </a>
                                    </h2>
                                    <div id="main-{{$parent->id}}" class="collapse 
                                    @if (Route::is('category.show'))
                                            @if (App\Models\Category::ParentOrNotCategory($parent->id, $category->id))
                                            show
                                            @endif
                                        @endif              
                                    
                                    " aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    @foreach (App\Models\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $child)
                                    <div class="accordion-body 
                                    @if (Route::is('category.show'))
                                            @if ($child->id == $category->id)
                                           bg-info
                                            @endif
                                        @endif
                                    ">
                                        <a  href="{{route('category.show', $child->slug)}}" style="text-decoration: none;" 
                                        class="">
                                        ==> <img src="{{ asset('assets/categoryImage/'. $child->image) }}" alt="$child->name" style="width:40px; height:30px; padding-right:5px">
                                           {{$child->name}}
                                        </a>    
                                    </div>
                                    
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link text-light" href="{{ asset('/') }}">Home</a></li>
              <li class="nav-item" ><a class="nav-link text-light" href="{{ asset('products') }}">Product</a></li>
              <li class="nav-item" ><a class="nav-link text-light" href="{{ asset('contact') }}">Contact</a></li>
              <li class="nav-item" ><a class="nav-link text-light" href="{{ asset('admin/home') }}">admin</a></li>
              <li class="nav-item" ><a class="nav-link text-light" href="men.html">Special</a></li>
              <li class="nav-item"><a  class="nav-link text-light" href="#">Men Fashion</a>
              <li>
              <li class="nav-item"><a class="nav-link text-light" href="404.html">Accessories</a></li>
      
              <li class="nav-item"><a class="nav-link text-light" href="{{ route('blog') }}">Blog</a></li>
        </ul>
        <form class="d-flex" action="{{route('search')}}" method="get">
            <input class="form-control me-2" type="text" placeholder="Enter Search Keyword" name="search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>
      </div>
    </div>
  </nav>
  <style>
    .dropbtn {
      background-color: #04AA6D;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
    }
    
    .dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropdown-content a:hover {background-color: #ddd;}
    
    .dropdown:hover .dropdown-content {display: block;}
    
    .dropdown:hover .dropbtn {background-color: #3e8e41;}
    </style>