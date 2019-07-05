<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('head.title')</title>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    @yield('head.css')
</head>
<body>

    @include('partials.navbar')

    @yield('body.content')

    @include('partials.footer')
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script> 
    @yield('body.js')
</body>
</html>