<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>@yield('title','My Blog')</title>

    <!-- Font --> 
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<!-- Stylesheets --> 
	<link href="{{ asset('assets/frontend/css/bootstrap.css') }}" rel="stylesheet"> 

	<link href="{{ asset('assets/frontend/css/swiper.css') }}" rel="stylesheet"> 

	<link href="{{ asset('assets/frontend/css/ionicons.css') }}" rel="stylesheet">    
   

    @stack('css')


</head>
<body> 
    
    <!-- Header -->
    @include('layouts.frontend.partials.header')
    
    
    @yield('content')
    
    
    <!-- Footer -->
    @include('layouts.frontend.partials.footer')
    
    <!-- Scripts -->  
	<script src="{{ asset('assets/frontend/js/jquery-3.1.1.min.js') }}"></script>

	<script src="{{ asset('assets/frontend/js/tether.min.js') }}"></script>

	<script src="{{ asset('assets/frontend/js/bootstrap.js') }}"></script>

	<script src="{{ asset('assets/frontend/js/swiper.js') }}"></script>

	<script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>

    <!-- JS -->
    @stack('js')

</body>
</html>
