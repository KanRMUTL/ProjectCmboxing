<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title')</title>
    <link rel="shortcut icon" href="shopping/img/favicon.ico">

    <!-- Global Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <link href="shopping/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="shopping/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="shopping/css/animate/animate.min.css">
    <link rel="stylesheet" href="shopping/css/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="shopping/css/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="shopping/css/style.css">
    <link rel="stylesheet" href="{{ asset('css/shopping/seat.css')}}">
    <link  href="shopping/css/custom/index.css">

    <!-- Paypal -->
    {{-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> --}}
  </head>

  <body id="page-top">

    @include('shopping.layout.navbar')

    @include('shopping.layout.login_modal')
    
    @yield('content')

    
    <script src="{{ asset('js/app.js') }}"></script>

    <!--Global JavaScript -->
    <script src="shopping/js/jquery/jquery.min.js"></script>
    <script src="shopping/js/popper/popper.min.js"></script>
    <script src="shopping/js/bootstrap/bootstrap.min.js"></script>
    <script src="shopping/js/wow/wow.min.js"></script>
    <script src="shopping/js/owl-carousel/owl.carousel.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="shopping/js/jquery-easing/jquery.easing.min.js"></script> 
    <script src="shopping/js/custom.js"></script> 

    {{-- <script src="shopping/js/custom/booking.js"></script> --}}
  </body>

</html>