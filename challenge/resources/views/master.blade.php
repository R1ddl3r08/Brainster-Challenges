<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('particles.styles')
</head>
<body>
    @include('particles.navbar')
    @yield('homepage')
    @yield('loginForm')
    @yield('dashboard')
    @include('particles.footer')
    @include('particles.scripts')
</body>
</html>