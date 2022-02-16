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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    My Blog
                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('blog') || request()->routeIs('post') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact.create') ? 'active' : '' }}" href="{{ route('contact.create') }}">Contact</a>
                        </li>
                    </ul>   

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->utype == 'admin')
                                        Admin
                                    @endif
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ Auth::user()->utype == 'admin' ? route('admin.home') : route('home') }}">
                                        Dashboard
                                    </a>

                                    @if (Auth::user()->utype == 'admin')
                                        <a class="dropdown-item" href="{{ route('category.index') }}">
                                            Manage Categories
                                        </a>

                                        <a class="dropdown-item" href="{{ route('admin.contact') }}">
                                            Contact Messages
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('post.index') }}">
                                        Manage Posts
                                    </a>

                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#logout">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <div class="modal fade" id="logout">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body py-3">
                        <div class="text-center">
                            <p class="text-muted">You are about to logout. Continue?</p>
                            <a class="btn btn-secondary px-4 mx-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <button class="btn btn-light border px-4 mx-2" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main>
            @yield('content')
        </main>

        <footer class="main-footer">
            <div class="container">
                <div class="details row">
                    <div class="col-md">
                        <h6 class="logo">Bootstrap Blog</h6>
                        <div class="contact-details">
                            <p class="mb-1">53 Broadway, Broklyn, NY 11249</p>
                            <p class="mb-1">Phone: (020) 123 456 789</p>
                            <p class="mb-2">Email: <a href="mailto:info@company.com">Info@Company.com</a></p>
                            <ul class="social-menu">
                                <li class="list-inline-item mx-3"><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item mx-3"><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item mx-3"><a href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item mx-3"><a href="javascript:void(0)"><i class="fab fa-behance"></i></a></li>
                                <li class="list-inline-item mx-3"><a href="javascript:void(0)"><i class="fab fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
    
                    <div class="col-md">
                        <div class="menus d-flex">
                            <ul class="list-unstyled mr-5">
                                <li> <a href="javascript:void(0)">My Account</a></li>
                                <li> <a href="javascript:void(0)">Add Listing</a></li>
                                <li> <a href="javascript:void(0)">Pricing</a></li>
                                <li> <a href="javascript:void(0)">Privacy &amp; Policy</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li> <a href="javascript:void(0)">Our Partners</a></li>
                                <li> <a href="javascript:void(0)">FAQ</a></li>
                                <li> <a href="javascript:void(0)">How It Works</a></li>
                                <li> <a href="javascript:void(0)">Contact</a></li>
                            </ul>
                        </div>
                    </div>
    
                    <div class="col-md">
                        <div class="latest-posts">
                            <a href="javascript:void(0)">
                                <div class="post d-flex align-items-center">
                                    <div class="image col-2"><img src="{{ asset('/images/img/small-thumbnail-1.jpg') }}" alt="..." class="img-fluid"></div>
                                    <div class="title"><strong>Hotels for all budgets</strong> <br> <span class="date last-meta">October 26, 2016</span></div>
                                </div>
                            </a>
                            <a href="javascript:void(0)">
                                <div class="post d-flex align-items-center">
                                    <div class="image col-2"><img src="{{ asset('/images/img/small-thumbnail-2.jpg') }}" alt="..." class="img-fluid"></div>
                                    <div class="title"><strong>Great street atrs in London</strong> <br> <span class="date last-meta">October 26, 2016</span></div>
                                </div>
                            </a>
                            <a href="javascript:void(0)">
                                <div class="post d-flex align-items-center">
                                    <div class="image col-2"><img src="{{ asset('/images/img/small-thumbnail-3.jpg') }}" alt="..." class="img-fluid"></div>
                                    <div class="title"><strong>Best coffee shops in Sydney</strong> <br> <span class="date last-meta">October 26, 2016</span></div>
                                </div>
                            </a>
                        </div>
                    </div>
                        
                </div>
            </div>
    
            <div class="copyrights">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-lg-left text-center">
                            <p>&copy; {{ date('Y') }}. All rights reserved. Your great site.</p>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
    </div>
</body>
</html>
