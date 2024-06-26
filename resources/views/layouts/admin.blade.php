<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ Vite::asset("resources/images/favicon.png") }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==' crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    {{-- Css per la mappa --}}
    <link rel="stylesheet" href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.18.0/maps/maps.css">
</head>

<body>
    <div id="app">

        <header class="navbar navbar-dark sticky-top flex-md-nowrap p-2 shadow" style="background-color: #FF5A5F">
            <div class="logo_laravel">
                <img style="width:150px;" src="{{ Vite::asset("resources/images/logo-white.png") }}" alt="">
            </div>
            <div class="navbar-nav ms-auto">
                <div class="nav-item text-nowrap ms-2">
                    <a class="nav-link btn dashboard-logout px-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <button class="navbar-toggler d-md-none collapsed ms-4 dashboard-collapsed-btn" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
        </header>

        <div class="container-fluid vh-100">
            <div class="row h-100">
                <nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block sidebar collapse dashboard-sidebar">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-black dashboard-link {{ Route::is('admin.dashboard') ? 'dashboard-actual-link' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-table-columns fa-lg me-2 primary-color"></i> Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-black dashboard-link {{ Route::is('admin.apartments.index') ? 'dashboard-actual-link' : '' }}" href="{{ route('admin.apartments.index') }}">
                                    <i class="fa-solid fa-house-user fa-lg me-2 primary-color"></i> Appartamenti
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-black dashboard-link {{ Route::is('admin.apartments.create') ? 'dashboard-actual-link' : '' }}" href="{{ route('admin.apartments.create') }}">
                                    <i class="fa-solid fa-house-medical fa-lg me-2 primary-color"></i> Nuovo affitto
                                </a>
                            </li>
                        </ul>


                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 pt-3">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

        <!-- Aggiungi il JavaScript per TomTom Maps -->
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.18.0/maps/maps-web.min.js"></script>
</body>

</html>