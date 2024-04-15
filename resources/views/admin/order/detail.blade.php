@extends('master.admin')
@section('title' , 'Details Order')
@section('main')
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
    <br>
    @if ($order->status != 2)
    @if ($order->status != 3)
    <a href="{{ route('order.update', $order->id) }}?status=2" class="btn btn-success"
        onclick="return confirm('Are you sure?')">Success</a>
    <a href="{{ route('order.update', $order->id) }}?status=3" class="btn btn-danger"
        onclick="return confirm('Are you sure?')">Cancel</a>
    @else
    <a href="{{ route('order.update', $order->id) }}?status=1" class="btn btn-success"
        onclick="return confirm('Are you sure?')">Success</a>
    @endif
    @endif
</div>
@stop