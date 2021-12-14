<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Blog</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0 d-lg-inline d-none">
                    <div class="left-hand-side d-flex align-items-center">
                        <div class="container">
                            <h1 class="font-weight-bold text-white fa-4x">@yield('page_name')</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="right-hand-side d-lg-flex align-items-center justify-content-center">
                        <div class="w-100 py-5">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
