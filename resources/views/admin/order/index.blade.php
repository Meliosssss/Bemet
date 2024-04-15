@extends('master.admin')
@section('title' , 'Order List')
@section('main')
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
        @foreach($orders as $item)
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
                <a href="{{ route('order.show', $item->id) }}" class="btn btn-primary">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop