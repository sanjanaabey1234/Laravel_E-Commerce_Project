@extends('layouts.driver')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 animate__animated animate__fadeInUp">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-road"></i> Recent Trips</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-map-marker-alt"></i> Trip 1: Location A to B</li>
                        <li class="list-group-item"><i class="fas fa-map-marker-alt"></i> Trip 2: Location C to D</li>
                        <li class="list-group-item"><i class="fas fa-map-marker-alt"></i> Trip 3: Location E to F</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 animate__animated animate__fadeInRight">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fas fa-bell"></i> Notifications</h5>
                    <p class="card-text">No new notifications</p>
                    <button class="btn btn-primary">View All</button>
                </div>
            </div>
        </div>
    </div>
@endsection
