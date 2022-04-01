<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order|| #BD{{ $order->id }}</title>
</head>

<body>


    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">

                    <table style=" width:100%">
                        <tr>
                            <th style="text-align: center">
                                <img src="{{ asset('assets/adminImage/logo.png') }}" alt="" style="width:150px">
                            </th>
                            <th style="text-align:right" class="company-info">
                                <h3><strong>BD SHOP</strong> </h3>
                                <p>125/15; Industrial Area, Mirsarai, Chattogram</p>
                                <p>Phone: 01710*******1</p>
                                <p>Email: abcd123@gmail.com</p>
                            </th>
                        </tr>
                    </table>

                </div>
                <hr>
                @include('admin.partial.message')
                <h3>Orders Information</h3>
                <div class="row">
                    <table style=" width:100%">
                        <tr>
                            <th style="text-align: left">
                                <p><strong>View Order #BD{{ $order->id }}</strong> </p>
                                <p><strong>Customer Name : </strong><span style="color:teal">{{ $order->name }}</span>
                                </p>
                                <p><strong>Customer Email : </strong> {{ $order->email }}</p>
                                <p><strong>Customer Phone : </strong>{{ $order->phone_no }}</p>
                                <p><strong>Customer Shipping Address : </strong>{{ $order->shipping_address }}</p>
                            </th>
                            <th style="text-align:right">
                                <p><strong>Order Payment Method : </strong> <span style="color: teal; font-size:25px; font-style:italic; font-family:tahoma;">{{ $order->payment->name }}</span></p>
                                <p><strong>Order Payment Method : </strong><strong style="color: red; font-size:22px; font-style:italic; font-family:tahoma;"> 
                                    @if ($order->is_paid == 1)
                                        Paid
                                    @else
                                        Unpaid
                                </strong> 
                                @endif
                            </p>
                                <p><strong>Order Payment transaction : </strong>

                                    @if ($order->transaction_id == null)
                                        Not Applicable
                                    @else
                                        {{ $order->transaction_id }}
                                </p>
                                @endif
                            </th>
                        </tr>
                    </table>

                    <hr>
                    <div>
                        <h3 style="color:teal">Orders Item</h3>
                        @if ($order->carts->count() > 0)

                            <table class="" style="width: 100%; ">
                                <tr class="border-table align">
                                    <th class="border-table">Serial No</th>
                                    <th class="border-table">Product Title</th>
                                    <th class="border-table">Product Image</th>
                                    <th class="border-table"> Quantity </th>
                                    <th class="border-table">Unit Price</th>
                                    <th class="border-table">Sub Total</th>
                                </tr>
                                @php
                                    $total_price = 0;
                                @endphp
                                @foreach ($order->carts as $cart)
                                    <tr style="text-align: center">
                                        <td class="border-table">{{ $loop->index + 1 }}</td>
                                        <td class="border-table"><strong> <a
                                                    href="{{ route('products.show', $cart->product->slug) }}"
                                                    style="text-decoration: none">{{ $cart->product->title }}</a>
                                            </strong>
                                        </td>
                                        <td style="text-align: center" class="border-table">

                                            @if ($cart->product->images->count() > 0)
                                                <img src="{{ asset('images/' . $cart->product->images->first()->image) }}"
                                                    style="width: 40px; " alt="Frist Slide">
                                            @endif
                                        </td>

                                        <td class="border-table">{{ $cart->product->quantity }}</td>
                                        <td class="border-table">BDT {{ $cart->product->price }}</td>
                                        <td class="border-table">
                                            @php
                                                $total_price += $cart->product->price * $cart->product_quantity;
                                            @endphp
                                            BDT {{ $cart->product->price * $cart->product_quantity }}
                                        </td>

                                    </tr>
                                @endforeach
                                <tr class="border-table">
                                    <td colspan="5" class="align-right">

                                        <strong>Sub Total Amount</strong>

                                    </td>
                                    <td class="align-right">
                                        @if ($order->count() > 0)
                                            <strong>BDT {{ $total_price }}</strong>
                                        @else
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="align-right">

                                        @if ($order->count() > 0)
                                            <strong>Shipping Charge</strong>
                                        @else
                                            <h3><strong>There is no shipping_charge</strong> </h3>
                                        @endif
                                    </td>
                                    <td class="align-right">
                                        @if ($order->count() > 0)
                                            <strong>BDT {{ $order->shipping_charge }}</strong>
                                        @else
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="align-right">

                                        @if ($order->count() > 0)
                                            <strong>Discount</strong>
                                        @else
                                            <h3><strong>There is no Discount</strong> </h3>
                                        @endif
                                    </td>
                                    <td class="align-right">
                                        @if ($order->count() > 0)
                                            <strong>BDT {{ $order->custom_discount }}</strong>
                                        @else
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="align-right">
                                        <strong>Grand Total</strong>
                                    </td>
                                    <td class="align-right">
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
                    <div class="thanks">Thank you!</div>
                    <br>
                    <div class="notices">

                        <div>NOTICE:</div>
                        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30
                            days.</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <footer class="footer">Invoice was created on a computer and is valid without the signature and seal.
    </footer>
    <style>
      
        .border-table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .align {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .bd-color {
            background-color: rgb(147, 236, 248);
            opacity: .6;
        }

        .thanks {
            font-family: tahoma;
            font-size: 25px;
            font-style: italic;
            color: teal;
        }

        .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }

        .notices .notice {
            font-size: 1.2em
        }

        .footer {

            position: fixed;
            bottom: 0px;
            width: 100%;
            text-align: center;
            color: rgb(8, 8, 8);
            padding: 15px 0px;
            font-family: tahoma;
            font-size: 15px;
            font-style: italic;
        }

        .company-info h3 {
            font-family: tahoma;
            font-size: 25px;
            font-style: italic;
            font-weight: 600;
            color: teal;
            padding: 0px;
        }

    </style>
</body>

</html>
