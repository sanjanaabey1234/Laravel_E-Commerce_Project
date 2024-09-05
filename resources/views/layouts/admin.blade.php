
<!DOCTYPE html>
<html lang="en" dir="{{ isset($SITE_RTL) && $SITE_RTL == 'on' ? 'rtl' : '' }}">

<head>
    <link rel="icon" href="{{ asset('assets/img/logoadmin.png') }}">
    <title>@yield('page-title') </title>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Dashboard Template Description" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="SmartSell" />
    <meta name="base-url" content="{{-- {{URL::to('/')}} --}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    
    <!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">





</head>

<body >
    @include('partisan.adminsidebar')
    @include('partisan.adminheader')

    <div class="page-header-title">
        <h4 class="m-b-10">@yield('page-title')</h4>
    </div>

    <!-- [ Main Content ] start -->
    <div class="dash-container">
        <div class="dash-content">
            
            @yield('content')
        </div>
    </div>
    <!-- [ Main Content ] end -->


    <div id="commanModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modelCommanModelLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelCommanModelLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <div id="commanModelOver" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modelCommanModelLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelCommanModelLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for toastr) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
     
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
    
</body>


</html>