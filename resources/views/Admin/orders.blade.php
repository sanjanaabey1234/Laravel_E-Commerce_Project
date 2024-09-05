@extends('layouts.admin')

@section('page-title', 'Admin Orders')

@section('content')

    <div class="dash-container">

        <h3><i class="fas fa-shopping-cart"></i> Orders</h3>
        <div class="d-flex justify-content-between mb-2">
            <div>
                <!-- Left side content (if any) -->
            </div>
            <div>
                <!-- Search Box aligned to the right -->
                <form id="searchForm" method="GET" action="" class="form-inline">
                    <input id="searchInput" type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary ml-2"><i class="fas fa-search"></i> Search</button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"><i class="fas fa-hashtag"></i> Order Id</th>
                        <th scope="col"><i class="fas fa-user"></i> Buyer Name</th>
                        <th scope="col"><i class="fas fa-envelope"></i> Buyer Email</th>
                        <th scope="col"><i class="fas fa-map-marker-alt"></i> Buyer District</th>
                        <th scope="col"><i class="fas fa-calendar-alt"></i> Order Date</th>
                        <th scope="col"><i class="fas fa-toggle-on"></i> Status</th>
                       
                        <th scope="col"><i class="fas fa-cog"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->user->email}}</td>
                        <td>{{$order->user->district}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->status}}</td>
                        <td><a href="{{ route('admin.view.order.details', $order->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> View</a></td>
                    </tr>
                    @endforeach
                  
                </tbody>
            </table>
        </div>
    </div>
     <!-- Toastr Notifications -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <script>
        let timeout = null;

        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                document.getElementById('searchForm').submit();
            }, 600); // Waits 500ms after the user stops typing
        });
    </script>

@endsection
