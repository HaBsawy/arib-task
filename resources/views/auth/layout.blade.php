<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel10 - @yield('title')</title>
    <link rel="icon" href="{{asset('img/icon.svg') }}" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/side-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elements.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @yield('style')
    <!-- Styles -->

</head>
<body>
<div id="app">

    <section class="login-main">
        <!-- <main class="py-4"> -->
        @yield('content')
        <!-- </main> -->
    </section>
</div>
</body>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/font-awesome/js/all.min.js') }}"></script>
<script src="{{ asset('js/elements.js') }}"></script>
<script src="{{ asset('js/plugin.js') }}"></script>
</html>
