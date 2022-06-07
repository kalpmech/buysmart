@extends('frontend.partials.app')
@section('content')
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @forelse($product->images as $image)
                                    <img data-hash="product-{{$image->id}}" class="product__big__img" src="{{\Storage::url($image->path.'/'.$image->name)}}" alt="">
                                @empty
                                    <img data-hash="product-1" class="product__big__img" src="{{ asset('img/product/details/product-1.jpg')}}" alt="">
                                    <img data-hash="product-2" class="product__big__img" src="{{ asset('img/product/details/product-3.jpg')}}" alt="">
                                    <img data-hash="product-3" class="product__big__img" src="{{ asset('img/product/details/product-2.jpg')}}" alt="">
                                    <img data-hash="product-4" class="product__big__img" src="{{ asset('img/product/details/product-4.jpg')}}" alt="">
                                @endforelse
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{$product->name}} <span>Brand: {{$product->brand}}</span></h3>
                        <div class="rating">
                            <span>( {{$product->view_counts}} reviews )</span>
                        </div>
                        <div class="product__details__price">$ {{$product->price}}</div>
                        <p>{{$product->description}}</p>
                        <div class="product__details__button">
                            <a href="#" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</a>
                        </div>
                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Availability:</span>
                                    <div class="stock__checkbox">
                                        <label for="stockin">
                                            In Stock
                                            <input type="checkbox" id="stockin">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <span>Available color:</span>
                                    <div class="color__checkbox">
                                        {{ ucfirst($product->color)}}
                                    </div>
                                </li>
                                <li>
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                        {{$product->size}}
                                    </div>
                                </li>
                                <li>
                                    <span>Promotions:</span>
                                    <p>Free shipping</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Features</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Description</h6>
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Features</h6>
                                <p>{{$product->features}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
@endsection    
