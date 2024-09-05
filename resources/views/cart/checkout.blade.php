@extends('layouts.user')

@section('showHeroSection', false)

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Checkout</h1>

    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h2 class="mb-4">Billing Details</h2>
            <form action="{{ route('buyer.order.save') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                     
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="first_name" class="form-label">First Name:</label>
                                    <input type="text" id="first_name" name="first_name" required class="form-control rounded-pill shadow-sm">
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="last_name" class="form-label">Last Name:</label>
                                    <input type="text" id="last_name" name="last_name" required class="form-control rounded-pill shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" id="address" name="address" required class="form-control rounded-pill shadow-sm">
                        </div>

                        <div class="form-group mb-4">
                            <label for="town_city" class="form-label">Town/City:</label>
                            <input type="text" id="town_city" name="town_city" required class="form-control rounded-pill shadow-sm">
                        </div>

                        <div class="form-group mb-4">
                            <label for="postcode_zip" class="form-label">Postcode/ZIP:</label>
                            <input type="text" id="postcode_zip" name="postcode_zip" required class="form-control rounded-pill shadow-sm">
                        </div>

                        <div class="form-group mb-4">
                            <label for="mobile" class="form-label">Mobile:</label>
                            <input type="text" id="mobile" name="mobile" required class="form-control rounded-pill shadow-sm">
                        </div>

                        <div class="form-group mb-4">
                            <label for="email_address" class="form-label">Email Address:</label>
                            <input type="email" id="email_address" name="email_address" required class="form-control rounded-pill shadow-sm">
                        </div>

                        <div class="form-group mb-4">
                            <label for="order_notes" class="form-label">Order Notes:</label>
                            <textarea id="order_notes" name="order_notes" class="form-control rounded shadow-sm" placeholder="Order Notes (Optional)"></textarea>
                        </div>
                    
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table table-striped shadow-sm">
                                <thead class="bg-primary text-white rounded">
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($item->product->image_path) }}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="{{ $item->product->name }}">
                                            </div>
                                        </th>
                                        <td class="align-middle">{{ $item->product->name }}</td>
                                        <td class="align-middle">Rs:{{ number_format($item->price, 2) }}</td>
                                        <td class="align-middle">{{ $item->quantity }}</td>
                                        <td class="align-middle">Rs:{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="align-middle"></td>
                                        <td class="align-middle"></td>
                                        <td class="align-middle">
                                            <p class="mb-0 text-dark">Subtotal</p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">Rs:{{ number_format($totalAmount, 2) }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="align-middle text-uppercase">Total</td>
                                        <td class="align-middle"></td>
                                        <td class="align-middle"></td>
                                        <td class="align-middle">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">Rs:{{ number_format($totalAmount, 2) }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary py-3 px-4 rounded-pill shadow-sm w-100 text-uppercase">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
