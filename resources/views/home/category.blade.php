@extends('master.main')
@section('title', 'Category')
@section('main')
<!-- main-area -->
<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">{{ $cat->name }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $cat->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- shop-area -->
    <section class="shop-area shop-bg" data-background="uploads/bg/shop_bg.jpg">
        <div class="container custom-container-five">
            <div class="shop-inner-wrap">
                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="shop-item-wrap">
                            <div class="row">
                                @foreach($products as $prod)
                                <div class="col-xl-4 col-md-6">
                                    <div class="product-item-three inner-product-item">
                                        <div class="product-thumb-three">
                                            <a href="{{ route('home.product', $prod->id) }}"><img
                                                    src="uploads/product/{{ $prod->image }}" alt=""></a>
                                        </div>
                                        <div class="product-content-three">
                                            <a href="shop.html" class="tag">organic</a>
                                            <h2 class="title"><a
                                                    href="{{ route('home.product', $prod->id) }}">{{ $prod->name }}</a>
                                            </h2>
                                            @if ($prod->sale_price > 0)
                                            <span><s>${{ number_format($prod->price) }}</s></span>
                                            <span class="price">${{ number_format($prod->sale_price) }}</span>
                                            @else
                                            <span class="price">${{ number_format($prod->price) }}</span>
                                            @endif
                                            <div class="product-cart-wrap">
                                                <form action="#">
                                                    <div class="cart-plus-minus">
                                                        <input type="text" value="1">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="product-shape-two">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303 445"
                                                preserveAspectRatio="none">
                                                <path
                                                    d="M319,3802H602c5.523,0,10,5.24,10,11.71l-10,421.58c0,6.47-4.477,11.71-10,11.71H329c-5.523,0-10-5.24-10-11.71l-10-421.58C309,3807.24,313.477,3802,319,3802Z"
                                                    transform="translate(-309 -3802)" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="shop-sidebar">
                            <div class="shop-widget">
                                <h4 class="sw-title">Category</h4>
                                <div class="shop-cat-list">
                                    <ul class="list-wrap">
                                        @foreach($cats_home as $cat)
                                        <li>
                                            <div class="shop-cat-item">
                                                <a href="{{ route('home.category', $cat->id) }}"
                                                    class="form-check-label" for="catOne">{{ $cat->name }}
                                                    <span>{{ $cat->products->count() }}</span></a>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="shop-widget">
                                <h4 class="sw-title">Latest Products</h4>
                                <div class="latest-products-wrap">
                                    @foreach($news_products as $np)
                                    <div class="lp-item">
                                        <div class="lp-thumb">
                                            <a href="{{ route('home.product', $np->id) }}"><img
                                                    src="uploads/product/{{ $np->image }}" alt=""></a>
                                        </div>
                                        <div class="lp-content">
                                            <h4 class="title"><a
                                                    href="{{ route('home.product', $np->id) }}">{{ $np->name }}</a></h4>
                                            @if ($np->sale_price > 0)
                                            <span><s>${{ number_format($np->price) }}</s></span>
                                            <span class="price">${{ number_format($np->sale_price) }}</span>
                                            @else
                                            <span class="price">${{ number_format($np->price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-area-end -->
</main>
<!-- main-area-end -->
@stop