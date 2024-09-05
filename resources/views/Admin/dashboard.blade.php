@extends('layouts.admin')

@section('page-title', 'Admin Dashboard')

@section('content')
<div class="dash-container">
    <!-- External Stylesheets -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 2rem;
            font-weight: 700;
            color: #007bff;
        }
        .card {
            border-radius: 10px;
            border-block-color: #007bff;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            text-align: center;
        }
        .table tbody td {
            vertical-align: middle;
            text-align: center;
        }
        .table .fas {
            color: #007bff;
        }
        .date-card {
            position: absolute;
            top: 30px;
            right: 20px;
            width: 200px;
        }
    </style>

    <!-- Dashboard Overview -->
    <div class="row">
        <!-- Overview Card 1 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Overview Card 2 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Total Orders</h5>
                    <p class="card-text">{{ $totalOrders }}</p> 
                </div>
            </div>
        </div>

        <!-- Overview Card 3 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-alt"></i> Monthly Orders</h5>
                    <p class="card-text">{{ $thisMonthOrders }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Overview Section -->
    <div class="row">
        <!-- Overview Card 4 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-truck"></i> Total Drivers</h5>
                    <p class="card-text">{{ $totalDrivers }}</p>
                </div>
            </div>
        </div>

        <!-- Overview Card 5 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total Buyers</h5>
                    <p class="card-text">{{ $totalBuyers }}</p> 
                </div>
            </div>
        </div>

        <!-- Overview Card 6 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-store"></i> Total Sellers</h5>
                    <p class="card-text">{{ $totalSellers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- User Details Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><i class="fas fa-user"></i> Name</th>
                            <th scope="col"><i class="fas fa-envelope"></i> Email</th>
                            <th scope="col"><i class="fas fa-map-marker-alt"></i> District</th>
                            <th scope="col"><i class="fas fa-calendar-alt"></i> Register Date</th>
                            <th scope="col"><i class="fas fa-user"></i> User Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userDetails as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->district->name ?? '' }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>{{ $user->role }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Today's Date Display -->
    <div class="date-card">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-calendar-day"></i> Today's Date</h5>
                <p class="card-text" id="todaysDate"></p>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript to Display Today's Date -->
<script>
    // Get today's date and format it
    const today = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = today.toLocaleDateString(undefined, options);

    // Display the date in the card
    document.getElementById('todaysDate').textContent = formattedDate;
</script>
@endsection
