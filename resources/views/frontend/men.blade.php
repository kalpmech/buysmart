@extends('frontend.partials.app')
@section('content')
    <!-- Shop Section Begin -->
        <section class="shop spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <form action="{{route('men')}}" method="get" enctype="multipart/form-data">
                        @include('frontend.partials.sidebar')
                        </form>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('img/shop/shop-1.jpg')}}">
                                            <ul class="product__hover">
                                                <form  id="{{$product->id}}-cartstore" action="{{route('cart-store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{$product->id}}" name="id">
                                                    <input type="hidden" value="{{$product->name}}" name="name">
                                                    <input type="hidden" value="{{$product->price}}" name="price">
                                                    <input type="hidden" value="1" name="quantity">
                                                </form>
                                                <li><a href="#" onclick="document.getElementById('{{$product->id}}-cartstore').submit();"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="{{route('product-details',['type' => Request::path(),'id' => Crypt::encrypt($product->id)]) }}">{{$product->name}}</a></h6>
                                            <div class="product__price">${{number_format($product->price,2)}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-lg-12 text-center">
                                <div class="pagination__option">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Shop Section End -->
@endsection    
