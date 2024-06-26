@extends('master.main')
@section('title', 'Home')
@section('main')

<main>

    <!-- area-bg -->
    <div class="area-bg" data-background="uploads/bg/area_bg.jpg">

        <!-- banner-area -->
        <section class="banner-area banner-bg tg-motion-effects" data-background="uploads/banner/{{ $topBanner->image }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-content">
                            <h1 class="title wow fadeInUp" data-wow-delay=".2s">{{ $topBanner->name }}</h1>
                            <span class="sub-title wow fadeInUp" data-wow-delay=".4s">Butcher & Meat shop</span>
                        </div>
                        <div class="banner-img text-center wow fadeInUp" data-wow-delay=".8s">
                            <img src="uploads/banner/banner_img.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-shape-wrap">
                <img src="uploads/banner/banner_shape01.png" alt="" class="tg-motion-effects5">
                <img src="uploads/banner/banner_shape02.png" alt="" class="tg-motion-effects4">
                <img src="uploads/banner/banner_shape03.png" alt="" class="tg-motion-effects3">
                <img src="uploads/banner/banner_shape04.png" alt="" class="tg-motion-effects5">
            </div>
        </section>
        <!-- banner-area-end -->

        <!-- features-area -->
        <section class="features-area pt-130 pb-70">
            <div class="container">
                <div class="row">
                    @foreach ($news_products as $np)
                    <div class="col-lg-6">
                        <div class="features-item tg-motion-effects">
                            <div class="features-content">
                                <span>{{ $np->cat->name }}</span>
                                <h4 class="title"><a href="{{ route('home.product', $np->id) }}">{{ $np->name }}</a>
                                </h4>
                                <!-- @if (auth('cus')->check())
                                <div>
                                    @if($np->favorite)
                                    <a href="{{ route('home.favorite', $np->id) }}"><i class="fas fa-heart"></i></a>
                                    @else
                                    <a href="{{ route('home.favorite', $np->id) }}"><i class="far fa-heart"></i></a>
                                    @endif
                                    <a href="{{ route('cart.add', $np->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                                @else
                                <a href="{{ route('account.login', $np->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                @endif -->
                                @if ($np->sale_price > 0)
                                <span><s>${{ number_format($np->price) }}</s></span>
                                <span class="price">${{ number_format($np->sale_price) }}</span>
                                @else
                                <span class="price">${{ number_format($np->price) }}</span>
                                @endif
                            </div>
                            <div class="features-img">
                                <img src="uploads/product/{{ $np->image }}" alt="">
                                <div class="features-shape">
                                    <img src="uploads/images/features_shape.png" alt="" class="tg-motion-effects4">
                                </div>
                            </div>
                            <div class="features-overlay-shape" data-background="uploads/images/features_overlay.png">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- features-area-end -->

    </div>
    <!-- area-bg-end -->

    <!-- product-area -->
    <section class="product-area product-bg" data-background="uploads/bg/product_bg01.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-60">
                        <span class="sub-title">Organic Shop</span>
                        <h2 class="title">Sale Products</h2>
                        <div class="title-shape" data-background="uploads/images/title_shape.png"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($sale_products as $sp)
                <div class="col-lg-4 col-md-6">
                    <div class="product-item">
                        <div class="product-img">
                            <a href="{{ route('home.product', $sp->id) }}"><img src="uploads/product/{{ $sp->image }}" alt=""></a>
                        </div>
                        <div class="product-content">
                            <div class="line" data-background="uploads/images/line.png"></div>
                            <h4 class="title"><a href="{{ route('home.product', $sp->id) }}">{{ $sp->name }}</a></h4>
                            @if ($sp->sale_price > 0)
                            <span><s>${{ number_format($sp->price) }}</s></span>
                            <span class="price">${{ number_format($sp->sale_price) }}</span>
                            @else
                            <span class="price">${{ number_format($sp->price) }}</span>
                            @endif
                        </div>
                        <div class="product-shape">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401 314" preserveAspectRatio="none">
                                <path d="M331.5,1829h361a20,20,0,0,1,20,20l-29,274a20,20,0,0,1-20,20h-292a20,20,0,0,1-20-20l-40-274A20,20,0,0,1,331.5,1829Z" transform="translate(-311.5 -1829)" />
                            </svg>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="shop-shape">
            <img src="uploads/product/product_shape01.png" alt="">
        </div>
    </section>
    <!-- product-area-end -->

    <!-- product-area -->
    <section class="product-area-two product-bg-two" data-background="uploads/bg/product_bg02.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-70">
                        <span class="sub-title">Organic Shop</span>
                        <h2 class="title">Feature Products</h2>
                        <div class="title-shape" data-background="uploads/images/title_shape.png"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($feature_products as $fp)
                <div class="col-lg-6 col-md-10">
                    <div class="product-item-two">
                        <div class="product-img-two">
                            <a href="{{ route('home.product', $fp->id) }}"><img src="uploads/product/{{ $sp->image }}" alt=""></a>
                        </div>
                        <div class="product-content-two">
                            <div class="product-info">
                                <h4 class="title"><a href="{{ route('home.product', $sp->id) }}">Mutton Cutlet</a></h4>
                                <p>{!! $fp->description !!}</p>
                            </div>
                            <div class="product-price">
                                @if ($fp->sale_price > 0)
                                <span><s>${{ number_format($fp->price) }}</s></span>
                                <span class="price">${{ number_format($fp->sale_price) }}</span>
                                @else
                                <span class="price">${{ number_format($fp->price) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- product-area-end -->
</main>

@stop