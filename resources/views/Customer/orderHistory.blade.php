@extends('layouts.user')

@section('content')

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #81c408;
            color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            font-size: 1.2rem;
        }
        .card-body {
            background-color: #ffffff;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            padding: 20px;
        }
        h2 {
            color: #81c408;
            margin-bottom: 40px;
            font-weight: bold;
            padding: 20px;
        }
        p, h5, ul {
            color: #343a40;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        li {
            padding: 10px 0;
            border-bottom: 1px solid #f1f1f1;
        }
        li:last-child {
            border-bottom: none;
        }
        strong {
          color: #e8d615;
        }
        .empty-orders {
            text-align: center;
            color: #6c757d;
            font-size: 1.2rem;
            margin-top: 50px;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-input {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            width: 100%;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="search-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Search Orders by Order ID or Status">
    </div>
    
    <h2>Order History</h2>

    <div id="orderList">
        @forelse($orders as $order)
        <div class="card mb-4 order-card">
            <div class="card-header">
                <strong>Order #{{ $order->id }}</strong> - {{ $order->created_at->format('d M Y') }}
            </div>
            <div class="card-body">
                <p><strong>Status:</strong> {{ $order->status }}</p>
                <p><strong>Total Amount:</strong> Rs:{{ number_format($order->total_amount, 2) }}</p>
                <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>

                <h5>Order Items:</h5>
                <ul>
                    @foreach($order->orderItems as $item)
                        <li>
                            <strong>{{ $item->product->name ?? '' }}</strong>
                            - {{ $item->quantity }} x Rs:{{ number_format($item->price, 2) }}
                            = Rs:{{ number_format($item->quantity * $item->price, 2) }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p class="empty-orders">No orders found.</p>
    @endforelse
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const orderList = document.getElementById('orderList');
    const orderCards = orderList.getElementsByClassName('order-card');
    
    searchInput.addEventListener('keyup', function () {
        const filter = searchInput.value.toLowerCase();
        
        for (let i = 0; i < orderCards.length; i++) {
            const card = orderCards[i];
            const headerText = card.getElementsByClassName('card-header')[0].innerText.toLowerCase();
            const bodyText = card.getElementsByClassName('card-body')[0].innerText.toLowerCase();
            
            if (headerText.includes(filter) || bodyText.includes(filter)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        }
    });
});
</script>
@endsection

