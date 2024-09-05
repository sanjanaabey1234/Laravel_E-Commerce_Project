{{-- @extends('layouts.driver')

@section('content') --}}

<html>
<body>
    <h1>My Deliveries</h1>

    @foreach($deliveries as $delivery)
        <div class="delivery">
            <h2>Order #{{ $delivery->order->id }}</h2>
            <p>Status: {{ $delivery->delivery_status }}</p>
            <p>Delivery Date: {{ $delivery->delivery_date }}</p>
            <h3>Items:</h3>
            <ul>
                @foreach($delivery->order->items as $item)
                    <li>{{ $item->product->name }} - {{ $item->quantity }} x ${{ $item->price }}</li>
                @endforeach
            </ul>

            <form action="{{ route('driver.updateStatus', $delivery->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="delivery_status">Update Status:</label>
                <select name="delivery_status" id="delivery_status">
                    <option value="Pending" {{ $delivery->delivery_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Transit" {{ $delivery->delivery_status == 'In Transit' ? 'selected' : '' }}>In Transit</option>
                    <option value="Delivered" {{ $delivery->delivery_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="Cancelled" {{ $delivery->delivery_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit">Update</button>
            </form>
        </div>
    @endforeach
</body>
</html>
  
{{-- @endsection --}}
