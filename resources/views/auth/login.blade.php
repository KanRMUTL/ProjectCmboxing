<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> @yield('title')</title>
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <h2>ระบบจัดการฝ่ายการตลาด</h4>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">กรุณาเข้าสู่ระบบ</p>
  
      <form  action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
          <input type="username" class="form-control" placeholder="username" name="username">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          @foreach ($errors->all() as $message)
            <p class="text-red"> {{ $message }}</p>
          @endforeach
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
  
      
  
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  
  <!-- jQuery 3 -->
  
  </body>
</html>