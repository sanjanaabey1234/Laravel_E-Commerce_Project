<!-- Header Wrapper -->
<div class="header-wrapper">
    <div class="header-content">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- User Section -->
        <div class="header-user">
            <div class="dropdown">
                <a href="#" class="user-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- <img src="{{ asset('assets/images/user-avatar.png') }}" alt="User Avatar" class="user-avatar"> --}}
                    <span class="user-name">
                        @if (Auth::User()->role == 'Driver')
                            {{ __('Hi, ') }}{{ Auth::User()->name }}
                        @else
                            {{ __('Guest') }}
                        @endif
                    </span>
                    <i class="fas fa-chevron-down"></i>
                </a>
               
            </div>
        </div>
    </div>
</div>

<style>
    /* Header Wrapper Styling */
    .header-wrapper {
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 10px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #ddd;
    }

    /* User Section Styling */
    .header-user {
        position: relative;
    }

    .user-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #333;
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .user-name {
        font-weight: 500;
        margin-right: 5px;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 1000;
        min-width: 160px;
        padding: .5rem 0;
        font-size: 1rem;
        color: #212529;
        background-color: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: .25rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .dropdown-item i {
        margin-right: 10px;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
</style>
