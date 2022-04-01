@extends('admin.layout.adminmaster')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

@section('content')


<section class="section dashboard">
  <div class="row">
    <div class="col-md-12">
        <h2 class="text-center text-primary">Welcome to Admin Panel</h2> <br>
        <h4 class="text-center">Manage Everythin From Here</h4>
        <br>
        <a href="{{route('home')}}" target="_blank" class="btn-primary btn-lg">Visit Home Page</a>

    </div>
   
  </div>
</section>

</main><!-- End #main -->
@endsection