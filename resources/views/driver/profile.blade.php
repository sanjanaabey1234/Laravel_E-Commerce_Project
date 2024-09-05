<!-- resources/views/driver/profile.blade.php -->
@extends('layouts.driver')

@section('content')
<div class="container">
    <h1>Driver Profile</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $driver->driver_name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Phone Number:</strong> {{ $driver->Phone_no }}</p>
            <p><strong>Vehicle Information:</strong> {{ $driver->vehicle_info }}</p>
            <p><strong>District:</strong> {{ $driver->district->name }}</p>
            <p><strong>State:</strong> {{ $driver->district->state }}</p>
            <p><strong>Country:</strong> {{ $driver->district->country }}</p>
            <p><strong>Joined On:</strong> {{ $driver->created_at->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection
