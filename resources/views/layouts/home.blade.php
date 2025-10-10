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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css" integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('style')

    <style>
        body {
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Top Navbar */
        .topbar {
            width: 100%;
            height: 60px;
            /*background-color: #212529;*/
            color: black;
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* padding: 0 50px; */
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .topbar .brand-logo {
            height: 40px;
        }

        .topbar .page-title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            flex-grow: 1;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .content {
            flex-grow: 1;
            padding-top: 60px;
        }

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

        @media (max-width: 767.98px) {
            .h-250 {
                height: 130px !important;
            }
        }

        @media (min-width: 768px) {
            .h-250 {
                height: 250px !important;
            }
        }

        .logo-img {
            width: 35px;
        }

        @media (min-width: 767px) {
            .border-bottom-only-mobile {
                border-bottom: none !important;
            }
        }
        .text-description {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Number of lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .text-title {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* Number of lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .square-img-profile {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            object-position: center;
            display: block;
            border-radius: 15px;
        }
        .img-fluid{
            max-width: 100% !important;
            max-height: 100% !important
        }
    </style>
    @livewireStyles
</head>

<body>
    <div id="app">
        @include('layouts.partials.navbar')
        <main class="content">
            @yield('content')
        </main>
        @include('layouts.partials.footer')
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
        integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js" integrity="sha256-A+2opyqhvbBV8tbd9mIM8w9zvvMYHOawY03BQRtq7Kw=" crossorigin="anonymous"></script>
    @stack('scripts')
    @include('layouts.partials.notify')
    <script>
        if (document.querySelectorAll('.splide').length > 0) {
            const splide = new Splide('.splide', {
                type: 'loop',
                drag: 'free',
                focus: 'center',
                perPage: 3,
                breakpoints: {
                    768: {
                        perPage: 1,
                    },
                },
                autoScroll: {
                    speed: 0.7,
                },
            }).mount(window.splide.Extensions);
        }
    </script>
    <script>
        Livewire.hook("request", ({
            fail
        }) => {
            fail(async ({
                status,
                preventDefault,
                retry
            }) => {
                if (status === 419) {
                    preventDefault();

                    const response = await fetch("/refresh-csrf", {
                        method: "GET",
                        headers: {
                            "Accept": "application/json",
                        },
                        credentials: "same-origin",
                    });

                    const data = await response.json();
                    const token = data.token;

                    document.querySelector('meta[name="csrf-token"]').setAttribute("content", token);

                    Livewire.csrfToken = token;
                    retry();
                }
            });
        });
    </script>
</body>

</html>
