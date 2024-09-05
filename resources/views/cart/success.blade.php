@extends('layouts.user')

@section('showHeroSection', false)

@section('title', 'Order Successful')

@section('content')
    <div class="container my-5">  
        <div class="container py-5">
            <div class="text-center p-5 bg-primary text-white rounded">
                <h1 class="display-4">Order Successful!</h1>
                <p class="lead">Your order has been placed successfully. Thank you for shopping with us!</p>
                <a href="{{ url('dashboard') }}" class="btn btn-light mt-4">Continue Shopping</a>
            </div>
        </div>
    </div>
@endsection
