<h3>Hi {{ $order->customer->name }}</h3>
<p>Thank you for your order. Please click the link below to verify your order.</p>
<h3>Your oder detail</h3>

<table border="1" cellpadding="5" cellpadding="0">
    <tr>
        <th>No</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>
    <?php $total = 0; ?>
    @foreach($order->details as $detail)
    <tr>
        <th>{{ $loop->index + 1 }}</th>
        <th>{{ $detail->product->name }}</th>
        <th>{{ $detail->price }}</th>
        <th>{{ $detail->quantity }}</th>
        <th>{{ number_format($detail->price * $detail->quantity) }}</th>
    </tr>
    <?php $total += $detail->price * $detail->quantity; ?>
    @endforeach
    <tr>
        <th colspan="4">Total price</th>
        <th>{{ number_format($total) }}</th>
    </tr>
</table>

<a href="{{ route('order.verify', $token) }}">Verify Order</a>