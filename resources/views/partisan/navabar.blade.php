<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-sm">
            <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">SmartSell</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                @if (Auth::check())
                 @if (Auth::user()->role === 'Seller')
                    <div class="navbar-nav mx-auto">
                    
                        <a href="{{ route('seller.dashboard') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'seller.dashboard' ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-box-open"></i> Products
                            </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{Route('seller.show.product') }}" class="dropdown-item {{ Route::currentRouteName() == 'seller.show.product' ? 'active' : '' }}">
                                    <i class="fas fa-apple-alt"></i> Fruits
                                </a>
                                <a href="{{Route('seller.show.vegitable')}}" class="dropdown-item {{ Route::currentRouteName() == 'seller.show.vegitable' ? 'active' : '' }}">
                                    <i class="fas fa-carrot"></i>Vegetables
                                </a>
                                <a href="{{Route('seller.show.clothes')}}" class="dropdown-item {{ Route::currentRouteName() == 'seller.show.clothes' ? 'active' : '' }}">
                                    <i class="fas fa-tshirt"></i>Clothes
                                </a>
                                <a href="{{Route('seller.show.handmadeproduct')}}" class="dropdown-item  {{ Route::currentRouteName() == 'seller.show.handmadeproduct' ? 'active' : '' }}">
                                    <i class="fas fa-hand-holding-heart"></i>Handmade
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('seller.orders', Auth::user()->id) }}" class="nav-item nav-link  {{ Route::currentRouteName() == 'seller.orders' ? 'active' : '' }}">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a> 

                        <a href="{{route('seller.aboutus')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'seller.aboutus' ? 'active' : '' }}">
                            <i class="fas fa-info-circle"></i> About Us
                        </a>  
                        {{-- <a href="{{route('chat.seller')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'chat.seller' ? 'active' : ''}}">
                            <i class="fas fa-comment"></i> Chat Bot
    
                        </a>   --}}
                    </div>
                 @elseif (Auth::user()->role === 'Buyer')
                 <div class="navbar-nav mx-auto">
                    <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-box-open"></i> Products
                        </a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{Route('buyer.fruits') }}" class="dropdown-item {{ Route::currentRouteName() == 'buyer.fruits' ? 'active' : ''}}">
                                <i class="fas fa-apple-alt"></i> Fruits
                            </a>
                            <a href="{{Route('buyer.vegetables')}}" class="dropdown-item {{ Route::currentRouteName() == 'buyer.vegetables' ? 'active' : ''}}">
                                <i class="fas fa-carrot"></i> Vegetables
                            </a>
                            <a href="{{Route('buyer.clothes')}}" class="dropdown-item {{ Route::currentRouteName() == 'buyer.clothes' ? 'active' : ''}}">
                                <i class="fas fa-tshirt"></i> Clothes
                            </a>
                            <a href="{{Route('buyer.handmades')}}" class="dropdown-item {{ Route::currentRouteName() == 'buyer.handmades' ? 'active' : ''}}">
                                <i class="fas fa-hand-holding-heart"></i> Handmade
                            </a>
                        </div>
                    </div>
                    <a href="{{route('buyer.Order.History')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'buyer.Order.History' ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a> 
                    <a href="{{route('buyer.aboutus')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'seller.aboutus' ? 'active' : ''}}">
                        <i class="fas fa-info-circle"></i> About Us
                    </a>  
                    <a href="{{Route('chat')}}" class="nav-item nav-link {{ Route::currentRouteName() == 'chat' ? 'active' : ''}}">
                        <i class="fas fa-info-circle"></i> Chat Bot
                    </a>
                    
                </div>
                
                    
                @endif
                

              @endif
              
                    
                        
                    <div class="d-flex m-3 me-0">
                        {{-- @if (Auth::user()->role === 'Buyer')
                            <a href="{{ route('buyer.cart.view') }}" class="nav-item nav-link my-auto">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </a>
                        @endif --}}
                    
                        <a href="#" class="my-auto" id="profile-icon">
                            <i class="fas fa-user fa-2x" style="color: #81c408;"></i> <!-- Replace '#FF5733' with your desired color -->
                        </a>
                    </div>
            
                   
                    <div class="profile-dropdown" id="profile-dropdown">
                        @if (Auth::check())
                            <div class="dropdown-item">
                                
                                @if (Auth::user()->role === 'Admin')
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-link">Admin Profile</a>
                                @elseif (Auth::user()->role === 'Driver')
                                    <a href="{{ route('driver.dashboard') }}" class="dropdown-link">Driver Profile</a>
                                @elseif (Auth::user()->role === 'Seller')
                                    <a href="{{ route('seller.profile') }}" class="dropdown-link">
                                        <i class="fas fa-user"></i> Profile</a>
                                @elseif (Auth::user()->role === 'Buyer')
                                    <a href="{{ route('dashboard') }}" class="dropdown-link">Customer Profile</a>
                                    <i class="fas fa-user"></i> Profile</a>
                                @endif
                                <p class="dropdown-username">{{ Auth::user()->name }}</p>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="logoutButton btn btn-secondary">
                                            <span class="button-text">Log Out</span>
                                            <i class="fas fa-sign-out-alt"></i>
                                        </button>
                                    </form>
                                </form>
                                
                                
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="dropdown-link">Log in</a>
                        @endif
                    </div>
                </div>
              

            </div>
        </nav>
    </div>
</div>
<script>
    document.getElementById('profile-icon').addEventListener('click', function(event) {
        event.preventDefault();
        var dropdown = document.getElementById('profile-dropdown');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('#profile-icon, #profile-icon *')) {
            var dropdown = document.getElementById('profile-dropdown');
            if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
            }
        }
    }
</script>
<!-- Navbar End -->




@if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif