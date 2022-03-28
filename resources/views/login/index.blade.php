<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Gentelella Alela! | </title>

  <!-- Bootstrap -->
  <link href="{{ asset('assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('assets/admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
  <!-- Animate.css -->
  <link href="{{ asset('assets/admin/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ asset('assets/admin/build/css/custom.min.css') }}" rel="stylesheet">

  <style>
    .has-error .form-control {
      border-color: #a94442 !important;
    }
  </style>
</head>

<body class="login">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
            {!! Form::open([
              'route' => 'login.signin',
              'method' => 'POST'
            ]) !!}
            <h1>Đăng nhập</h1>
            <div class="@error('login.email') has-error @enderror">
              <input name="login[email]" type="email" class="form-control" placeholder="E-mail" />
              @error('login.email')
                <span class="help-block help-block-error error-message"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
            <div class="@error('login.password') has-error @enderror">
              <input name="login[password]" type="password" class="form-control" placeholder="Password" />
              @error('login.password')
              <span class="help-block help-block-error error-message"><strong>{{ $message }}</strong></span>
            @enderror
            </div>
            <div>
              <button type="submit" class="btn btn-default submit">Đăng nhập</button>
              <label>
                <input type="checkbox" name="remember-me" /> Nhớ mật khẩu?
              </label>
            </div>
         {!! Form::close() !!}
        </section>
      </div>
    </div>
  </div>
</body>

</html>