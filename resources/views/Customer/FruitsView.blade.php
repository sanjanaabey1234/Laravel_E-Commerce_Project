@extends('layouts.user')

@section('showHeroSection', false)

@section('title', 'Fruits')

@section('content')
       
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
    <h1 class="mb-4">Our Fruits</h1>

    <div class="row d-flex justify-content-center">
  
            @foreach($fruits as $fruit)
            <div class="col-md-3">
                <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                    <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                        <img src="{{ asset($fruit->image_path) }}" alt="{{ $fruit->fruit_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                    </div>
                    <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Fruits</div>
                    <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                        <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $fruit->fruit_name }}</h5>
                        <p class="mb-1">{{ \Illuminate\Support\Str::limit($fruit->description, 15) }}</p>
                        <p class="text-dark fw-bold mb-1">Rs:{{ number_format($fruit->price, 2) }} / Quantity: {{ $fruit->stock_quantity }}</p>
                        <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $fruit->created_at->format('d M Y') }}</p>
                        <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $fruit->product_id }}">
                            <input type="hidden" name="seller_id" value="{{ $fruit->seller_id }}">
                            <input type="hidden" name="price" value="{{ $fruit->price }}">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $fruit->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                            <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

@endsection
