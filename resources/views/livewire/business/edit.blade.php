<div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 position-relative">
                @if ($bgImage)
                    <img class="w-100 h-250" src="{{ $bgImage->temporaryUrl() }}">
                @elseif(auth()->user()->bg_image)
                    <img class="w-100 h-250" src="{{ asset('storage/' . auth()->user()->bg_image) }}">
                @else
                    <img class="w-100 h-250" src="{{ asset('assets/bg/bg_profile.png') }}">
                @endif
                <input type="file" wire:model="bgImage" hidden id="bgImage">
                <label role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1"
                    wire:target="bgImage" for="bgImage">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="20" transform="matrix(-1 0 0 1 40 0)"
                            fill="#EDEDED" />
                        <path d="M21.75 28.4399H29.0026" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M20.78 11.7948C21.5557 10.8678 22.95 10.7319 23.8962 11.4917C23.9485 11.533 25.6295 12.8388 25.6295 12.8388C26.669 13.4672 26.992 14.8031 26.3494 15.8226C26.3153 15.8772 16.8119 27.7645 16.8119 27.7645C16.4958 28.1589 16.0158 28.3918 15.5029 28.3973L11.8635 28.443L11.0435 24.9723C10.9287 24.4843 11.0435 23.9718 11.3597 23.5773L20.78 11.7948Z"
                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M19.0234 14L24.4757 18.1871" stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </label>
                @php
                    $user = Auth::user();
                    if ($user->onboard_completed) {
                        if ($user->type == 'individual') {
                            $route = route('user.profile');
                        } elseif ($user->type == 'business') {
                            if($user->offering == 'product'){
                                $route = route('business.profile');
                            }else{
                                $route = route('service.profile');
                            }
                        } 
                    } else {
                        $route = route('onboarding');
                    }
                @endphp
                <a href="{{$route}}" role="button" class="position-absolute top-0 start-0 p-2 ps-4" style="z-index: 1">
                    <svg width="40" height="40" viewBox="0 0 50 50" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="-1" y="1" width="47" height="47" rx="24"
                            transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                        <path
                            d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                            fill="black" />
                    </svg>
                </a>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 mb-3 position-relative" style="margin-top:-70px">
                        @if ($profileImage)
                            <img class="w-100 ms-md-4 h-100" src="{{ $profileImage->temporaryUrl() }}">
                        @elseif(auth()->user()->profile_image)
                            <img class="w-100 ms-md-4 h-100"
                                src="{{ asset('storage/' . auth()->user()->profile_image) }}">
                        @else
                            <img class="w-100 ms-md-4 h-100" src="{{ asset('assets/image/profile.png') }}">
                        @endif
                        <input type="file" wire:model="profileImage" hidden id="profileImage">
                        <label for="profileImage" role="button" class="position-absolute top-0 end-0 p-2"
                            style="z-index: 1">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="40" height="40" rx="20" transform="matrix(-1 0 0 1 40 0)"
                                    fill="#EDEDED" />
                                <path d="M21.75 28.4399H29.0026" stroke="black" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M20.78 11.7948C21.5557 10.8678 22.95 10.7319 23.8962 11.4917C23.9485 11.533 25.6295 12.8388 25.6295 12.8388C26.669 13.4672 26.992 14.8031 26.3494 15.8226C26.3153 15.8772 16.8119 27.7645 16.8119 27.7645C16.4958 28.1589 16.0158 28.3918 15.5029 28.3973L11.8635 28.443L11.0435 24.9723C10.9287 24.4843 11.0435 23.9718 11.3597 23.5773L20.78 11.7948Z"
                                    stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M19.0234 14L24.4757 18.1871" stroke="black" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </label>
                    </div>
                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex align-items-center ms-md-2">
                            <span class="fw-bold fs-4 m-2">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="ms-md-3 mt-2 d-flex">
                            <span class="me-2">
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.5 8.50051C11.5 7.11924 10.3808 6 9.00051 6C7.61924 6 6.5 7.11924 6.5 8.50051C6.5 9.88076 7.61924 11 9.00051 11C10.3808 11 11.5 9.88076 11.5 8.50051Z"
                                        stroke="#808080" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.99951 19C7.80104 19 1.5 13.8984 1.5 8.56329C1.5 4.38664 4.8571 1 8.99951 1C13.1419 1 16.5 4.38664 16.5 8.56329C16.5 13.8984 10.198 19 8.99951 19Z"
                                        stroke="#808080" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span>
                                {{ auth()->user()->address->address }}, {{ auth()->user()->address->city }},
                                {{ auth()->user()->address->state }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex justify-content-end align-items-end float-md-end order-1"
                            style="height:100%">
                            {{-- <button class="btn btn-dark me-2">
                                <svg class="me-2" width="21" height="21" viewBox="0 0 21 21"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.3203 19.7912H19.8751" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.3125 2.45291C12.1205 1.48728 13.5729 1.34568 14.5586 2.13722C14.6131 2.18016 16.364 3.5404 16.364 3.5404C17.4469 4.19499 17.7833 5.58657 17.114 6.64853C17.0784 6.7054 7.17911 19.088 7.17911 19.088C6.84977 19.4989 6.34983 19.7414 5.81553 19.7472L2.02451 19.7948L1.17034 16.1795C1.05069 15.6711 1.17034 15.1373 1.49969 14.7264L11.3125 2.45291Z"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9.47656 4.75L15.156 9.11159" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Edit Profile
                            </button> --}}
                            {{-- </div>
                        <div class="d-lg-flex float-md-end order-2"> --}}
                            <button class="btn btn-dark">
                                <svg class="me-2" width="21" height="21" viewBox="0 0 21 21"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.3203 19.7912H19.8751" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.3125 2.45291C12.1205 1.48728 13.5729 1.34568 14.5586 2.13722C14.6131 2.18016 16.364 3.5404 16.364 3.5404C17.4469 4.19499 17.7833 5.58657 17.114 6.64853C17.0784 6.7054 7.17911 19.088 7.17911 19.088C6.84977 19.4989 6.34983 19.7414 5.81553 19.7472L2.02451 19.7948L1.17034 16.1795C1.05069 15.6711 1.17034 15.1373 1.49969 14.7264L11.3125 2.45291Z"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9.47656 4.75L15.156 9.11159" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Call
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <form>
                <div class="alert bg-custom-secondary fw-bold" role="alert">
                    Business Details
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" class="form-control" placeholder="Product Name" wire:model="name">
                            <label for="name">Business Name</label>
                        </div>
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" class="form-control" placeholder="Brand Name" wire:model="gst">
                            <label for="name">GST Number</label>
                        </div>
                        @error('gst')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" class="form-control" placeholder="Phone" wire:model="phone">
                            <label for="name">Phone Number</label>
                        </div>
                        @error('phone')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        @if ($phoneVerifiedAt)
                            <button class="btn bg-custom-secondary">Verified</button>
                        @else
                            <button type="button" wire:click="openVerifySlider('phone')"
                                class="btn btn-dark">Verify</button>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" class="form-control" placeholder="Brand Name" wire:model="email">
                            <label for="name">Email</label>
                        </div>
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        @if ($emailVerifiedAt)
                            <button class="btn bg-custom-secondary">Verified</button>
                        @else
                            <button type="button" wire:click="openVerifySlider('email')"
                                class="btn btn-dark">Verify</button>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">
                        Business Address
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" class="form-control" placeholder="Brand Name"
                                wire:model="address">
                            <label for="name">Business Address</label>
                        </div>
                        @error('address')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3 form-floating">
                            <select class="form-select" id="state" wire:model="state">
                                <option value="">Select State</option>
                                @foreach ($stateOptions as $stateOption)
                                    <option value="{{ $stateOption }}">{{ $stateOption }}</option>
                                @endforeach
                            </select>
                            <label for="state">State</label>
                            @error('state')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @error('state')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <!-- City Dropdown -->
                    <div class="col-12 col-md-6">
                        <div class="mb-3 form-floating">
                            <select class="form-select" id="city" wire:model="city" wire:click="setCity()">
                                <option value="">Select City</option>
                                @foreach ($cityOptions as $cityOption)
                                    <option value="{{ $cityOption }}">{{ $cityOption }}</option>
                                @endforeach
                            </select>
                            <label for="city">City</label>
                            @error('city')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" class="form-control" placeholder="Map" wire:model="map">
                            <label for="name">Google Map Link</label>
                        </div>
                        @error('map')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">
                        Business Offerings
                    </div>
                    <div class="col-lg-4 col-md-5 mb-2" >
                        <button  type="button"  class="row width-100 border border-2 rounded-2 p-3 me-1 align-items-center w-100">
                            <span class="col-2">
                                <svg width="22" height="18" viewBox="0 0 22 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.0235 8.05V16C20.0235 16.55 19.8277 17.0208 19.436 17.4125C19.0443 17.8042 18.5735 18 18.0235 18H4.0235C3.4735 18 3.00267 17.8042 2.611 17.4125C2.21933 17.0208 2.0235 16.55 2.0235 16V8.05C1.64017 7.7 1.34433 7.25 1.136 6.7C0.927668 6.15 0.923501 5.55 1.1235 4.9L2.1735 1.5C2.30683 1.06667 2.54433 0.708333 2.886 0.425C3.22767 0.141667 3.6235 0 4.0735 0H17.9735C18.4235 0 18.8152 0.1375 19.1485 0.4125C19.4818 0.6875 19.7235 1.05 19.8735 1.5L20.9235 4.9C21.1235 5.55 21.1193 6.14167 20.911 6.675C20.7027 7.20833 20.4068 7.66667 20.0235 8.05ZM13.2235 7C13.6735 7 14.0152 6.84583 14.2485 6.5375C14.4818 6.22917 14.5735 5.88333 14.5235 5.5L13.9735 2H12.0235V5.7C12.0235 6.05 12.1402 6.35417 12.3735 6.6125C12.6068 6.87083 12.8902 7 13.2235 7ZM8.7235 7C9.10684 7 9.41934 6.87083 9.661 6.6125C9.90267 6.35417 10.0235 6.05 10.0235 5.7V2H8.0735L7.5235 5.5C7.45683 5.9 7.54433 6.25 7.786 6.55C8.02767 6.85 8.34017 7 8.7235 7ZM4.2735 7C4.5735 7 4.836 6.89167 5.061 6.675C5.286 6.45833 5.4235 6.18333 5.4735 5.85L6.0235 2H4.0735L3.0735 5.35C2.9735 5.68333 3.02767 6.04167 3.236 6.425C3.44433 6.80833 3.79017 7 4.2735 7ZM17.7735 7C18.2568 7 18.6068 6.80833 18.8235 6.425C19.0402 6.04167 19.0902 5.68333 18.9735 5.35L17.9235 2H16.0235L16.5735 5.85C16.6235 6.18333 16.761 6.45833 16.986 6.675C17.211 6.89167 17.4735 7 17.7735 7ZM4.0235 16H18.0235V8.95C17.9402 8.98333 17.886 9 17.861 9H17.7735C17.3235 9 16.9277 8.925 16.586 8.775C16.2443 8.625 15.9068 8.38333 15.5735 8.05C15.2735 8.35 14.9318 8.58333 14.5485 8.75C14.1652 8.91667 13.7568 9 13.3235 9C12.8735 9 12.4527 8.91667 12.061 8.75C11.6693 8.58333 11.3235 8.35 11.0235 8.05C10.7402 8.35 10.411 8.58333 10.036 8.75C9.661 8.91667 9.25683 9 8.8235 9C8.34017 9 7.90267 8.91667 7.511 8.75C7.11934 8.58333 6.7735 8.35 6.4735 8.05C6.1235 8.4 5.77767 8.64583 5.436 8.7875C5.09433 8.92917 4.70683 9 4.2735 9H4.161C4.11933 9 4.0735 8.98333 4.0235 8.95V16Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <span class="col-8 text-start">
                                <span>I sell,</span><br>
                                <span class="fw-bold fs-6">Building Material</span>
                            </span>
                            <span class="float-end col-2">
                                @if ($offering == 'product')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_737_3347)">
                                            <circle cx="12" cy="12" r="12" fill="black" />
                                            <path
                                                d="M9.75049 14.0613L16.5811 7.23293C16.7363 7.07764 16.9337 7 17.1733 7C17.4131 7 17.6108 7.07746 17.7666 7.23237C17.9222 7.38729 18 7.5844 18 7.82369C18 8.06318 17.9222 8.26066 17.7666 8.41613L10.4622 15.6955C10.2588 15.8985 10.0216 16 9.75049 16C9.47943 16 9.2422 15.8985 9.0388 15.6955L6.23339 12.9065C6.0778 12.7515 6 12.5545 6 12.3154C6 12.0761 6.07761 11.8787 6.23282 11.7233C6.38804 11.568 6.58553 11.4903 6.82529 11.4903C7.06524 11.4903 7.2631 11.568 7.41888 11.7233L9.75049 14.0613Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_737_3347">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                @endif
                            </span>
                        </button>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <button type="button" class="row width-100 border border-2 rounded-2 p-3 ms-1 align-items-center w-100">
                            <span class="col-2">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.8 8.95348L8.95 6.77848L7.55 5.35348L7.15 5.75348C6.96667 5.93682 6.7375 6.03265 6.4625 6.04098C6.1875 6.04932 5.95 5.95348 5.75 5.75348C5.55 5.55348 5.45 5.31598 5.45 5.04098C5.45 4.76598 5.55 4.52848 5.75 4.32848L6.125 3.95348L5 2.82848L2.825 5.00348L6.8 8.95348ZM15 17.1785L17.175 15.0035L16.05 13.8785L15.65 14.2535C15.45 14.4535 15.2167 14.5535 14.95 14.5535C14.6833 14.5535 14.45 14.4535 14.25 14.2535C14.05 14.0535 13.95 13.8201 13.95 13.5535C13.95 13.2868 14.05 13.0535 14.25 12.8535L14.625 12.4535L13.2 11.0535L11.05 13.2035L15 17.1785ZM2 19.0035C1.71667 19.0035 1.47917 18.9076 1.2875 18.716C1.09583 18.5243 1 18.2868 1 18.0035V15.1785C1 15.0451 1.025 14.916 1.075 14.791C1.125 14.666 1.2 14.5535 1.3 14.4535L5.375 10.3785L1.05 6.05348C0.766667 5.77015 0.625 5.42015 0.625 5.00348C0.625 4.58682 0.766667 4.23682 1.05 3.95348L3.95 1.05348C4.23333 0.770149 4.58333 0.632649 5 0.640982C5.41667 0.649315 5.76667 0.795149 6.05 1.07848L10.4 5.40348L14.175 1.60348C14.375 1.40348 14.6 1.25348 14.85 1.15348C15.1 1.05348 15.3583 1.00348 15.625 1.00348C15.8917 1.00348 16.15 1.05348 16.4 1.15348C16.65 1.25348 16.875 1.40348 17.075 1.60348L18.4 2.95348C18.6 3.15348 18.75 3.37848 18.85 3.62848C18.95 3.87848 19 4.13682 19 4.40348C19 4.67015 18.95 4.92432 18.85 5.16598C18.75 5.40765 18.6 5.62848 18.4 5.82848L14.625 9.62848L18.95 13.9535C19.2333 14.2368 19.375 14.5868 19.375 15.0035C19.375 15.4201 19.2333 15.7701 18.95 16.0535L16.05 18.9535C15.7667 19.2368 15.4167 19.3785 15 19.3785C14.5833 19.3785 14.2333 19.2368 13.95 18.9535L9.625 14.6285L5.55 18.7035C5.45 18.8035 5.3375 18.8785 5.2125 18.9285C5.0875 18.9785 4.95833 19.0035 4.825 19.0035H2ZM3 17.0035H4.4L14.2 7.22848L12.775 5.80348L3 15.6035V17.0035ZM13.5 6.52848L12.775 5.80348L14.2 7.22848L13.5 6.52848Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <span class="col-8 text-start">
                                <span>I offer,</span><br>
                                <span class="fw-bold fs-6">Services</span>
                            </span>
                            <span class="col-2">
                                @if ($offering == 'service')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_737_3347)">
                                            <circle cx="12" cy="12" r="12" fill="black" />
                                            <path
                                                d="M9.75049 14.0613L16.5811 7.23293C16.7363 7.07764 16.9337 7 17.1733 7C17.4131 7 17.6108 7.07746 17.7666 7.23237C17.9222 7.38729 18 7.5844 18 7.82369C18 8.06318 17.9222 8.26066 17.7666 8.41613L10.4622 15.6955C10.2588 15.8985 10.0216 16 9.75049 16C9.47943 16 9.2422 15.8985 9.0388 15.6955L6.23339 12.9065C6.0778 12.7515 6 12.5545 6 12.3154C6 12.0761 6.07761 11.8787 6.23282 11.7233C6.38804 11.568 6.58553 11.4903 6.82529 11.4903C7.06524 11.4903 7.2631 11.568 7.41888 11.7233L9.75049 14.0613Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_737_3347">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                @endif
                            </span>
                        </button>
                    </div>
                    @if ($offering == 'service')
                        <div class="col-12">
                            <h4 class="fw-bold mt-3">Service i provide
                                ({{ str_pad(count($categoryIds), 2, '0', STR_PAD_LEFT) }}/03)</h4>
                            @foreach ($serviceCategories as $category)
                                @if (in_array($category->id, $categoryIds))
                                    <span role="button" wire:click="removeCategory({{ $category->id }})"
                                        class="badge rounded-pill text-dark border border-2 fs-6 p-3 m-1 border-dark bg-secondary-subtle">{{ $category->title }}</span>
                                @else
                                    <span role="button" wire:click="addCategory({{ $category->id }})"
                                        class="badge rounded-pill text-dark border border-2 fs-6 p-3 m-1">{{ $category->title }}</span>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if ($offering == 'product')
                        <div class="col-12">
                            <h4 class="fw-bold mt-3">Categories i deal in
                                ({{ str_pad(count($categoryIds), 2, '0', STR_PAD_LEFT) }}/03)</h4>
                            @foreach ($productCategories as $category)
                                @if (in_array($category->id, $categoryIds))
                                    <span role="button" wire:click="removeCategory({{ $category->id }})"
                                        class="badge rounded-pill text-dark border border-2 fs-6 p-3 m-1 border-dark bg-secondary-subtle">{{ $category->title }}</span>
                                @else
                                    <span role="button" wire:click="addCategory({{ $category->id }})"
                                        class="badge rounded-pill text-dark border border-2 fs-6 p-3 m-1">{{ $category->title }}</span>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">
                        Subscription Details
                    </div>
                    <div class="col-md-3">
                        <div class="border border-2 border-primary p-3 rounded-3 bg-primary bg-opacity-10">
                            <span class="d-block text-primary fw-bold">Premium</span>
                            <span>Valid Till : 24 Oct 2025</span>
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">View Plans</button>
                    </div>
                </div>
                <div class="row">
                    <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">
                        Business Hours
                    </div>
                    <div class="row">
                        <div class="col-md-1 d-flex align-items-center ms-3 fw-bold">Monday</div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 d-flex align-items-center ms-3 fw-bold">Tuesday</div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 d-flex align-items-center ms-3 fw-bold">Wednesday</div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 d-flex align-items-center ms-3 fw-bold">Thursday</div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 d-flex align-items-center ms-3 fw-bold">Friday</div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 d-flex align-items-center ms-3 fw-bold">Saturday</div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 d-flex align-items-center ms-3 fw-bold">Sunday</div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-2 mt-2">
                                <input type="time" class="form-control" placeholder="Brand Name">
                                <label for="name">Open From</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12 mt-4 mb-5">
                    <button type="button" class="btn btn-dark btn-lg" wire:click="update">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="slider-form {{ $sliderStatus }}">
        <div class="slider-content">
            <div class="row">
                <div class="col-12 text-end">
                    <a class="btn btn-default rounded-5 bg-custom-secondary" role="button"
                        wire:click="closeVerifySlider">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
                <div class="col-md-12 p-xl-5">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <img src="{{ asset('assets/logo/logo.png') }}">
                        </div>
                    </div>
                    <div class="row">
                        <h3 class="fw-bold">OTP Verification</h3>
                        <p>Enter OTP shared on </p>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                <input wire:model="one" class="m-md-2 me-1 text-center form-control rounded"
                                    type="password" id="first" maxlength="1" placeholder="-" />
                                <input wire:model="two" class="m-md-2 me-1 text-center form-control rounded"
                                    type="password" id="second" maxlength="1" placeholder="-" />
                                <input wire:model="three" class="m-md-2 me-1 text-center form-control rounded"
                                    type="password" id="third" maxlength="1" placeholder="-" />
                                <input wire:model="four" class="m-md-2 me-1 text-center form-control rounded"
                                    type="password" id="fourth" maxlength="1" placeholder="-" />
                                <input wire:model="five" class="m-md-2 me-1 text-center form-control rounded"
                                    type="password" id="fifth" maxlength="1" placeholder="-" />
                                <input wire:model="six" class="m-md-2 me-1 text-center form-control rounded"
                                    type="password" id="sixth" maxlength="1" placeholder="-" />
                            </div>

                            @error('one')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('two')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('three')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('four')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('five')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('six')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12 text-end mt-2">
                            Resend OTP in <span class="text-dark fw-bold">5 Sec</span>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-12 ">
                            <button type="button" class="btn btn-dark w-100" wire:click="verifyOtp">Verify</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('style')
    <style>
        /* Initially set the slider to be hidden off-screen on the right */
        .slider-form {
            position: fixed;
            top: 0;
            right: -100%;
            /* Hide off-screen initially */
            width: 100%;
            height: 100%;
            background-color: #f8f9fa;
            transition: right 0.3s ease;
            z-index: 1050;
            box-shadow: -4px 0px 8px rgba(0, 0, 0, 0.2);
        }

        /* Show the slider when active (slide in from the right) */
        .slider-form.open {
            right: 0;
        }

        /* Form content styling */
        .slider-content {
            padding: 30px;
        }

        /* Adjust the width of the form based on screen size */
        @media (max-width: 767px) {
            .slider-form {
                width: 100%;
                /* Full width on small screens */
            }
        }

        @media (min-width: 768px) {
            .slider-form {
                width: 40%;
                /* 75% width on medium and larger screens */
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        const openSliderBtn = document.getElementById("openSliderBtn");
        const sliderForm = document.querySelector(".slider-form");
        // const closeSliderBtn = document.getElementById("closeSliderBtn");

        openSliderBtn.addEventListener("click", function() {
            sliderForm.classList.toggle("open");
        });

        // closeSliderBtn.addEventListener("click", function() {
        //     sliderForm.classList.remove("open");
        // });

        function OTPInput() {
            const inputs = document.querySelectorAll('#otp > input');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('input', function() {
                    if (this.value.length > 1) {
                        this.value = this.value[0]; //    
                    }
                    if (this.value !== '' && i < inputs.length - 1) {
                        inputs[i + 1].focus(); //   
                    }
                });

                inputs[i].addEventListener('keydown', function(event) {
                    if (event.key === 'Backspace') {
                        this.value = '';
                        if (i > 0) {
                            inputs[i - 1].focus();
                        }
                    }
                });
            }
        }

        OTPInput();
    </script>
@endpush
