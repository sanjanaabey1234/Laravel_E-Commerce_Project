<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Driver Dashboard</title>
    <link rel="icon" href="{{ asset('assets/img/logoadmin.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    {{-- <link href="{{ asset('assets/css/driver.css') }}" rel="stylesheet"> --}}

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

    
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    

    <style>
        /* Sidebar Styling */
        .sidebar {
              width: 250px;
              height: 100vh;
              background-color: #1e1e2d;
              position: fixed;
              top: 0;
              left: 0;
              color: #fff;
              display: flex;
              flex-direction: column;
              align-items: center;
              padding-top: 20px;
          }
          .sidebar-logo img {
              width: 150px;
              margin-bottom: 20px;
          }
          .sidebar a {
              color: #fff;
              text-decoration: none;
              padding: 15px 20px;
              width: 100%;
              text-align: left;
              border-radius: 5px;
              transition: background-color 0.3s;
          }
          .sidebar a:hover {
              background-color: #495057;
          }
          .sidebar a.active {
              background-color: #007bff;
              color: #fff;
          }

        /* Navbar Styling */
        .navbar {
              margin-left: 250px;
              background-color: #1e1e2d;
              color: #fff;
              padding: 10px 20px;
          }
          #driverBannerCarousel {
            margin-left: 250px;
            margin-top: 10px;
            border-radius: 10px; /* Rounded corners for the carousel */
            overflow: hidden; /* Hide overflow to keep rounded corners clean */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Add shadow for depth */
        }
        .carousel-inner {
            border-radius: 10px; /* Rounded corners for the images and videos */
        }
        .carousel-item img, .carousel-item video {
            width: 100%;
            height: 400px; /* Fixed height for uniformity */
            object-fit: cover; /* Ensure content covers the area */
            border-radius: 10px; /* Rounded corners for the images and videos */
        }
        .carousel-control-prev, .carousel-control-next {
            width: 5%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            border-radius: 50%; /* Circular controls */
        }
        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: rgba(255, 255, 255, 0.8); /* White icon background */
            border-radius: 50%; /* Circular icons */
        }
        .carousel-indicators button {
            background-color: rgba(0, 0, 0, 0.5); /* Darker background for indicators */
        }
        .carousel-indicators .active {
            background-color: #007bff; /* Active indicator color */
        }
          .content {
              margin-left: 250px;
              padding: 20px;
          }
          @media (max-width: 768px) {
              .sidebar {
                  width: 100%;
                  height: auto;
                  position: relative;
                  padding: 10px;
              }
              .navbar {
                  margin-left: 0;
              }
              #driverBannerCarousel {
                  margin-left: 0;
              }
              .content {
                  margin-left: 0;
              }
              .carousel-item img, .carousel-item video {
                height: 100%; /* Adjust height on smaller screens */
                width:100%;
            }
          }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            background-color: #f0f0f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 30px;
            color: #007bff;
        }

        h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        } 

        p {
            font-size: 1.25rem;
            color: #555;
            margin: 0;
        }

        /* ChatBox  */
        .chat-box {
            max-height: 400px;
            overflow-y: scroll;
        }
        .sent, .received {
            margin-bottom: 10px;
        }
        .sent p {
            background-color: #d1e7dd;
            padding: 10px;
            border-radius: 5px;
        }
        .received p {
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
        }
        .time {
            display: block;
            font-size: 0.75rem;
            color: #6c757d;
        }

        .btn-primary {
            background-color: #1e1e2d;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #444;
        }

        /* Footer Styling */
        .footer {
            background: #1e1e2d;
            color: #1e1e2d;
            padding: 40px 0;
        }

        .footer h4 {
            color: #fff;
            margin-bottom: 20px;
        }

        .footer a {
            color: #a8a8a8;
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
        }

        .footer a:hover {
            color: #fff;
        }

        .btn-md-square {
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
        }

        .rounded-circle {
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-logo text-center">
            <img src="{{ asset('assets/img/logoadmin.png') }}" alt="Website Logo">
        </div>
        <a href="{{ route('driver.dashboard') }}" id="home-link" onclick="setActive('home-link')">
            <i class="fas fa-home"></i> Home
        </a>
        <a href="#" id="profile-link" onclick="setActive('profile-link')">
            <i class="fas fa-user"></i> Profile
        </a>
        <a href="#" id="deliveries-link" onclick="setActive('deliveries-link')">
            <i class="fas fa-map-marker-alt"></i> Deliveries
        </a>
        <a href="#" id="chat-link" onclick="setActive('chat-link')">
            <i class="fas fa-comments"></i> Chat
        </a>
        <a href="#" id="Location-link" onclick="setActive('Location-link')">
            <i class="fas fa-location"></i> Location
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="navbar navbar-expand-lg">
        @include('partisan.driverheader')
    </div>

    <!-- Carousel for Banner -->
    <div id="driverBannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#driverBannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#driverBannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#driverBannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/driver background1.png') }}" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <video class="d-block w-100" autoplay loop muted>
                    <source src="{{ asset('assets/img/diver backgound2.mp4') }}" type="video/webm">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/driverbanner1.jpg') }}" class="d-block w-100" alt="Banner 2">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#driverBannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#driverBannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

  

    <script>
        function setActive(activeId) {
            // Remove active class from all sidebar links
            var links = document.querySelectorAll('.sidebar a');
            links.forEach(function(link) {
                link.classList.remove('active');
            });
            
            // Add active class to the clicked link
            var activeLink = document.getElementById(activeId);
            activeLink.classList.add('active');
        }

        // Set the initial active link based on the current URL
        document.addEventListener('DOMContentLoaded', function() {
            var currentUrl = window.location.href;
            var links = document.querySelectorAll('.sidebar a');
            links.forEach(function(link) {
                if (currentUrl.includes(link.getAttribute('href'))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
      
      <div class="content">
        <div id="main-content">
       
            @yield('content')
            <div class="card mt-4">
                <div class="card-body">
                    <div style="text-align: center; margin-bottom: 40px;">
                        <h2 style="font-size: 2.5rem; color: #007bff; margin-bottom: 10px; font-weight: bold; letter-spacing: 1px;">Delivery Driver Dashboard</h2>
                        <p style="font-size: 1.2rem; color: #555; margin-top: 0;">Manage your deliveries efficiently</p>
                    </div>
                    <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold; color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; letter-spacing: 0.5px;">
                        Dashboard Overview
                    </h5>
                    
                    <p class="card-text"></p>
             
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-custom">
                                <div class="card-body text-center">
                                    <div class="icon-circle">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <h4>Products</h4>
                                    <p>{{ $productCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-custom">
                                <div class="card-body text-center">
                                    <div class="icon-circle">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <h4>Sellers</h4>
                                    <p>{{ $sellerCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-custom">
                                <div class="card-body text-center">
                                    <div class="icon-circle">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h4>Buyers</h4>
                                    <p>{{ $buyerCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-custom">
                                <div class="card-body text-center">
                                    <div class="icon-circle">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <h4>Orders</h4>
                                    <p>{{ $orderCount }}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>

            
                
                    <!-- E-commerce Project Information Section -->
                    <div style="background-color: #ffffff; padding: 30px; border-radius: 15px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);">
                        <h3 style="font-size: 2rem; color: #333; margin-bottom: 20px; font-weight: bold; border-bottom: 3px solid #007bff; padding-bottom: 10px;">Our E-commerce Platform Information</h3>
                        <p style="font-size: 1.1rem; color: #666; line-height: 1.6; margin-bottom: 20px;">
                            Welcome to the delivery driver's section of our E-commerce platform. Here, you can view and manage your assigned deliveries, track orders in real-time, and update the status of deliveries. Our goal is to ensure that all orders are delivered promptly and efficiently, enhancing the customer experience.
                        </p>
                        <p style="font-size: 1.1rem; color: #666; line-height: 1.6; margin-bottom: 20px;">
                            Our platform is designed to simplify your workflow by providing all the necessary tools in one place. Stay updated with notifications, access detailed order information, and communicate directly with customers if needed. Let's work together to make every delivery a success.
                        </p>
                        <p style="font-size: 1.1rem; color: #666; line-height: 1.6; margin-bottom: 0;">
                            Thank you for being a vital part of our E-commerce project. Your hard work and dedication help us achieve our mission of delivering quality service to our customers.
                        </p>
                    </div>
                 
                    
            
                </div>
            </div>
        </div>
        
        <div id="driver-details" class="card mt-4" style="display: none;">
            <div class="card" style="max-width: 400px; margin: auto; border: 1px solid #ddd; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden;">
                <div class="card-body text-center" style="padding: 20px; background-color: #f8f9fa;">
                    <h5 class="card-title" style="font-size: 1.5rem; color: #007bff; margin-bottom: 15px;">
                        <i class="fas fa-user-circle" style="font-size: 1.8rem;"></i> Profile
                    </h5>
                    <i class="fas fa-user-tie" style="font-size: 150px; color: #007bff; border: 3px solid #007bff; border-radius: 50%; padding: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);"></i>
                    <p class="card-text" style="font-size: 1rem; color: #333; margin-bottom: 10px;">
                        <strong>Name:</strong> {{ $driver->driver_name }}
                    </p>
                    <p class="card-text" style="font-size: 1rem; color: #333; margin-bottom: 10px;">
                        <strong>Phone No:</strong> {{ $driver->Phone_no }}
                    </p>
                    <p class="card-text" style="font-size: 1rem; color: #333; margin-bottom: 10px;">
                        <strong>Vehicle Info:</strong> {{ $driver->vehicle_info }}
                    </p>
                    <p class="card-text" style="font-size: 1rem; color: #333; margin-bottom: 20px;">
                        <strong>District:</strong> {{ $driver->district->name ?? 'Not Available' }}
                    </p>
                    <a href="{{ route('driver.profile.edit') }}" class="btn btn-primary" style="background-color: #007bff; border: none; padding: 10px 20px; font-size: 1rem; border-radius: 5px; text-decoration: none; color: #fff; transition: background-color 0.3s;">
                        Edit Profile
                    </a>
                </div>
            </div>
            
        </div>

        <div id="deliveries-content" class="card mt-4" style="display: none;">
            <div class="card-body" style="background-color: #f1f3f5; border-radius: 10px; padding: 30px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                <h5 class="card-title" style="color: #007bff; font-size: 2rem; font-weight: 700; margin-bottom: 25px; text-align: center; text-transform: uppercase;">Delivery Details</h5>
                
                @if($deliveries->count())
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                            <thead style="background-color: #007bff; color: #ffffff; font-weight: bold;">
                                <tr>
                                    <th style="text-align: center; padding: 12px;">Order ID</th>
                                    <th style="text-align: center; padding: 12px;">First Name</th>
                                    <th style="text-align: center; padding: 12px;">Town City</th>
                                    <th style="text-align: center; padding: 12px;">Mobile No</th>
                                    <th style="text-align: center; padding: 12px;">Status</th>
                                    <th style="text-align: center; padding: 12px;">Delivery Date</th>
                                    <th style="text-align: center; padding: 12px;">View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deliveries as $delivery)
                                    <tr style="border-bottom: 1px solid #dee2e6;">
                                        <td style="text-align: center; padding: 10px;">{{ $delivery->order_id }}</td>
                                        <td style="padding: 10px;">{{ $delivery->order->first_name }} {{ $delivery->order->last_name }}</td>
                                        <td style="padding: 10px;">{{ $delivery->order->town_city }}</td>
                                        <td style="padding: 10px;">{{ $delivery->order->mobile }}</td>
                                        <td style="padding: 10px;">{{ $delivery->delivery_status }}</td>
                                        <td style="padding: 10px;">{{ $delivery->delivery_date ?? '' }}</td>
                                        <td style="text-align: center; padding: 10px;">
                                            <a href="{{ route('driver.delivery.details', $delivery->delivery_id) }}" class="btn btn-primary" style="padding: 10px 20px; border-radius: 50px; font-size: 0.875rem; color: #ffffff; background-color: #007bff; border: none; text-decoration: none; transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="text-align: center; color: #6c757d; font-size: 1.125rem; font-weight: 500; margin-top: 20px;">No deliveries found.</p>
                @endif
            </div>
            
            
        </div>

        <div id="chat-content" class="card mt-4" style="display: none;">
            <div class="card-body" style="background-color: #f8f9fa; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h5 class="card-title" style="color: #007bff; font-size: 1.75rem; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center;">
                    <i class="fas fa-comments" style="margin-right: 10px; color: #007bff;"></i>
                    Chat with Admin
                </h5>
                
                <div class="chat-box" style="max-height: 400px; overflow-y: auto; padding: 15px; border-radius: 8px; background-color: #ffffff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    @foreach ($messages as $message)
                        <div class="{{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}" style="margin-bottom: 15px;">
                            <span class="time" style="display: block; font-size: 0.75rem; color: #6c757d; margin-bottom: 5px;">{{ $message->created_at }}</span>
                            <p style="background-color: {{ $message->sender_id == Auth::id() ? '#1997ff' : '#e9ecef' }}; color: {{ $message->sender_id == Auth::id() ? '#ffffff' : '#000000' }}; padding: 10px; border-radius: 10px; max-width: 75%; word-wrap: break-word; margin: 0;">
                                {{ $message->message }}
                            </p>
                        </div>
                    @endforeach
                </div>
                
                <form action="{{ route('driver.chat.send') }}" method="POST" style="margin-top: 15px;">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="message" placeholder="Type a message" required style="border-radius: 50px; border: 1px solid #ced4da; padding: 10px; font-size: 1rem;">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" style="border-radius: 50px; padding: 10px 20px; font-size: 1rem; transition: background-color 0.3s, transform 0.3s; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
       

        <div id="Location-content" class="card mt-4" style="display: none;">
            
            <div class="card-body">
                <h5 class="card-title">User Navigation and GPS</h5>

                <div class="input-group">
                    <input type="text" id="start-location" class="form-control" placeholder="Enter Start Location">
                </div>
                <div class="input-group">
                    <input type="text" id="destination" class="form-control" placeholder="Enter Destination">
                </div>
                <button id="get-directions" class="btn btn-primary">Get Directions</button>
    

                <div id="map"></div>

               <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    
    <!-- Leaflet JS -->
  
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- User GPS and Map Initialization -->
    
    <!-- User GPS and Map Initialization -->
   <!-- User GPS and Map Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the map
        var map = L.map('map').setView([51.505, -0.09], 13); // Default view centered on London

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var control; // Declare the routing control variable
        var userLatLng; // Store user's current location

        // Function to handle geocoding and routing
        function getDirections(start, destination) {
            // Remove the existing routing control if it exists
            if (control) {
                map.removeControl(control);
            }

            control = L.Routing.control({
                waypoints: [
                    L.latLng(start.lat, start.lng),
                    L.latLng(destination.lat, destination.lng)
                ],
                routeWhileDragging: true,
                geocoder: L.Control.Geocoder.nominatim()
            }).addTo(map);
        }

        // Event listener for the "Get Directions" button
        document.getElementById('get-directions').addEventListener('click', function () {
            var destination = document.getElementById('destination').value;

            if (userLatLng && destination) {
                L.Control.Geocoder.nominatim().geocode(destination, function (results) {
                    var destinationLatLng = results[0].center;

                    // Call the getDirections function with the start and destination coordinates
                    getDirections(userLatLng, destinationLatLng);
                });
            } else {
                alert('Please enter a destination.');
            }
        });

        // Check if geolocation is available
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                userLatLng = { lat: lat, lng: lng };

                // Set map view to user's location
                map.setView([lat, lng], 13);

                // Add a marker for user's location
                var marker = L.marker([lat, lng]).addTo(map)
                    .bindPopup('You are here!')
                    .openPopup();

                // Add circle to represent accuracy
                var circle = L.circle([lat, lng], {
                    color: 'blue',
                    fillColor: '#3a7bda',
                    fillOpacity: 0.5,
                    radius: position.coords.accuracy
                }).addTo(map);

                // Auto-fill the start location input with the user's coordinates
                document.getElementById('start-location').value = `Lat: ${lat}, Lng: ${lng}`;
            }, function (error) {
                alert('Geolocation failed: ' + error.message);
            });
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    });
</script>
    
            </div>
        </div>
    </div>

   <!-- Footer -->
<footer class="footer text-light py-4" style="background-color: #1e1e2d; color: #f8f9fa; padding: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h4>About Us</h4>
                <p>We are dedicated to providing the best services to our customers.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <h4>Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">Home</a></li>
                    <li><a href="#" class="text-light">Profile</a></li>
                    <li><a href="#" class="text-light">Deliveries</a></li>
                    <li><a href="#" class="text-light">Notifications</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12">
                <h4>Contact Us</h4>
                <p><i class="fas fa-envelope me-2"></i> contact@example.com</p>
                <p><i class="fas fa-phone me-2"></i> +123 456 7890</p>
                <div class="d-flex">
                    <a href="#" class="btn btn-outline-light btn-md-square rounded-circle me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-light btn-md-square rounded-circle me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-light btn-md-square rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>


    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.getElementById('home-link').addEventListener('click', function() {
            showContent('main-content');
        });

        document.getElementById('profile-link').addEventListener('click', function() {
            showContent('driver-details');
        });


        
        document.getElementById('deliveries-link').addEventListener('click', function() {
            showContent('deliveries-content');
        });

        document.getElementById('chat-link').addEventListener('click', function() {
            showContent('chat-content');
        });

        document.getElementById('Location-link').addEventListener('click', function() {
            showContent('Location-content');
        });

        function showContent(contentId) {
            document.getElementById('main-content').style.display = 'none';
            document.getElementById('driver-details').style.display = 'none';

    
            document.getElementById('deliveries-content').style.display = 'none';
            
            document.getElementById('chat-content').style.display = 'none';
            document.getElementById('Location-content').style.display = 'none';
            document.getElementById(contentId).style.display = 'block';
        }
    </script>
    
</body>
</html>
