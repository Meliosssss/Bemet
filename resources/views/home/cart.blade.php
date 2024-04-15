@extends('master.main')
@section('title' , 'Cart')
@section('main')
<main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Your shopping cart</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Your favorite</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
    <!-- contact-area -->
    <section class="contact-area">
        <div class="contact-wrap">
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $item)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $item->prod->name }}</td>
                            <td>
                                <img src="uploads/product/{{ $item->prod->image }}" width="40px">
                            </td>
                            <td>
                                <form action="{{ route('cart.update', $item->product_id) }}" method="get">
                                    <input type="number" value="{{ $item->quantity }}" name="quantity" style="width: 60px; text-align:center">
                                    <button><i class="fa fa-save"></i></button>
                                </form>
                            </td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <a onclick="return confirm('Are you sure want to delete it?')" href="{{ route('cart.delete', $item->product_id) }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="text-center">
                    <a href="" class="btn btn-primary">Continue shopping</a>
                    @if($carts->count())
                    <a href="{{ route('cart.clear') }}" class="btn btn-danger"><i class="fa fa-trash"></i>Clear cart</a>
                    <a href="{{ route('order.checkout') }}" class="btn btn-success">Check out</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>
@stop