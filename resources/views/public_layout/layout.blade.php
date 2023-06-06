<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title> Mero Doctor </title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet" />
    <link href="/css/public.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="/css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="/">
                        <span>
                            मेरो डाक्टर
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                            </li>
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('loginForm') }}"> Login</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    Register
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('doctor.registerForm') }}">Doctor
                                    </a>
                                    <a class="dropdown-item" href="{{ route('patient.registerForm') }}">Patient
                                    </a>
                                </div>
                            </li>


                    </div>
                    @else
                    @if (Auth::user()->hasRole(1))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    @elseif(Auth::user()->hasRole(2))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('doctor.dashboard') }}">Dashboard</a>
                    </li>
                    @elseif(Auth::user()->hasRole(3))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.appointment') }}">New Appointment</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.show_appointment') }}">Appointments</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.all_doctors') }}">Doctors</a>

                    </li>

                    @endif

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a href="{{ route('patient.profile') }}" class="dropdown-item">
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
            </nav>
    </div>
    </header>
    <!-- end header section -->
    </div>
    <div class="col-3" style="position:fixed;bottom:10px; right:20px; z-index:999">
        <x-alertmsg />
    </div>
    @yield('content')

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 footer_col">
                    <div class="footer_contact">
                        <h4>
                            Reach at..
                        </h4>
                        <div class="contact_link_box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    Location
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    Call +01 1234567890
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    demo@gmail.com
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="footer_social">
                        <a href="">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 footer_col">
                    <div class="footer_detail">
                        <h4>
                            About
                        </h4>
                        <p>
                            Beatae provident nobis mollitia magnam voluptatum, unde dicta facilis minima veniam corporis
                            laudantium alias tenetur eveniet illum reprehenderit fugit a delectus officiis blanditiis
                            ea.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-1 mx-auto footer_col">
                    <div class="footer_link_box">
                        <h4>
                            Links
                        </h4>
                        <div class="footer_links">
                            <a class="active" href="/">
                                Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-info">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By
                    SAJAN KHADKA
                </p>

            </div>
        </div>
    </footer>
    <!-- footer section -->

    <!-- jQery -->
    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- custom js -->
    <script type="text/javascript" src="/js/custom.js"></script>


</body>

</html>