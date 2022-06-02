@extends('frontend.partials.app')
@section('content')
    <!-- Shop Section Begin -->
        <section class="shop spad">
            <div class="container">
                <form action="{{route('kids')}}" method="get" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            @include('frontend.partials.sidebar')
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
                                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
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
                </form>
            </div>
        </section>
    <!-- Shop Section End -->
@endsection

