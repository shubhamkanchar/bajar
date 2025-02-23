<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <style>
        .text-bg-light {
            color: #000 !important;
            background-color: #E8E8E8 !important;
        }

        .bg-custom-secondary {
            background-color: #E8E8E8 !important;
        }


        .dashed-border {
            border: 3px dashed #858585;
            border-radius: 10px;
        }

        .ratio-add-product {
            --bs-aspect-ratio: 130%;
        }
    </style>
    @yield('style')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white sticky-top"
            style="background-color: rgba(255, 255, 255, 0.5) !important; ">
            <div class="container">
                <a class="navbar-brand opacity-100" href="{{ url('/') }}">
                    <img src="{{ asset('assets/logo/logo.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse opacity-100" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class=" btn btn-dark rounded-5 me-2" href="">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn bg-secondary-subtle rounded-5" href="">Sign Up</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
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

        <main>
            @yield('content')
        </main>

        <footer class="bg-secondary-subtle text-dark mt-5">
            <div class="container py-4">
                <div class="row text-center text-md-start">
                    <!-- Column 1 -->
                    <div class="col-md-3 mb-3">
                        <img src="http://bajar.test/assets/logo/logo.png">
                        <h5 class="mt-2">{{ env('APP_NAME') }}</h5>
                        <p>Find the Best Construction Materials and Trusted Professionals Locally</p>
                        <span>
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.3416 1.375H7.65801C4.188 1.375 1.375 4.188 1.375 7.65801V22.3416C1.375 25.8116 4.188 28.6246 7.65801 28.6246H22.3416C25.8116 28.6246 28.6246 25.8116 28.6246 22.3416V7.65801C28.6246 4.188 25.8116 1.375 22.3416 1.375Z"
                                    fill="url(#paint0_linear_199_8306)" />
                                <path
                                    d="M19.3941 6.75449C20.4286 6.75866 21.4195 7.17144 22.151 7.90292C22.8825 8.6344 23.2952 9.62531 23.2994 10.6598V19.3469C23.2952 20.3813 22.8825 21.3722 22.151 22.1037C21.4195 22.8352 20.4286 23.248 19.3941 23.2521H10.6051C9.57062 23.248 8.57971 22.8352 7.84823 22.1037C7.11676 21.3722 6.70397 20.3813 6.6998 19.3469V10.6598C6.70397 9.62531 7.11676 8.6344 7.84823 7.90292C8.57971 7.17144 9.57062 6.75866 10.6051 6.75449H19.3941ZM19.3941 4.93809H10.6051C7.45801 4.93809 4.88281 7.51621 4.88281 10.6604V19.3469C4.88281 22.4939 7.46094 25.0691 10.6051 25.0691H19.3941C22.5412 25.0691 25.1164 22.491 25.1164 19.3469V10.6598C25.1164 7.5127 22.5412 4.9375 19.3941 4.9375V4.93809Z"
                                    fill="white" />
                                <path
                                    d="M14.9963 11.6055C15.6669 11.6055 16.3225 11.8043 16.8801 12.1769C17.4377 12.5495 17.8724 13.0791 18.129 13.6987C18.3856 14.3183 18.4528 15.0001 18.322 15.6578C18.1911 16.3156 17.8682 16.9197 17.394 17.394C16.9197 17.8682 16.3156 18.1911 15.6578 18.322C15.0001 18.4528 14.3183 18.3856 13.6987 18.129C13.0791 17.8724 12.5495 17.4377 12.1769 16.8801C11.8043 16.3225 11.6055 15.6669 11.6055 14.9963C11.6066 14.0973 11.9642 13.2355 12.5998 12.5998C13.2355 11.9641 14.0973 11.6066 14.9963 11.6055ZM14.9963 9.78906C13.9664 9.78906 12.9596 10.0945 12.1033 10.6666C11.247 11.2388 10.5796 12.0521 10.1854 13.0036C9.79132 13.9551 9.6882 15.0021 9.88912 16.0122C10.09 17.0223 10.586 17.9501 11.3142 18.6784C12.0425 19.4066 12.9703 19.9025 13.9804 20.1035C14.9905 20.3044 16.0375 20.2013 16.989 19.8071C17.9405 19.413 18.7538 18.7456 19.3259 17.8893C19.8981 17.0329 20.2035 16.0262 20.2035 14.9963C20.2035 13.6152 19.6549 12.2908 18.6784 11.3142C17.7018 10.3377 16.3773 9.78906 14.9963 9.78906Z"
                                    fill="white" />
                                <path
                                    d="M20.3205 10.7973C21.0023 10.7973 21.5551 10.2445 21.5551 9.56269C21.5551 8.88086 21.0023 8.32812 20.3205 8.32812C19.6387 8.32812 19.0859 8.88086 19.0859 9.56269C19.0859 10.2445 19.6387 10.7973 20.3205 10.7973Z"
                                    fill="white" />
                                <defs>
                                    <linearGradient id="paint0_linear_199_8306" x1="19.2344" y1="29.7684"
                                        x2="10.7652" y2="0.231249" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFDB73" />
                                        <stop offset="0.08" stop-color="#FDAD4E" />
                                        <stop offset="0.15" stop-color="#FB832E" />
                                        <stop offset="0.19" stop-color="#FA7321" />
                                        <stop offset="0.23" stop-color="#F6692F" />
                                        <stop offset="0.37" stop-color="#E84A5A" />
                                        <stop offset="0.48" stop-color="#E03675" />
                                        <stop offset="0.55" stop-color="#DD2F7F" />
                                        <stop offset="0.68" stop-color="#B43D97" />
                                        <stop offset="0.97" stop-color="#4D60D4" />
                                        <stop offset="1" stop-color="#4264DB" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                        <span>

                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M30 15C30 22.4871 24.5145 28.6928 17.3438 29.8178V19.3359H20.8389L21.5039 15H17.3438V12.1863C17.3438 10.9998 17.925 9.84375 19.7883 9.84375H21.6797V6.15234C21.6797 6.15234 19.9629 5.85938 18.3217 5.85938C14.8957 5.85938 12.6562 7.93594 12.6562 11.6953V15H8.84766V19.3359H12.6562V29.8178C5.48555 28.6928 0 22.4871 0 15C0 6.71602 6.71602 0 15 0C23.284 0 30 6.71602 30 15Z"
                                    fill="#1877F2" />
                                <path
                                    d="M20.835 19.3359L21.5 15H17.3398V12.1863C17.3398 11 17.921 9.84375 19.7843 9.84375H21.6758V6.15234C21.6758 6.15234 19.9592 5.85938 18.3181 5.85938C14.8917 5.85938 12.6523 7.93594 12.6523 11.6953V15H8.84375V19.3359H12.6523V29.8177C13.4161 29.9375 14.1988 30 14.9961 30C15.7934 30 16.5761 29.9375 17.3398 29.8177V19.3359H20.835Z"
                                    fill="white" />
                            </svg>

                        </span>
                        <span>

                            <svg width="30" height="22" viewBox="0 0 30 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.7694 0.382812H6.23062C2.78954 0.382812 0 3.17235 0 6.61343V15.381C0 18.822 2.78954 21.6116 6.23062 21.6116H23.7694C27.2105 21.6116 30 18.822 30 15.381V6.61343C30 3.17235 27.2105 0.382812 23.7694 0.382812ZM19.5557 11.4238L11.3522 15.3363C11.1336 15.4406 10.8811 15.2812 10.8811 15.0391V6.96939C10.8811 6.7238 11.1403 6.56462 11.3593 6.67564L19.5628 10.8327C19.8067 10.9563 19.8024 11.3061 19.5557 11.4238Z"
                                    fill="#F61C0D" />
                            </svg>

                        </span>
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-3 mb-3">
                        {{-- <h5>Quick Links</h5> --}}
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-dark fw-bold text-decoration-none">Pricing</a></li>
                            <li><a href="#" class="text-dark fw-bold text-decoration-none">Blogs</a></li>
                            {{-- <li><a href="#" class="text-light text-decoration-none">About</a></li>
                            <li><a href="#" class="text-light text-decoration-none">Contact</a></li> --}}
                        </ul>
                    </div>

                    <div class="col-md-3 mb-3">
                        {{-- <h5>Quick Links</h5> --}}
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-dark fw-bold text-decoration-none">Terms and
                                    Conditions</a></li>
                            <li><a href="#" class="text-dark fw-bold text-decoration-none">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 mb-3">
                        {{-- <h5>Quick Links</h5> --}}
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-dark fw-bold text-decoration-none">Contact</a></li>
                            <li><a href="#" class="text-secondary text-decoration-none">Support Email ID</a>
                            </li>
                            <li><a href="#" class="text-secondary text-decoration-none">Support Phone Number</a>
                            </li>
                            <li class="mt-4"><a href="#" class="text-secondary text-decoration-none">@
                                    {{ env('APP_NAME') }}</a></li>
                        </ul>
                    </div>

                    <!-- Column 3 -->
                    {{-- <div class="col-md-3 mb-3">
                        <h5>Follow Us</h5>
                        <a href="#" class="text-dark me-3"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="text-dark me-3"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="text-dark me-3"><i class="fa fa-instagram"></i></a>
                        <a href="#" class="text-dark"><i class="fa fa-linkedin"></i></a>
                    </div> --}}
                </div>
            </div>

            <!-- Copyright -->
            {{-- <div class="text-center py-3 bg-secondary">
                &copy; 2024 Your Company | All Rights Reserved
            </div> --}}
        </footer>
    </div>
    @livewireScripts
</body>

</html>
