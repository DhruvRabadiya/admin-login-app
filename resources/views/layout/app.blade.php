<!DOCTYPE html>
<html lang="en">

<head>
    @include('.includes.head', ['title' => $title ?? 'Admin Panel'])
    @yield('links')
</head>

<body class="hold-transition sidebar-mini">
    @yield('mainContent')
    <!-- jQuery -->
    <script src="{{ asset('js/profile/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/profile/demo.js') }}"></script>
    @yield('scripts')
</body>

</html>

