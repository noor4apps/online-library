<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('frontend/images/icon.png') }}">

    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    @include('site.layouts.plugins')
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <!-- Cusom css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

</head>
<body>

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    @include('site.layouts.header')
    @yield('content')
    @include('site.layouts.footer')
</div>

<!-- Modernizer js -->
<script src="{{ asset('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>

<!-- JS Files -->
<script src="{{ asset('frontend/js/vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/plugins.js') }}"></script>
<script src="{{ asset('frontend/js/active.js') }}"></script>

</body>
</html>
