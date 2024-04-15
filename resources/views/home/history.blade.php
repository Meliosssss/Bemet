@extends('master.main')
@section('title' , 'Oder History')
@section('main')
<main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Order History</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order History</li>
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
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Total Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auth->orders as $item)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $item->created_at ? $item->created_at->format('d/m/Y') : 'N/A' }}</td>
                            <td>
                                @if($item->status == 0)
                                <span>Pending</span>
                                @elseif ($item->status == 1)
                                <span>Processing</span>
                                @elseif ($item->status == 2)
                                <span>Completed</span>
                                @else
                                <span>Cancelled</span>
                                @endif
                            </td>
                            <td>{{ number_format($item->total_price)}}</td>
                            <td>
                                <a href="{{ route('order.detail', $item->id) }}" class="btn btn-primary">Detail</a>
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