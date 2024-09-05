@extends('layouts.user')

@section('showHeroSection', false)

@section('title', 'My Cart')

@section('content')
<div class="container my-5">
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h3 class="mb-4">My Cart ({{ $items->count() }} items)</h3> <!-- Displays the number of products -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($item->product->image_path) }}" class="img-fluid rounded-circle me-3" style="width: 80px; height: 100px;" alt="{{ $item->product->name }}">

                                </div>
                            </td>
                            <td class="align-middle">{{ $item->product->name }}</td>
                            <td class="align-middle">Rs:{{ number_format($item->price, 2) }}</td>
                            <td class="align-middle">
                                <form action="{{ route('buyer.cart.update', $item->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group quantity" style="max-width: 180px;">
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control text-center">
                                        <input type="hidden" name="price" value="{{ $item->price }}">
                                        <button type="submit" class="btn btn-outline-secondary">Update</button>
                                    </div>
                                </form>
                            </td>
                            <td class="align-middle">Rs:{{ number_format($item->price * $item->quantity, 2) }}</td>
                            <td class="align-middle">
                                <form action="{{ route('buyer.cart.delete', $item->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total</strong></td>
                            <td colspan="2">Rs:{{ number_format($items->sum(function ($item) {
                                return $item->price * $item->quantity;
                            }), 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-end mt-4">
                <a href="{{ route('buyer.order.process', $cart->id) }}" class="btn btn-primary btn-lg">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>
@endsection
