<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inicia sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/plugins/ionicons/css/ionicons.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/plugins/adminlte/css/adminlte.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card login-card">
    <div class="login-logo" style="align-self: center;">
      <img src="{{ url('/assets/img/login-logo.jpg') }}" alt="pase-logo" style="display: block; width: 200px;">
      <b>Inicia sesión</b>
    </div>
    <div class="card-body login-card-body">
      <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <div class="input-group mb-3">
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
              type="email"
              name="email"
              placeholder="Email"
              value="{{ old('email') }}"
            >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            {!! $errors->first('email', '<span class="invalid-feedback">:message</span>') !!}
          </div>
        </div>
        <div class="form-group">
          <div class="input-group mb-3">
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
              type="password"
              name="password"
              placeholder="Password"
            >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            {!! $errors->first('password', '<span class="invalid-feedback">:message</span>') !!}
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
          </div>
        </div>
      </form>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/plugins/adminlte/js/adminlte.js') }}"></script>

</body>
</html>
