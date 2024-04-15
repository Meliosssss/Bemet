@extends('master.main')
@section('title' , 'Order details')
@section('main')
<main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Order Detail</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
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
                <h3>Information</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <td>{{ $auth->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $auth->phone }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $auth->address }}</td>
                        </tr>
                    </thead>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Product Quantity</th>
                            <th>Product Price</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->details as $item)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td><img src="uploads/product/{{ $item->product->image }}" width="40px" alt=""></td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price) }}</td>
                            <td>{{ number_format($item->price * $item->quantity)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>
@stop