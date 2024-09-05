<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>
        
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Customer Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
        <p><strong>Email:</strong> {{ $order->email_address }}</p>
        <p><strong>Address:</strong> {{ $order->address }}, {{ $order->town_city }}, {{ $order->postcode_zip }}</p>
        <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
        <p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>
        <p><strong>Order Notes:</strong> {{ $order->order_notes }}</p>
        
        <h2>Order Items</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity * $item->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <a href="{{ route('driver.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
</body>
</html>
