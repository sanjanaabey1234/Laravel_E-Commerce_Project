<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="icon" href="{{ asset('assets/img/logoadmin.png') }}">
        <meta charset="utf-8">
        <title>Smart-Sell</title>
        <meta content="" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <title>@yield('title') - Customer Dashboard</title>
        <link rel="icon" href="{{ asset('assets/img/logoadmin.png') }}">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="{{asset('assets/lib/lightbox/css/lightbox.min.css')}}" >
        <link href="{{asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

        <!--  Stylesheet -->
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

        <!-- Toastr CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
  
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->
      

        {{-- navgination bar --}}
        @include('partisan.navabar')

        {{-- previous nav bar --}}
        {{-- @include('layouts.navigation') --}}

         {{-- Hero section --}}
        @if (!isset($showHeroSection) || $showHeroSection)
            @include('partisan.herosection')
        @endif

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        @yield('content')
 

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="row g-5">
                    <!-- Company Logo and Tagline -->
                    <div class="col-lg-3 col-md-6">
                        <a href="#">
                            <h1 class="text-primary mb-0">SmartSell</h1>
                            <p class="text-secondary mb-0">Your One-Stop Shop for Everything!</p>
                        </a>
                        <p class="mt-3">Smart  Choice - SmartSell Market</p>
                        <div class="d-flex pt-3">
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    
                 
                        
                   
                    <!-- Quick Links -->
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-light mb-3">Quick Links</h4>
                        <a class="btn-link" >Home</a><br>
                        <a class="btn-link" >Orders</a><br>
                        <a class="btn-link" >About Us</a><br>
                        <a class="btn-link" >Contact Us</a><br>
                        
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-light mb-3">Intro</h4>
                        <p>Empowering small businesses and individuals through resources, support, and community connections for a brighter, sustainable future. Together, we can make a difference.</p>
                        
                        
                    </div>

                    <!-- Contact Information -->
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-light mb-3">Contact Us</h4>
                        <p class="text-light mb-3">Address: 28/A/7, Gold park, Matara</p>
                        <p class="text-light mb-3">Email: smartsellbusiness@gmail.com</p>
                        <p class="text-light mb-3">Phone: 011-2325122</p>
                    </div>
                </div>
            </div>
        </div>     
        <!-- Footer End -->
        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{asset('assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     
     <!-- Define your custom script after including toastr -->
     <script>
        function show_toastr(title, message, type) {
            toastr[type](message, title);
        }
    
        // Example: Display toastr notifications based on session flash messages
        $(document).ready(function() {
            // Check if there's a success message
            @if (session('success'))
                show_toastr('Success', "{{ session('success') }}", 'success');
            @endif
    
            // Check if there's an error message
            @if (session('error'))
                show_toastr('Error', "{{ session('error') }}", 'error');
            @endif
        });
    </script>
    
    <!-- Template Javascript -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    </body>

</html>