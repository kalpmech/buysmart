@extends('frontend.partials.app')
@section('content')
        <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = [];
                                @endphp
                                @forelse ($cartItems as $item)
                                <tr>
                                    <td class="cart__product__item">
                                        <div class="cart__product__item__title">
                                            <h6>{{$item->name}}</h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ {{number_format($item->price,2)}}</td>
                                    <td class="cart__quantity" >
                                        <div class="pro-qty" data-cart-id="{{$item->id}}">
                                            <input type="text" id="qtyVal" value="{{$item->quantity}}">
                                        </div>
                                    </td>
                                    @php $subTotal = $item->price * $item->quantity; $total[] = $subTotal; @endphp
                                    <td class="cart__total">$ {{number_format($subTotal,2)}} </td>
                                    <td class="cart__close"><a href="{{route('cart-remove', Crypt::encrypt($item->id)) }}"><span class="icon_close"></span></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="cart__product__item">Empty Cart</td>
                                </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total <span>$ {{number_format(array_sum($total),2)}}</span></li>
                            
                            @if (array_sum($total) > 0)
                                <form action="{{ route('orders.place') }}" id="orderplacesubmit" method="post">
                                @csrf
                                    <li style="margin-bottom: 10px;">Payment Type
                                        <select name="pay_type" class="form-control">
                                            <option value="creditcard">Credit Card</option>
                                            <option value="debitcard">Debit Card</option>
                                            <option value="cod">Cash On Delivery</option>
                                        </select>
                                    </li>
                                    <li>
                                        <a id="order-place" class="primary-btn">Proceed to checkout</a>
                                    </li>
                                </form>
                            @endif 
                        </ul>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
    @push('scripts')
    <script>
        $(document).ready(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.pro-qty', function(e) {          
                e.preventDefault();
                var formData = {
                    id : $(this).data("cart-id"),
                    quantity : $('#qtyVal').val(),
                };
                $.ajax({
                    type:'POST',
                    url:"{{ route('cart-update') }}",
                    data:formData,
                    success:function(data){
                        location.reload();
                    }
                });
            });
                $( "#order-place" ).click(function() {
                    $( "#orderplacesubmit" ).submit();
                });
        });
    </script>
        
    @endpush
@endsection    
