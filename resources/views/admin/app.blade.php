<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Laravel</title>

    <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Codebase">
    <meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/style-admin.css')}}"> --}}
</head>
<body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed sidebar_style_inverse_on">
        @include('admin.includes.sidebar')

        @include('admin.includes.header')

            @yield('content')

        @include('admin.includes.footer')
    </div>
    <script src="{{ asset('assets/js/codebase.core.min.js')}}"></script>

    <script src="{{ asset('assets/js/codebase.app.min.js')}}"></script>


</body>
</html>
