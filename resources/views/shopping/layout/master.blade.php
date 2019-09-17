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
    {{-- Live ENV  --}}
    {{-- <script src="https://www.paypal.com/sdk/js?client-id=AX33yAYWKaL0h0LiSN6tyir0CGD_Ft9ztwCP2xqhQabpK8CfakgrLgPdD1TKZd16YWL6W7FINMAK1j_7&currency=THB"></script> --}}
    
    {{-- Sandbox ENV --}}
    <script src="https://www.paypal.com/sdk/js?client-id=AYRdeNWYAop7ueYexmDKFc9zSxN0ILG6Pji7dN5-0cIZFw_4Vi-ByQ9S7Ur6X6Ga_uPUhgmb9ZlJQ6sP&currency=THB"></script>
    
    @include('shopping.layout.navbar')
      @yield('content')
    @include('shopping/layout/footer')
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