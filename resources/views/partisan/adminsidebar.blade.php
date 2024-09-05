<!-- Sidebar Wrapper -->
<div class="sidebar-wrapper">
    <div class="m-header">
        <a href="#" class="b-brand">
            <!-- Logo -->
            <img src="{{ asset('assets/img/logoadmin.png') }}" class="logo-light "  sizes="100px" alt="logo">
        </a>
    </div>

    <div class="navbar-content">
        <ul class="dash-navbar">
            @if (Auth::User()->role == 'Admin')
            <li class="dash-item dash-hasmenu {{ in_array(Request::segment(1), ['app-setting']) ? ' active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="dash-link">
                    <span class="dash-micon">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    <span class="dash-mtext">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <!-- Additional Menu Items -->
           
            <li class="dash-item">
                <a href="#" class="dash-link" data-bs-toggle="collapse" data-bs-target="#users-submenu" aria-expanded="false">
                    <span class="dash-micon">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="dash-mtext">{{ __('Users') }}</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <ul id="users-submenu" class="collapse submenu">
                    <li>
                        <a href="{{Route('admin.view.drivers')}}" class="sub-link {{ Route::currentRouteName() == 'admin.view.drivers' ? 'active' : ''}}">
                            <span class="dash-micon">
                                <i class="fas fa-user-tie"></i> <!-- Icon for Drivers -->
                            </span>
                            <span class="dash-mtext">{{ __('Drivers') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{Route('admin.view.sellers')}}" class="sub-link {{Route::currentRouteName() == 'admin.view.sellers' ? 'active' : ''}}">
                            <span class="dash-micon">
                                <i class="fas fa-store"></i> <!-- Icon for Sellers -->
                            </span>
                            <span class="dash-mtext">{{ __('Sellers') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{Route('admin.view.buyers')}}" class="sub-link {{Route::currentRouteName() == 'admin.view.buyers' ? 'active' : ''}}">
                            <span class="dash-micon">
                                <i class="fas fa-user"></i> <!-- Icon for Buyers -->
                            </span>
                            <span class="dash-mtext">{{ __('Buyers') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            
            <li class="dash-item">
                <a href="{{Route('admin.orders')}}" class="dash-link">
                    <span class="dash-micon">
                        <i class="fas fa-shopping-cart"></i>
                    </span>
                    <span class="dash-mtext">{{ __('Orders') }}</span>
                </a>
            </li>
            <li class="dash-item">
                <a href="{{Route('admin.deliveries.view')}} " class="dash-link">
                    <span class="dash-micon">
                        <i class="fas fa-truck"></i>
                    </span>
                    <span class="dash-mtext">{{ __('Deliveries') }}</span>
                </a>
            </li>
           
            @endif
        </ul>
    </div>
</div>

<!-- Sidebar CSS Styles -->
{{-- <style>
.sidebar-wrapper {
    width: 250px;
    background-color: #2b3e50;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

.b-brand {
    padding: 15px;
    display: flex;
    justify-content: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.b-brand img {
    max-width: 150px;
}

.navbar-content {
    padding: 15px 0;
}

.dash-navbar {
    list-style: none;
    padding: 0;
    margin: 0;
}

.dash-item {
    margin: 5px 0;
}

.dash-link {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.dash-link:hover, .dash-item.active .dash-link {
    background-color: #1a2a38;
}

.dash-micon {
    margin-right: 10px;
    font-size: 18px;
}

.dash-mtext {
    font-size: 16px;
    font-weight: 500;
}

.dash-item.active .dash-link {
    background-color: #1a2a38;
}
</style> --}}
