@extends('layouts.user')

@section('showHeroSection', false)

@section('title', 'Vegetables')

@section('content')

<!-- Custom CSS -->
<style>
    .fruite-item {
        height: 8cm;
        width: 5cm;
        background-color: #f8f9fa;
        overflow: hidden;
        position: relative;
        margin: 0.5rem auto; /* Center horizontally */
    }
    .fruite-img {
        height: 5cm;
        width: 5cm;
        overflow: hidden;
        margin: 0 auto;
    }
    .fruite-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0.25rem;
    }
    .text-label {
        position: absolute;
        top: 0.5cm;
        left: 0.5cm;
        background-color: #6c757d;
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.7em;
    }
    .card-body {
        font-size: 0.8em;
    }
    .card-body h5 {
        font-size: 1em;
    }
    .btn-custom {
        font-size: 0.8em;
    }
</style>


<div class="container my-4">
    <h1 class="mb-4">Our Vegetables</h1>

    <div class="row d-flex justify-content-center">

        @foreach($vegetables as $vegetable)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                <div class="fruite-item rounded">
                    <div class="fruite-img position-relative">
                        <img src="{{ asset($vegetable->image_path) }}" alt="{{ $vegetable->vegetable_name }}">
                    </div>
                    <div class="text-label">Vegetables</div>
                    <div class="card-body px-2 py-1 border border-secondary border-top-0 rounded-bottom">
                        <h5 class="fw-bold mb-1">{{ $vegetable->vegetable_name }}</h5>
                        <p class="mb-1">{{ \Illuminate\Support\Str::limit($vegetable->description, 50) }}</p>
                        <p class="text-dark fw-bold mb-1">Rs:{{ number_format($vegetable->price, 2) }} / Quantity: {{ $vegetable->stock_quantity }}</p>
                        <p class="text-muted mb-1">Created at: {{ $vegetable->created_at->format('d M Y') }}</p>
                        <form action="{{ route('buyer.cart.add') }}" method="POST" class="text-center">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $vegetable->product_id }}">
                            <input type="hidden" name="seller_id" value="{{ $vegetable->seller_id }}">
                            <input type="hidden" name="price" value="{{ $vegetable->price }}">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $vegetable->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                            <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1"></i>Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
