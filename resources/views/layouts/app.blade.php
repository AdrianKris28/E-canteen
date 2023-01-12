<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Canteen') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    @yield('css')
    
</head>
<body>
    <div id="app" style="max-width: 428px">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="padding-top: 54px">
            <div class="container">
            
                    <a class="navbar-brand" href="{{ url('/') }}" style="color: white">
                        <h4>E-Canteen</h4>
                    </a>

                    {{-- <a class="navbar-brand" style="color: white">
                        @yield('navbarTitle')
                    </a> --}}
                  
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

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
                        
                            {{-- If user == buyer --}}

                           
                            <li class="nav-item dropdown">

                                <a class="dropdown-item" href="/">Home</a>
                                @if(Auth::user()->role == 'Buyer')
                                <a class="dropdown-item" href="/cartPage">Cart</a>
                                <a class="dropdown-item" href="/transactionHistoryBuyer">History</a>
                                
                                @else

                                <a class="dropdown-item" href="/menuSeller">Menu</a>
                                <a class="dropdown-item" href="/incomingOrder">Incoming Order</a>
                                <a class="dropdown-item" href="salesSeller">Sales</a>
                                <a class="dropdown-item" href="/transactionHistorySeller">History</a>

                                @endif

                                <a class="dropdown-item" href="/account">Account</a>
                                <a class="dropdown-item"  href="#"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                    <form id="logout-form" action="/logoutAccount" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="max-width: 428px">
            @yield('content')
        </main>
    </div>
</body>

    @yield('javascript')
</html>
