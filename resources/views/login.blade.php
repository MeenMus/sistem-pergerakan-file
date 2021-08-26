<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>File Management System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<script>
  function visibility3() {
    var x = document.getElementById('password');
    if (x.type === 'password') {
      x.type = "text";
      $('#eyeShow').show();
      $('#eyeSlash').hide();
    } else {
      x.type = "password";
      $('#eyeShow').hide();
      $('#eyeSlash').show();
    }
  }
</script>

<body class="hold-transition login-page">
  <div class="login-box" style="padding-bottom:100px;">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary" style="min-height:350px;">
      <div class="card-header text-center">
        <span class="h2">File Management System</span>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div>
          @if(Session::has('success'))
          <center style="font-size:14px; color:green; font-weight:bold; padding-bottom:10px;">{{Session::get('success')}}</center>
          @endif
        </div>
        <form action="/" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          @if($errors->any())
          <center style="font-size:14px; color:red; font-weight:bold; padding-bottom:12px;">{{$errors->first()}}</center>
          @endif
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
            <span class="input-group-btn" id="eyeSlash">
              <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i style = "font-size:14px" class="fa fa-eye-slash" aria-hidden="true"></i></button>
            </span>
            <span class="input-group-btn" id="eyeShow" style="display: none;">
              <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i style = "font-size:14px"class="fa fa-eye" aria-hidden="true"></i></button>
            </span>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember_me" id="remember_me">
                <label for="remember_me">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
          <p class="mb-0" style="margin-top:20px;">
            <center><a href="/register">Don't have an account? Register here</a></center>
          </p>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
</body>