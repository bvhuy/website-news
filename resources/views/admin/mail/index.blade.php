<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="{{ url('/') }}" name="_base_url">
  <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
          'baseUrl'   =>  url('/'),
      ]); ?>
  </script>
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
  <link href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet">
</head>

<body class="login">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content" style="text-align: left;">
        {!! Form::ajax([
            'route' => 'verification.resend',
            'method' => 'POST'
        ]) !!}
        <div>
            <p>Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, bạn có thể xác minh địa chỉ email của mình bằng cách nhấp vào liên kết mà chúng tôi vừa gửi email cho bạn không? Nếu bạn không nhận được email, chúng tôi sẽ sẵn lòng gửi cho bạn một email khác.</p>
        </div>
        <div>
            <button type="submit" class="btn btn-default submit">Gửi lại email xác minh</button>
            <a class="reset_pass" href="{{ route('logout') }}">Đăng xuất</a>
        </div>
        {!! Form::close() !!}
        </section>
      </div>
    </div>
  </div>
</body>
<!-- jQuery -->
<script src="{{ asset('assets/admin/vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery.blockui.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/scripts/app.min.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/scripts/handle.js')}} "></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
</html>