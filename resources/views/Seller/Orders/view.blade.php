@extends('layouts.user')

@section('showHeroSection', false)

@section('content')

<div class="container container-custom mt-4">
    <h2 class="heading-custom">My Orders</h2>
    <div class="table-responsive">
        <table class="table table-striped table-custom">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Buyer Name</th>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $orderItems)
                    @php
                        $order = $orderItems->first()->order;
                        $productDetails = $orderItems->map(function ($item) {
                            return $item->product->name . ' (' . $item->quantity . ' x RS.' . number_format($item->price, 2) . ')';
                        })->join(', ');
                        $totalPrice = $orderItems->sum(function ($item) {
                            return $item->price * $item->quantity;
                        });
                    @endphp
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td>{{ $productDetails }}</td> <!-- Display product names with quantity and unit price -->
                        <td>RS.{{ number_format($totalPrice, 2) }}</td> <!-- Display total price -->
                        <td><a href="{{ route('seller.view.order.details', ['order' => $order->id]) }}" class="btn btn-primary btn-sm btn-primary-custom">View Details</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination controls (dummy, no functionality) -->
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-custom">
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

@endsection
