<!DOCTYPE html>
<html lang="en">
<head>
  @include('.asset.head' ,['title' => 'AdminLTE 3 | Log in (v2)'])
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
</head>
<body class="hold-transition login-page">
@yield('mainContent')
<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js"') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>

