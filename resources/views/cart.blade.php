@extends('layouts.app')

@section('content')
<div class="">
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-header">Cart
                <div class="float-right">
                <btn class="btn btn-success clear-cart" >

                     Clear cart
                </a>
                </div>
                </div>

                <div class="card-body">
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    @foreach ($cart as $item)
                    <?php $total += $item['price']; ?>
                    <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>

                <p>
                    <strong>Total: ${{ $total}}</strong>
                </p>

                <p>
                    <a class="btn btn-primary btn-md" href="/cart/pay-with-paypal">

                    
                    checkout</a>
                </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('footer-scripts')
<script>
    $(document).ready(function() {      

        $('.clear-cart').on('click', function(event){

        var cart = [];        
        window.cart = cart;

        $.ajax('{{ route('clearcart') }}', {
            type: 'POST',
            data: {"_token": "{{ csrf_token() }}", "cart":cart},
            success: function (data, status, xhr) {
                location.reload();
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