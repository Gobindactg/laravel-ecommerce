<div class="main-panel">
    <div class="content-wrapper">

        <div class="card">
            <div class="card-header">
                <h3>View Order #BD{{ $order->id }}</h3>
            </div>
            <div class="card-body">
                @include('admin.partial.message')
                <h3>Orders Information</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Customer Name : </strong>{{ $order->name }}</p>
                        <p><strong>Customer Email : </strong> {{ $order->email }}</p>
                        <p><strong>Customer Phone : </strong>{{ $order->phone_no }}</p>
                        <p><strong>Customer Shipping Address : </strong>{{ $order->shipping_address }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Order Payment Method : </strong> {{ $order->payment->name }}</p>
                        <p><strong>Order Payment transaction : </strong>
                            @if ($order->transaction_id == null)
                                Not Applicable
                            @else
                                {{ $order->transaction_id }}
                        </p>
                        @endif
                    </div>
                    <hr>
                    <h3>Orders Item</h3>
                    @if ($order->carts->count() > 0)

                        <table class="table table-bordered table-stripe text-center">
                            <tr style="border: 1px solid black">
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
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><strong> <a href="{{ route('products.show', $cart->product->slug) }}"
                                                style="text-decoration: none">{{ $cart->product->title }}</a> </strong>
                                    </td>
                                    <td>

                                        @if ($cart->product->images->count() > 0)
                                            <img src="{{ asset('images/' . $cart->product->images->first()->image) }}"
                                                style="width: 50px" alt="Frist Slide">
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('carts.update', $cart->id) }}" class="form-inline"
                                            method="post">
                                            @csrf
                                            <input type="number" name="product_quantity" class="form-control"
                                                value="{{ $cart->product_quantity }}">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                    </td>
                                    <td>BDT {{ $cart->product->price }}</td>
                                    <td>
                                        @php
                                            $total_price += $cart->product->price * $cart->product_quantity;
                                        @endphp
                                        BDT {{ $cart->product->price * $cart->product_quantity }}
                                    </td>
                                    <td>
                                        <form action="{{ route('carts.delete', $cart->id) }}" class="form-inline"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="cart_id">
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <hr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right">

                                    <strong>Sub Total Amount</strong>

                                </td>
                                <td>
                                    @if ($order->count() > 0)
                                        <strong>BDT {{ $total_price }}</strong>
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
                                        <strong>BDT {{ $order->shipping_charge }}</strong>
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
                                        <strong>BDT {{ $order->custom_discount }}</strong>
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
                                        <strong>BDT
                                            {{ $total_price + $order->shipping_charge - $order->custom_discount }}</strong>
                                    @else
                                    @endif

                                </td>
                            </tr>

                        </table>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
