<!DOCTYPE html>
<html lang="en">


<head>
    <title>Login Camp</title>
    <meta charset="utf-8">
    <meta name="description" content="Camp">
    <meta name="keywords" content="Camp">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Camp">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ URL::to('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="{{asset('frontend/assets/img/favicon.png')}}">

</head>

<body id="kt_body" class="app-blank">
    @yield('content')
    <script src="{{ URL::to('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ URL::to('assets/js/scripts.bundle.js') }}"></script>
    @yield('script')

</body>

</html>
