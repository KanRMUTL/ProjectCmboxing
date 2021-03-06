<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> @yield('title')</title>
  @yield('customstylesheet')
  <link rel="shortcut icon" href="{{ asset('shopping/img/Logo.png') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/marketing/custom.css') }}">

  
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper" id="app" >

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Cmboxing</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Cmboxing</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="{{ route('logout') }}"><i class="fa fa-lg fa-sign-out"></i></a>
            </li>
          </div>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" id="nav">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('images/userImg/'.Auth::user()->img) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left image" style="padding-left: 12px;">
        <p>
          <a href="/employeeProfile/{{Auth::user()->id}}">
            {{ Auth::user()->firstname }}
          </a>
        </p>
        <i class="fa fa-circle text-success"></i> Online
      </div>
      </div>
     
      @if(Auth::user()->role == 1)
        @include('marketing.admin.menu')
      @elseif(Auth::user()->role == 2)
        @include('marketing.head.menu')
      @elseif(Auth::user()->role == 3)
        @include('marketing.employee.menu') 
      @endif
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="@yield('header-class')">
        @yield('header')
        <small>@yield('description')</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      @yield('content')
      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<script src="{{ asset('/js/app.js')}}"></script>
@yield('script')
</body>
</html>