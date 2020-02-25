<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('shopping/img/Logo.png') }}">

  <!-- Global Stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('shopping/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/jquery.timepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/lightbox.min.css') }}">
  <link rel="stylesheet" href="{{ asset('shopping/css/custom.css') }}">

  @yield('custom-css')

</head>

<body id="page-top">
  {{-- Live ENV developer's token  --}}
  {{-- <script src="https://www.paypal.com/sdk/js?client-id=AYyIR29sBnQywy4Gwn0-BU77TM_0Io4MP5R8CGAkh1RpyACdgsRTZWRepiL7oY3OM4oVtpwqcaPlpdZI&currency=THB"></script> --}}

  {{-- Live ENV  Token of CMBS --}}
  <script
    src="https://www.paypal.com/sdk/js?client-id=AYRdeNWYAop7ueYexmDKFc9zSxN0ILG6Pji7dN5-0cIZFw_4Vi-ByQ9S7Ur6X6Ga_uPUhgmb9ZlJQ6sP&currency=THB">
  </script>

  @include('shopping.layout.navbar')
  @yield('content')
  @include('shopping/layout/footer')


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#F96D00" />
    </svg>
  </div>

  <!-- Plugin JavaScript -->
  <script src="{{ asset('shopping/js/jquery.min.js') }}"></script>
  <script src="{{ asset('shopping/js/lightbox.min.js') }}"></script>
  <script src="{{ asset('shopping/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('shopping/js/popper.min.js') }}"></script>
  <script src="{{ asset('shopping/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('shopping/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('shopping/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('shopping/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('shopping/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('shopping/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('shopping/js/aos.js') }}"></script>
  <script src="{{ asset('shopping/js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('shopping/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('shopping/js/jquery.timepicker.min.js') }}"></script>
  <script src="{{ asset('shopping/js/scrollax.min.js') }}"></script>
  <script src="{{ asset('shopping/js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
  @yield('custom-script')

</body>

</html>