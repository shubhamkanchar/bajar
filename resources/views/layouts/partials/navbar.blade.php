<nav class="topbar navbar-light bg-white sticky-top">
    <div class="ps-md-5 ps-2" onclick="toggleMobileSidebar()">
        <img class="logo-img" src="{{ asset('assets/logo/logo.png') }}">
    </div>
    @if(str_contains(request()->path(), 'admin'))
    <div class="page-title">Admin Dashboard</div>
    @endif
    <div class="dropdown pe-md-5 pe-2">
        @guest
            <a href="{{ route('login') }}" class=" btn btn-dark rounded-5 me-1" href="">Sign In</a>
            <a href="{{ route('signup') }}" class="btn bg-secondary-subtle rounded-5" href="">Sign Up</a>
        @else
            @if (auth()->user()->profile_image)
                <img class="profile-img dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false" src="{{ asset('storage/' . auth()->user()->profile_image) }}">
            @else
                <img class="profile-img dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false" src="{{ asset('assets/image/profile.png') }}">
            @endif
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                @php 
                    $user = Auth::user();
                    if($user->role == 'superadmin' || $user->role == 'admin'){
                        $route = route('admin.dashboard');
                    }else if ($user->onboard_completed) {
                        if ($user->role == 'individual') {
                            $route = route('user.profile');
                        } else if ($user->role == 'business') {
                            if($user->offering == 'product'){
                                $route = route('business.profile');
                            }else{
                                $route = route('service.profile');
                            }
                        }
                    }else{
                        $route = route('onboarding');
                    }
                @endphp
                <li><a class="dropdown-item" href="{{$route}}">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        @endif
    </div>
</nav>