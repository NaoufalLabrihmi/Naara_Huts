<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Login Sample</title>
    <meta charset="utf-8">
    <meta name="description" content="admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets.">
    <meta name="keywords" content="bootstrap, bootstrap 5, admin themes, laravel, free admin themes, bootstrap admin, bootstrap dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="StarCode Kh">
    <meta property="og:url" content="https://souysoeng.com">
    <meta property="og:site_name" content="Soeng Souy">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ URL::to('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css">
</head>

<body id="kt_body" class="app-blank">
    @yield('content')
    <script src="{{ URL::to('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ URL::to('assets/js/scripts.bundle.js') }}"></script>
    @yield('script')

</body>

</html>