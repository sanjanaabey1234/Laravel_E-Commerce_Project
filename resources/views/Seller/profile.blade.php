@extends('layouts.user')

@section('showHeroSection', false)

@section('content')
<div class="container container-custom mt-4">
    <div class="row">
        <!-- Profile Edit Form -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Profile</h2>
                </div>
                <div class="card-body">
                    <form id="updateForm" method="POST" action="{{Route('seller.profile.update',Auth::user()->id)}}">
                        @csrf
                       
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="district" class="form-label">District</label>
                            <select class="form-select" id="district" name="district" required>
                                <option value="" disabled>Select your district</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->district_id }}" {{ Auth::user()->district_id == $district->district_id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Toastr Notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
   <!-- Custom JS File Link -->
   <script src="{{asset('assets/seller/js/script.js')}}"></script>
<script>
    // Toastr notifications
      document.addEventListener('DOMContentLoaded', function() {
         // Toastr options
         toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
         };

         @if (session('success'))
            toastr.success("{{ session('success') }}");
         @endif

         @if (session('error'))
            toastr.error("{{ session('error') }}");
         @endif

         @if ($errors->any())
            @foreach ($errors->all() as $error)
               toastr.error("{{ $error }}");
            @endforeach
         @endif
      });
</script>
@endsection
