@extends('layouts.admin')

@section('page-title', 'Order Details')

@section('content')
    <div class="dash-container">
        <h3 style="color: #3498db;"><i class="fas fa-shopping-cart"></i> Order Details</h3>
        
        @php
            $TotalPrice = 0;
            $uniqueorders = $order->unique('order.user_id');
        @endphp

        <!-- Order Overview Section -->
        <div class="order-overview mb-4 p-4" style="background-color: #f1f1f1; border-radius: 10px;">
            <h5 style="color: #27ae60;"><i class="fas fa-hashtag"></i> Order ID: {{ $order[0]->order->id }}</h5><br>
            @foreach ($uniqueorders as $uniqueorder)
                <p><strong style="color: #e74c3c;">Buyer Name:</strong> {{ $uniqueorder->order->first_name }} {{ $uniqueorder->order->last_name }}</p>
                <p><strong style="color: #e74c3c;">Buyer Email:</strong> {{ $uniqueorder->order->email_address }}</p>
                <p><strong style="color: #e74c3c;">Buyer District:</strong> {{ $uniqueorder->order->address }}</p>
                <p><strong style="color: #e74c3c;">Order Date:</strong> {{ $uniqueorder->order->created_at }}</p>
                <p><strong style="color: #e74c3c;">Status:</strong> {{ $uniqueorder->order->status }}</p>
            @endforeach
        </div>

        <!-- Sellers Section -->
        <h4 style="color: #27ae60;"><i class="fas fa-store"></i> Sellers and Products</h4>

        <div class="table-responsive mb-4">
            <table class="table table-striped" style="background-color: #ecf0f1;">
                <thead class="thead-light" style="background-color: #95a5a6;">
                    <tr>
                        <th scope="col" style="color: #2c3e50;"><i class="fas fa-user"></i> Seller ID</th>
                        <th scope="col" style="color: #2c3e50;"><i class="fas fa-box"></i> Product</th>
                        <th scope="col" style="color: #2c3e50;"><i class="fas fa-tag"></i> Price</th>
                        <th scope="col" style="color: #2c3e50;"><i class="fas fa-sort-amount-up"></i> Quantity</th>
                        <th scope="col" style="color: #2c3e50;"><i class="fas fa-dollar-sign"></i> Total</th>
                        <th scope="col" style="color: #2c3e50;"><i class="fas fa-toggle-on"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $orderItem)
                        <tr>
                            <td style="color: #8e44ad;">{{ $orderItem->seller_id }}</td>
                            <td style="color: #8e44ad;">{{ $orderItem->product->name ?? '' }}</td>
                            <td style="color: #8e44ad;">RS.{{ number_format($orderItem->price, 2) }}</td>
                            <td style="color: #8e44ad;">{{ $orderItem->quantity }}</td>
                            <td style="color: #8e44ad;">RS.{{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                            <td style="color: #8e44ad;">{{ $orderItem->order->status }}</td>
                            @php
                                $TotalPrice += $orderItem->price * $orderItem->quantity;
                            @endphp
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Driver Assignment Section -->
        <div class="driver-assignment mb-4 p-4" style="background-color: #f1f1f1; border-radius: 10px;">
            <h4 style="color: #27ae60;"><i class="fas fa-truck"></i> Assign Driver</h4>
            <form method="POST" action="{{ route('admin.assign.driver', $order[0]->order->id) }}">
                @csrf
                <div class="form-group">
                    <label for="driverSelect"><strong style="color: #2980b9;">Select Driver:</strong></label>
                    <select class="form-control" id="driverSelect" name="driver_id" style="color: #2980b9;">
                        <option value="">-- Select Driver --</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->driver_id }}" {{ $delivery && $delivery->driver->driver_id == $driver->driver_id ? 'selected' : '' }}>
                                {{ $driver->driver_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($delivery)
                    <p><strong style="color: #e74c3c;">Already Assigned Driver:</strong> {{ $delivery->driver->driver_name }}</p>
                @endif
                <button id="assignDriverBtn" type="submit" class="btn btn-primary" style="background-color: #3498db; border-color: #3498db;"><i class="fas fa-check"></i> Assign Driver</button>
            </form>
        </div>

        <!-- Final Bill Section -->
        <div class="final-bill p-4" style="background-color: #f1f1f1; border-radius: 10px;">
            <h4 style="color: #27ae60;"><i class="fas fa-receipt"></i> Final Bill</h4>
            <p><strong style="color: #e74c3c;">Subtotal:</strong> RS.{{ $TotalPrice }}</p>
            <p><strong style="color: #e74c3c;">Shipping:</strong> RS.00.00</p>
            <h4><strong style="color: #c0392b;">Total:</strong> RS.{{ $TotalPrice }}</h4>
        </div>

        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('admin.orders') }}" class="btn btn-secondary" style="background-color: #7f8c8d; border-color: #7f8c8d;"><i class="fas fa-arrow-left"></i> Back to Orders</a>
        </div>
    </div>

    <!-- Toastr Notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection
