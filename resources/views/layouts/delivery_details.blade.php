<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f9;
            color: #333;
            transition: background-color 0.5s;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0084ff;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
            text-align: center;
            animation: fadeIn 1s ease-in;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.3);
        }
        .card-title {
            font-size: 1.75rem;
            color: #0084ff;
            font-weight: 600;
            border-bottom: 2px solid #0084ff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-secondary {
            background-color: #0084ff;
            border: none;
            border-radius: 25px;
            padding: 12px 24px;
            font-size: 1.1rem;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-secondary:hover {
            background-color: #0084ff;
            transform: scale(1.05);
        }
        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #0084ff;
            color: #fff;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .table th:hover {
            background-color: #0084ff;
        }
        .table td {
            vertical-align: middle;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #fafafa;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #fff;
        }
        .form-control {
            border-radius: 15px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #0084ff;
            box-shadow: 0 0 0 0.2rem rgba(255, 111, 97, 0.25);
        }
        .form-group label {
            font-weight: 500;
        }
        .text-muted {
            color: #6c757d;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="page-header">
        <h1 class="display-4">Delivery Details</h1>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Delivery Information</h5>
            <p><strong>Delivery ID:</strong> {{ $delivery->delivery_id }}</p>
            <p><strong>Status:</strong> {{ $delivery->delivery_status }}</p>
            <p><strong>Delivery Date:</strong> {{ $delivery->delivery_date }}</p>

            <!-- Update Status Form -->
            <form action="{{ route('driver.delivery.updateStatus', $delivery->delivery_id) }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="delivery_status">Update Status:</label>
                    <select name="delivery_status" id="delivery_status" class="form-control" onchange="this.form.submit()">
                        <option value="Pending" {{ $delivery->delivery_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Transit" {{ $delivery->delivery_status == 'In Transit' ? 'selected' : '' }}>In Transit</option>
                        <option value="Delivered" {{ $delivery->delivery_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="Cancelled" {{ $delivery->delivery_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </form>

            <h5 class="card-title mt-4">Order Information</h5>
            <p><strong>Order ID:</strong> {{ $delivery->order_id }}</p>
            <p><strong>Customer Name:</strong> {{ $delivery->order->first_name }} {{ $delivery->order->last_name }}</p>
            <p><strong>Shipping Address:</strong> {{ $delivery->order->shipping_address }}</p>
            <p><strong>Customer Post Code Zip:</strong> {{ $delivery->order->postcode_zip }}</p>
            <p><strong>Customer Phone:</strong> {{ $delivery->order->mobile }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($delivery->order->total_amount, 2) }}</p>

            <h5 class="mt-4 mb-4 text-center" style="font-size: 1.8rem; color: #0084ff; font-weight: 600;">Order Items</h5>

            @if($delivery->order->orderItems->count())
                <div class="table-container">
                    <table class="table table-striped" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <thead style="background-color: #0084ff; color: #fff; text-align: center;">
                            <tr>
                                <th style="padding: 12px 8px; font-size: 1.1rem;">Product Name</th>
                                <th style="padding: 12px 8px; font-size: 1.1rem;">Quantity</th>
                                <th style="padding: 12px 8px; font-size: 1.1rem;">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($delivery->order->orderItems as $item)
                                <tr style="text-align: center; transition: background-color 0.3s, transform 0.3s; cursor: pointer;" 
                                    onmouseover="this.style.backgroundColor='#00d9ff'; this.style.transform='scale(1.02)';" 
                                    onmouseout="this.style.backgroundColor=''; this.style.transform='scale(1)';">
                                    <td style="padding: 12px 8px; font-size: 1rem; color: #333333;">{{ $item->product->name ?? 'N/A' }}</td>
                                    <td style="padding: 12px 8px; font-size: 1rem; color: #333;">{{ $item->quantity }}</td>
                                    <td style="padding: 12px 8px; font-size: 1rem; color: #333;">${{ number_format($item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center" style="font-size: 1.2rem; color: #6c757d;">No items found for this order.</p>
            @endif
            

          
            
        </div>
    </div>

   <center> <a href="{{ route('driver.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a> </center>
    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
