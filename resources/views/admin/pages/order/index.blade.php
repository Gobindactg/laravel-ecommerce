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
          Manage Orders
        </div>
        <div class="card-body" >
        @include('admin.partial.message')
         <table class="display" id="dataTable">
           <thead>
            <tr>
             <th>serial</th>
             <th>Order ID</th>
             <th>Customer Name</th>
             <th>Customer Phone</th>
             <th>Order Status</th>
             <th>Action</th>
           </tr>
        </thead>
        <tbody>
           @foreach ($orders as $order)
           <tr>
             <td>{{$loop->index + 1}}</td>
             <td>#BD{{$order->id}}</td>
             <td>{{$order->name}}</td>
             <td>{{$order->phone_no}}</td>
             <td>
                 <p>
                    @if ($order->is_seen_by_admin)
                    <button class="btn btn-primary btn-sm text-light" type="button">Seen</button>
                    @else
                    <button class="btn btn-warning btn-sm text-dark" type="button">Unseen</button>
                    @endif

                    @if ($order->is_completed)
                    <button class="btn btn-primary btn-sm text-light" type="button">Completed</button>
                    @else
                    <button class="btn btn-warning btn-sm text-dark" type="button">Uncompleted</button>
                    @endif

                    @if ($order->is_paid)
                    <button class="btn btn-primary btn-sm text-light" type="button">Paid</button>
                    @else
                    <button class="btn btn-danger btn-sm text-dark" type="button">Unpaid</button>
                    @endif

                 </p>
                 
            </td>
             <td>
              <!-- start delete option -->
              <a href="{{ route('admin/order/show', $order->id) }}"  class="btn btn-info">View</a>
              <a href="#deleteModal{{ $order->id }}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>
              <a href="{{ route('admin/order/show', $order->id) }}"  class="btn btn-primary">Print</a>
          <!-- Modal -->
          <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Are You Sure To Delete?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('admin/order/delete', $order->id)}}" method="post">
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
            </td>
           </tr>
        </tbody>
           @endforeach
        <tfoot>
            <tr>
                <th>serial</th>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Order Status</th>
                <th>Action</th>
              </tr>
        </tfoot>
         </table>
        </div>
      </div>

    </div>
  </div>
 
@endsection
