<!DOCTYPE html>
<html lang="en">

  <head>

    {{-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> --}}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="all,follow">

    <title>Login</title>
    <link rel="shortcut icon" href="{{ asset('shopping/img/Logo.png') }}">
    
    <!-- global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="shopping/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="shopping/admin/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="shopping/admin/css/font-icon-style.css">
    <link rel="stylesheet" href="shopping/admin/css/style.default.css" id="theme-stylesheet">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="shopping/admin/css/pages/login.css">
  </head>    
    
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>

    <script src="shopping/admin/js/jquery.min.js"></script>
    <script src="shopping/admin/js/tether.min.js"></script>
    {{-- <script src="shopping/admin/js/bootstrap.min.js"></script> --}}
  </body>

</html>