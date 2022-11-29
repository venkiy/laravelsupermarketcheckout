@extends('layouts.app')

@section('content')
<div class="">
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-header">Store
                <div class="float-right">
                <a class="btn btn-success" href="{{ route('cart') }}">

                    <span id="items-in-cart">0</span> items in cart
                </a>
                </div>
                </div>

                <div class="card-body">
                <br>
                @if ($products->count() == 0)
                <tr>
                    <td colspan="5">No products to display.</td>
                </tr>
                @endif

                <?php $count = 0; ?>

                @foreach ($products as $product)

                @if ($count % 3 == 0) 
                <div class="row">
                @endif

                <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    
                    <div class="card-body">
                    <p class="card-text">{{ $product->sku }} / {{$product->name}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Only ${{$product->price}}</small>
                        @foreach ($product->discounts as $pdiscount)
                        @if ($product->sku!='D') 
                        <small class="text-muted">Buy {{$pdiscount->qty}} for ${{$pdiscount->special_price}}</small>
                        @else
                        <small class="text-muted">Buy for $5.00 if Purchased with A</small>
                        @endif
                        @endforeach
                        <div class="btn-group">
                            <input type="number" value="1" min="1" max="100">
                            <button class="add-to-cart" type="button" class="btn btn-sm btn-outline-secondary" 
                                    data-id="{{$product->id}}" data-name="{{$product->sku}}" data-price="{{$product->price}}">Add to Cart</button>
                        </div>

                    </div>
                    </div>
                </div>
                </div>

                @if ($count % 3 == 2) 
                </div>
                @endif

                <?php $count++; ?>

                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('footer-scripts')
<script>
    $(document).ready(function() {

        window.cart = <?php echo json_encode($cart) ?>;

        updateCartButton();

        $('.add-to-cart').on('click', function(event){

            var cart = window.cart || [];
            cart.push({'id':$(this).data('id'), 'name':$(this).data('name'), 'price':$(this).data('price'), 'qty':$(this).prev('input').val()});
            window.cart = cart;

            $.ajax('{{ route('addcart') }}', {
                type: 'POST',
                data: {"_token": "{{ csrf_token() }}", "cart":cart},
                success: function (data, status, xhr) {

                }
            });

            updateCartButton();
        });
    })

    function updateCartButton() {

        var count = 0;
        window.cart.forEach(function (item, i) {

            count += Number(item.qty);
        });

        $('#items-in-cart').html(count);
    }
</script>
@endsection