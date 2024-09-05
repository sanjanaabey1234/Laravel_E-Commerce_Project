@extends('layouts.admin')

@section('page-title', 'Admin Sellers View')

@section('content')
<div class="dash-container">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <h3><i class="fas fa-store"></i> Sellers</h3>
    <div class="d-flex justify-content-between mb-2">
        <div>
            <!-- Left side content (if any) -->
        </div>
        <div>
            <!-- Search Box aligned to the right -->
            <form id="searchForm" method="GET" action="{{ route('admin.sellers.search') }}" class="form-inline">
                <input id="searchInput" type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary ml-2"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><i class="fas fa-user"></i> Name</th>
                    <th scope="col"><i class="fas fa-envelope"></i> Email</th>
                    <th scope="col"><i class="fas fa-map-marker-alt"></i> District</th>
                    <th scope="col"><i class="fas fa-calendar-alt"></i> Register Date</th>
                   
                    <th scope="col"><i class="fas fa-cog"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sellers as $seller)
                <tr>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->district->name ?? '' }}</td>
                    <td>{{ $seller->created_at }}</td>
                   
                    <td>
                        <form action="{{ route('admin.sellers.delete', $seller->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Seller?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    let timeout = null;

    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            document.getElementById('searchForm').submit();
        }, 500); // Waits 500ms after the user stops typing
    });
</script>
@endsection