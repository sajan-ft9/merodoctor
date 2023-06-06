<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="btn sdebarToggle" href="#" onclick="toggleSidebar()"><i
                        class="bi bi-list fs-3 text-white"></i></a>
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    मेरो डाक्टर
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a href=" route('admin.profile')" class="dropdown-item">
                                    Profile
                                </a>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
        <div id="sidebar">
            <div>
                <div class="text-center">
                    <img src="{{ asset('images/client.jpg') }}" alt="">
                </div>
                <div class="side-item py-2">
                    <a href="/">Home</a>
                </div>
                <div class="side-item py-2">
                    <a href="">Appointment Requests</a>
                </div>
                <div class="side-item py-2">
                    <a href="">Profile</a>
                </div>
                <div class="side-item py-2">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger">Logout</button>
                    </form>
                    
                </div>

            </div>
        </div>
        <main class="py-4">
            <div class="col-3" style="position:fixed;bottom:10px; right:20px; z-index:999">
                <x-alertmsg />
            </div>

            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

</body>
<script>
    function toggleSidebar(){

        const x = document.getElementById('sidebar');    
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
    }
</script>

</html>