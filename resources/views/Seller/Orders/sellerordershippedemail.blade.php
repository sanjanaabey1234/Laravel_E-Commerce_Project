<!DOCTYPE html>
<html>
<head>
    <title>Order Shipped</title>
</head>
<body>
    <h1>Order Shipped Notification</h1>
    <p>Dear Admin,</p>
    <p>From: {{ $sellerName }}</p>
    <p>Order ID: {{ $orderId }} </p>
    <p>Order has been given to the driver.</p>
    <p>The following order items were included:</p>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetails as $item)
            <tr>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>RS.{{ number_format($item['price'], 2) }}</td>
                <td>RS.{{ number_format($item['subtotal'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total Amount: RS.{{ number_format($totalAmount, 2) }}</p>
</body>
</html>
