<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('shopping/img/logo.png') }}">

    <!-- Global Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="{{ asset('shopping/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('shopping/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shopping/css/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shopping/css/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shopping/css/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shopping/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shopping/seat.css') }}">
    <link  href="{{ asset('shopping/css/custom/shopping.css') }}">

    @yield('custom-css')
    
  </head>

  <body id="page-top">
    <script src="https://www.paypal.com/sdk/js?client-id=AdeKmKTa4nB9aWe7oZbheexKhuDFwXkfJIwjf8qcbdVlek869ZnqJ34TvF-rUvJcjVSRcXh26ff7VdDk&currency=THB"></script>
    
    @include('shopping.layout.navbar')
    
    @yield('content')
    
    <script src="{{ asset('js/app.js') }}"></script>

    <!--Global JavaScript -->
    <script src="{{ asset('shopping/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('shopping/js/popper/popper.min.js') }}"></script>
    <script src="{{ asset('shopping/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('shopping/js/wow/wow.min.js') }}"></script>
    <script src="{{ asset('shopping/js/owl-carousel/owl.carousel.min.js') }}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ asset('shopping/js/jquery-easing/jquery.easing.min.js') }}"></script> 
    <script src="{{ asset('shopping/js/custom.js') }}"></script> 

    @yield('custom-script')

  </body>

</html>