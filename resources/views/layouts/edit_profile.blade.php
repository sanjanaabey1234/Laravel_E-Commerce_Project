<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
 
    <style>
        body {
            background: linear-gradient(135deg, #006efd, #88d3ce); /* Gradient background */
            overflow-x: hidden;
            font-family: 'Arial', sans-serif;
            color: #333;
            position: relative;
        }
        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: -1;
        }
        .background-animation .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            animation: animate 25s linear infinite;
            pointer-events: none;
        }
        .background-animation .shape:nth-child(1) {
            width: 150px;
            height: 150px;
            top: 10%;
            left: 20%;
            animation-duration: 8s;
        }
        .background-animation .shape:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 60%;
            left: 70%;
            animation-duration: 8s;
        }
        .background-animation .shape:nth-child(3) {
            width: 180px;
            height: 180px;
            top: 30%;
            left: 50%;
            animation-duration: 8s;
        }
        @keyframes animate {
            0% { transform: translate(0, 0); opacity: 1; }
            50% { transform: translate(50px, 50px); opacity: 0.5; }
            100% { transform: translate(0, 0); opacity: 1; }
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin-top: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #1100ff;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        label {
            color: #333;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 50px;
            padding: 12px 24px;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        .btn-back {
            background-color: #00ccff;
            border: none;
            color: #fff;
            border-radius: 50px;
            padding: 12px 24px;
            font-size: 1rem;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-back:hover {
            background-color: #00fff2;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        .text-danger {
            font-size: 0.875rem;
            font-weight: 500;
        }
        .form-control::placeholder {
            color: #888;
            opacity: 1;
        }
        .profile-picture {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #007bff;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .profile-picture img:hover {
            transform: scale(1.05);
        }
        .animate-fade {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="background-animation">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

<div class="container animate-fade">
    <center><h2>Edit Profile</h2></center>
    <div class="profile-picture">
        <i class="fas fa-user-tie" style="font-size: 150px; color: #007bff; border: 3px solid #007bff; border-radius: 50%; padding: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);"></i>

    </div>
    
    <form id="editProfileForm" action="{{ route('driver.profile.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="driver_name">Name</label>
            <input type="text" class="form-control" id="driver_name" name="driver_name" value="{{ old('driver_name', $driver->driver_name) }}" placeholder="Enter your name" required>
            @error('driver_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="Phone_no">Phone Number</label>
            <input type="text" class="form-control" id="Phone_no" name="Phone_no" value="{{ old('Phone_no', $driver->Phone_no) }}" placeholder="Enter your phone number" required>
            @error('Phone_no')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="vehicle_info">Vehicle Information</label>
            <input type="text" class="form-control" id="vehicle_info" name="vehicle_info" value="{{ old('vehicle_info', $driver->vehicle_info) }}" placeholder="Enter vehicle information">
            @error('vehicle_info')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="district_id">District</label>
            <select class="form-control" id="district_id" name="district_id" required>
                @foreach ($districts as $district)
                    <option value="{{ $district->district_id }}" {{ old('district_id', $driver->district_id) == $district->district_id ? 'selected' : '' }}>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
            @error('district_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    <div class="text-center mt-4">
        <a href="{{ route('driver.dashboard') }}" class="btn-back">
            Back To Dashboard
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Form validation animation
    const form = document.getElementById('editProfileForm');
    form.addEventListener('submit', function(event) {
        // Simple validation example
        const formControls = form.querySelectorAll('.form-control');
        let valid = true;

        formControls.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                valid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!valid) {
            event.preventDefault(); // Prevent form submission
            form.classList.add('animate-fade');
        }
    });
</script>
</body>
</html>
