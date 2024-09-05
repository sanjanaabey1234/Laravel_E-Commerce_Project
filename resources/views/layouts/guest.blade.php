<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('assets/img/logoadmin.png') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
         <!--  Stylesheet -->
         <link href="{{asset('assets/css/registerformstyle.css')}}" rel="stylesheet">
 
         
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen" background="{{asset('assets/img/login background image.png')}}">

      <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
       
        {{ $slot }}

      </div>
   
    </body>
</html>
