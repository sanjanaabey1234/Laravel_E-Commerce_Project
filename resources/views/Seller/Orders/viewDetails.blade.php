@extends('layouts.user')

@section('showHeroSection', false)

@section('content')

<div class="container" style="max-width: 900px; margin-top: 20px;">
    <form id="order-form" action="{{ Route('seller.order.shipped',Auth::user()->id) }}" method="POST">
     @csrf
        

        <?php
            $totalPrice = 0;
        ?>
        <h2 style="font-size: 28px; font-weight: bold; margin-bottom: 20px; text-align: center; color: #333;">Order Details</h2>
        
        <!-- Order Information Card -->
        <div class="card mb-3" style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border: none;">
            <div class="card-header" style="background-color: #81c408; border-bottom: 1px solid #100f0f; padding: 15px;">
                @php
                    $uniqueSellers = $orders->unique('order.user_id'); // Adjust the unique field as needed
                @endphp
                <strong style="font-size: 18px;color: #100f0f;">Order ID: {{ $orders[0]->order->id }}</strong>
                
                
            </div>
            <div class="card-body" style="padding: 20px;">
                <h5 class="card-title" style="font-size: 22px; margin-bottom: 15px;">Buyer Information</h5>
                @foreach ($uniqueSellers as $sellerDetails)
                    <p style="margin-bottom: 8px;"><strong>Name:</strong> {{ $sellerDetails->order->first_name }} {{ $sellerDetails->order->last_name }}</p>
                    <p style="margin-bottom: 8px;"><strong>Email:</strong> {{ $sellerDetails->order->email_address }}</p>
                    <p style="margin-bottom: 0;"><strong>Shipping Address:</strong> {{ $sellerDetails->order->address }}</p>
                @endforeach
            </div>
        </div>
        {{-- order id --}}
        <input type="hidden" name="order_id" value="{{ $orders[0]->order->id }}">


        <!-- Order Items Card -->
        <div class="card mb-3" style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border: none;">
            <div class="card-body" style="padding: 20px;">
                <h5 class="card-title" style="font-size: 22px; margin-bottom: 15px;background-color: #81c408;">Order Items</h5>
                <table class="table table-bordered" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <thead  >
                        <tr>
                            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;back">Product Name</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Quantity</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Price</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($orders as $orderItem)
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">{{ $orderItem->product->name }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">{{ $orderItem->quantity }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">RS.{{ number_format($orderItem->price, 2) }}</td>
                            <td style="padding: 12px; border-bottom: 1px solid #ddd;">RS.{{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                            <?php
                                $totalPrice += $orderItem->price * $orderItem->quantity;
                            ?>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Summary Card -->
        <div class="card mb-3" style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border: none;">
            <div class="card-body" style="padding: 20px;">
                <h5 class="card-title" style="font-size: 22px; margin-bottom: 15px;background-color: #81c408;">Order Summary</h5>
                <p style="font-size: 18px; margin-bottom: 20px;"><strong>Total Amount:</strong> RS.{{ number_format($totalPrice, 2) }}</p>
                
                <!-- Status Dropdown -->
                <div class="dropdown-status" style="margin-bottom: 20px;">
                    <label for="status-select" class="form-label" style="font-size: 16px; margin-bottom: 8px;">Status:</label>
                    <select id="status-select" class="form-select" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                        <option value="Pending" {{ session('currentStatus') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Shipped" {{ session('currentStatus') == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="Delivered" {{ session('currentStatus') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="Cancelled" {{ session('currentStatus') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
            </div>
        </div>

        <!-- Buttons -->
        <div class="button-container d-flex justify-content-between" style="margin-top: 20px;">
            <a href="{{ route('seller.orders', Auth::user()->id) }}" class="btn btn-secondary" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; text-decoration: none;">Back to Orders</a>
            <button class="btn btn-success" style="padding: 10px 20px; background-color: #28a745; border: none; color: #fff; border-radius: 5px;">Save Changes</button>
        </div>  
    </form>
</div>

@endsection
