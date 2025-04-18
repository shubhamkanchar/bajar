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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.css"
        integrity="sha512-UiKdzM5DL+I+2YFxK+7TDedVyVm7HMp/bN85NeWMJNYortoll+Nd6PU9ZDrZiaOsdarOyk9egQm6LOJZi36L2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <style>
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
        .h-250{
            height: 250px !important;
        }
        .logo-img{
            width: 35px;
        }
        .content {
            flex-grow: 1;
            padding-top: 60px;
        }
    </style>
    @stack('style')
    @yield('style')
</head>

<body>
    <div id="app">
        @include('layouts.partials.navbar')
        <main class="content">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    @stack('scripts')
    @yield('scripts')
    @include('layouts.partials.notify')
</body>

</html>
