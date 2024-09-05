@extends('layouts.admin')

@section('page-title', 'Delivery List')

@section('content')
    <div class="dash-container">
        <h2 class="mb-4">Delivery List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                   
                    <th scope="col"><i class="fas fa-hashtag"></i> ID</th>
                    <th scope="col"><i class="fas fa-user"></i>Driver Name</th>
                    <th scope="col"><i class="fas fa-truck"></i>Delivery Status</th>
                    <th scope="col"><i class="fas fa-calendar-alt"></i>Assign Date</th>
                    <th scope="col"><i class="fas fa-calendar-alt"></i>Delivery Date</th>
                    <th scope="col"><i class="fas fa-cog"></i>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deliveries as $delivery)
                    <tr>
                       
                        <td>{{ $delivery->order_id }}</td>
                        <td>{{ $delivery->driver->driver_name ?? 'N/A' }}</td> <!-- Adjusted the driver name retrieval -->
                        <td>{{ $delivery->delivery_status }}</td>
                        <td>{{ $delivery->created_at}}</td>
                        <td>{{ $delivery->delivery_date }}</td> <!-- Formatted the date -->
                        <td>
                            <a href="" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
