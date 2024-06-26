<!DOCTYPE html>
<html lang="en">

<head>
    @include('.includes.head', ['title' => $title ?? 'Admin Panel'])
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
</head>

<body class="hold-transition login-page">
    @yield('mainContent')
    <!-- jQuery -->
    <script src="{{ asset('js/profile/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>

</html>
