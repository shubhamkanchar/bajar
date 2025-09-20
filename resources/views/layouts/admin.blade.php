<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    @stack('style')
    @yield('style')
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

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 90vh;
            background-color: white;
            color: black;
            padding-top: 1rem;
            padding-left: 45px;
            position: fixed;
            left: 0;
            top: 60px;
            transition: all 0.3s ease-in-out;
            z-index: 1050;
            overflow-x: unset;
            overflow-y: scroll
        }

        .sidebar a {
            color: black;
            text-decoration: none;
            padding: 10px 15px;
            margin: 5px;
            display: flex;
            align-items: center;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar i {
            margin-right: 10px;
        }

        /* Close Button (Hidden on Desktop) */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: black;
            display: none;
            /* Hidden on desktop */
        }

        /* Main Content */
        .content {
            flex-grow: 1;
            padding-top: 60px;
            margin-left: 250px;
            transition: margin-left 0.3s;
        }

        /* Mobile Sidebar */
        .mobile-toggle {
            display: none;
            background-color: #343a40;
            color: white;
            padding: 10px;
            text-align: right;
            cursor: pointer;
            width: 100%;
            position: fixed;
            top: 60px;
            z-index: 3;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
                /* Hide sidebar on mobile */
            }

            .sidebar.show {
                left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .content {
                margin-left: 0;
            }

            /* Show Close Button Only on Mobile */
            .close-btn {
                display: block;
            }
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


        .bg-custom-secondary {
            background: #CCCCCC;
        }

        .logo-img {
            width: 35px;
        }

        .dashed-border {
            border: 3px dashed #858585;
            border-radius: 10px;
        }

        .ratio-add-product {
            --bs-aspect-ratio: 130%;
        }

        .h-250 {
            height: 250px !important;
        }

        .logo-img {
            width: 35px;
        }

        .text-description {
            display: -webkit-box !important;
            -webkit-line-clamp: 2;
            /* Number of lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .text-title {
            display: -webkit-box !important;
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
</head>

<body>
    <div id="app">
        @include('layouts.partials.navbar')
        <div id="sidebar" class="sidebar border pe-2 mb-5">
            <span class="close-btn" onclick="closeSidebar()">&times;</span>
            <div class="fs-6 ps-1 fw-bold">
                <svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.9974 18.3307C5.3974 18.3307 1.66406 14.6057 1.66406 9.9974C1.66406 5.3974 5.3974 1.66406 9.9974 1.66406C14.6057 1.66406 18.3307 5.3974 18.3307 9.9974C18.3307 14.6057 14.6057 18.3307 9.9974 18.3307ZM12.6557 13.0891C12.7557 13.1474 12.8641 13.1807 12.9807 13.1807C13.1891 13.1807 13.3974 13.0724 13.5141 12.8724C13.6891 12.5807 13.5974 12.1974 13.2974 12.0141L10.3307 10.2474V6.3974C10.3307 6.0474 10.0474 5.7724 9.70573 5.7724C9.36406 5.7724 9.08073 6.0474 9.08073 6.3974V10.6057C9.08073 10.8224 9.1974 11.0224 9.38906 11.1391L12.6557 13.0891Z"
                        fill="black" />
                </svg>
                Pending Approvals
            </div>
            <a class="btn {{ request('tab') == 'product-review' || request('tab') == null ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'product-review') }}">
                Product Review
            </a>
            <a class="btn {{ request('tab') == 'service-review' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'service-review') }}">Service Review</a>

            <div class="fs-5 fw-bold mt-4">Approved List</div>
            <a class="btn {{ request('tab') == 'approved-product' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'approved-product') }}"> Approved Product</a>
            <a class="btn {{ request('tab') == 'approved-service' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'approved-service') }}">Approved Service</a>

            <div class="fs-5 fw-bold mt-4">Users</div>
            <a class="btn {{ request('tab') == 'product-sellers' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'product-sellers') }}">Product Sellers</a>
            <a class="btn {{ request('tab') == 'service-providers' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'service-providers') }}">Service Providers</a>
            <a class="btn {{ request('tab') == 'individuals' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'individuals') }}">Individuals</a>

            <div class="fs-5 fw-bold mt-4">Content Management</div>
            <a class="btn {{ request('tab') == 'ads' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'ads') }}">Ads</a>
            <a class="btn {{ request('tab') == 'blogs' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'blogs') }}">Blogs</a>
            <a class="btn {{ request('tab') == 'tc' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'tc') }}">Terms and policies</a>

            <div class="fs-5 fw-bold mt-4">Settings</div>
            <a class="btn {{ request('tab') == 'setting' ? 'btn-dark text-white' : 'bg-secondary-subtle text-secondary' }} rounded-3"
                href="{{ route('admin.dashboard', 'setting') }}">Settings</a>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
    @livewireScripts
    @livewireScriptConfig
    @stack('scripts')
    @yield('scripts')
    @include('layouts.partials.notify')
    <script>
        function toggleMobileSidebar() {
            document.getElementById("sidebar").classList.toggle("show");
        }

        function closeSidebar() {
            document.getElementById("sidebar").classList.remove("show");
        }
    </script>
</body>

</html>
