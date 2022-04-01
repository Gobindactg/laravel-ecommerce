{{-- <form class="form-inline" action="{{route('carts.store')}}" method="post">
    @csrf
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <button type="submit" name="button" class="btn btn-warning"><i class="fa fa-plus"> </i> Add to Cart</button>
</form> --}}
<form class="form-inline" action="{{ route('carts.store') }}" method="post">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="button" name="button" class="btn btn-warning" onclick="addToCart({{ $product->id }})"><i
            class="fa fa-plus"> </i> Add to Cart</button>
</form>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addToCart(product_id) {
        $.post("http://localhost/IntershipLaravel/ecommerceProject/public/carts/store", {
                product_id: product_id
            })
            .done(function(data) {
                data = JSON.parse(data);
                if (data.status == 'success') {
                    // toast
                    alertify.set('notifier', 'position', 'top-center');
                    alertify.warning('Item Added To Cart Successfully !! Please Go To carts.....'+ data.totalItems  + '<br>'+   'To Checkout <a href="{{route('carts')}}">Go to checkout page</a>' );
                    $("#totalItem").html(data.totalItems);
                }
            });
    }
</script>
