<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('login/assets/css/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('login/assets/css/font/material-icon/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('login/assets/css/font/font-awesome/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('login/assets/css/plugin/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('login/assets/css/custom.css') }}">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="skin-blue sidebar-mini">
    {{ $slot }}
    <script src="{{ asset('login/assets/js/plugin/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('login/assets/js/plugin/popper.min.js') }}"></script>
    <script src="{{ asset('login/assets/js/plugin/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login/assets/js/plugin/adminlte.min.js') }}"></script>
    <script src="{{ asset('login/assets/js/app.js') }}"></script>
</body>

</html>
