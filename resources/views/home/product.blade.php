@extends('master.main')
@section('title', 'Product')
@section('main')
<!-- main-area -->
<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">{{ $product->name }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- shop-details-area -->
    <section class="shop-details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="shop-details-images-wrap">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active">
                                <a href="uploads/product/{{ $product->image }}" class="popup-image">
                                    <img id="big_image" src="uploads/product/{{ $product->image }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active">
                                    <img class="thumb_image" src="uploads/product/{{ $product->image }}" alt="">
                                </button>
                            </li>
                            @foreach($product->images as $img)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active">
                                    <img class="thumb_image" src="uploads/product/{{ $img->image }}" alt="">
                                </button>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shop-details-content">
                        <h2 class="title">{{ $product->name }}</h2>
                        <h3 class="price">${{ number_format($product->sale_price) }}</h3>
                        @if (auth('cus')->check())
                        <a href="{{ route('cart.add', $product->id) }}" class="buy-btn">Buy it now</a>
                        @else
                        <a href="{{ route('account.login', $product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                        @endif
                        <div class="shop-add-Wishlist">
                            @if($product->favorite)
                            <a href="{{ route('home.favorite', $product->id) }}"><i class="fas fa-heart"></i>Removed
                                from
                                favorites list</a>
                            @else
                            <a href="{{ route('home.favorite', $product->id) }}"><i class="far fa-heart">Add to
                                    favorites
                                    list</i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-desc-wrap">
                        <ul class="nav nav-tabs" id="descriptionTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane" type="button" role="tab" aria-controls="description-tab-pane" aria-selected="true">Description</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="descriptionTabContent">
                            <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
                                <div class="product-description-content">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-details-area-end -->
</main>
<!-- main-area-end -->
@stop

@section('js')
<script>
    $('.thumb_image').click(function(e) {
        e.preventDefault();
        var _url = $(this).attr('src');
        $('#big_image').attr('src', _url);
    });
</script>
@stop