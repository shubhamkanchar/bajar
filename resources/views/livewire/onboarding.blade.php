<div class="{{ $deviceWidth < 768 ? '' : 'card rounded-4 shadow' }}">

    <div class="row p-4">
        <div class="offset-xl-2 offset-lg-1 col-xl-5 col-lg-7 col-md-6 col-sm-12 p-4">
            @if ($step === 1)
                <div class="row">
                    <div class="col-6 col-md-8">
                        <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 col-md-4 text-end">
                        <div class="d-flex justify-content-end align-items-center mb-2">
                            @for ($i = 1; $i <= $totalSteps; $i++)
                                <div class="ms-2" style="height: 8px; width: 32px; border-radius: 4px; background-color: {{ $step >= $i ? '#000' : '#dee2e6' }};"></div>
                            @endfor
                        </div>
                    
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <span class="text-muted">
                                Step <strong>{{ str_pad($step, 2, '0', STR_PAD_LEFT) }} of 0{{$totalSteps}}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted fst-italic mb-2">Welcome to Bajar Bhaw!</h6>
                <h6 class="text-muted fst-italic mb-5">"Let's get to know you better."</h6>
                <div class="mb-4">
                    <h3 class="fw-bold">
                        <span class="{{ $userType ? 'text-muted' : '' }}">I am</span>
                        <span
                            class="{{ $userType ? '' : 'text-muted' }}">{{ $userType ? ucfirst($userType) : 'Individual / Business' }}</span>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 col-6 mb-3 position-relative">
                        <button
                            class="border rounded-4 position-relative text-center {{ $userType === 'individual' ? 'border-dark' : '' }} w-100 w-md-auto h-180"
                            wire:click="selectUserType('individual')">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M30 29.2344C27.5938 29.2344 25.534 28.3777 23.8206 26.6644C22.1069 24.9506 21.25 22.8906 21.25 20.4844C21.25 18.0781 22.1069 16.0183 23.8206 14.305C25.534 12.5913 27.5938 11.7344 30 11.7344C32.4062 11.7344 34.466 12.5913 36.1794 14.305C37.8931 16.0183 38.75 18.0781 38.75 20.4844C38.75 22.8906 37.8931 24.9506 36.1794 26.6644C34.466 28.3777 32.4062 29.2344 30 29.2344ZM11.25 44.475V42.715C11.25 41.4908 11.5825 40.3571 12.2475 39.3137C12.9125 38.2704 13.8012 37.4683 14.9137 36.9075C17.3846 35.6962 19.8773 34.7877 22.3919 34.1819C24.9065 33.576 27.4425 33.2731 30 33.2731C32.5575 33.2731 35.0935 33.576 37.6081 34.1819C40.1227 34.7877 42.6154 35.6962 45.0863 36.9075C46.1987 37.4683 47.0875 38.2704 47.7525 39.3137C48.4175 40.3571 48.75 41.4908 48.75 42.715V44.475C48.75 45.5292 48.3806 46.4258 47.6419 47.165C46.9031 47.9038 46.0065 48.2731 44.9519 48.2731H15.0481C13.9935 48.2731 13.0969 47.9038 12.3581 47.165C11.6194 46.4258 11.25 45.5292 11.25 44.475ZM15 44.5231H45V42.715C45 42.2087 44.8533 41.74 44.56 41.3088C44.2667 40.8779 43.8685 40.5262 43.3656 40.2537C41.2115 39.1929 39.0152 38.3892 36.7769 37.8425C34.5381 37.2963 32.2792 37.0231 30 37.0231C27.7208 37.0231 25.4619 37.2963 23.2231 37.8425C20.9848 38.3892 18.7885 39.1929 16.6344 40.2537C16.1315 40.5262 15.7333 40.8779 15.44 41.3088C15.1467 41.74 15 42.2087 15 42.715V44.5231ZM30 25.4844C31.375 25.4844 32.5521 24.9948 33.5312 24.0156C34.5104 23.0365 35 21.8594 35 20.4844C35 19.1094 34.5104 17.9323 33.5312 16.9531C32.5521 15.974 31.375 15.4844 30 15.4844C28.625 15.4844 27.4479 15.974 26.4688 16.9531C25.4896 17.9323 25 19.1094 25 20.4844C25 21.8594 25.4896 23.0365 26.4688 24.0156C27.4479 24.9948 28.625 25.4844 30 25.4844Z"
                                    fill="black" />
                            </svg>
                            <h6 class="fw-bold">
                                Individual
                            </h6>
                            @if($userType === 'individual')
                            <svg class="position-absolute top-0 end-0 m-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                        </button>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 col-6 mb-3">
                        <button
                            class="border rounded-4 h-180 position-relative text-center {{ $userType === 'business' ? 'border-dark' : '' }} w-100 w-md-auto"
                            wire:click="selectUserType('business')">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.4024 10.625H47.5949C48.1262 10.625 48.5714 10.8048 48.9305 11.1644C49.2901 11.524 49.4699 11.9694 49.4699 12.5006C49.4699 13.0323 49.2901 13.4775 48.9305 13.8363C48.5714 14.1954 48.1262 14.375 47.5949 14.375H12.4024C11.8712 14.375 11.426 14.1952 11.0668 13.8356C10.7072 13.476 10.5274 13.0306 10.5274 12.4994C10.5274 11.9677 10.7072 11.5225 11.0668 11.1637C11.426 10.8046 11.8712 10.625 12.4024 10.625ZM12.8831 49.375C12.2431 49.375 11.7064 49.1585 11.2731 48.7256C10.8401 48.2923 10.6237 47.7556 10.6237 47.1156V34.375H9.84993C9.13826 34.375 8.55243 34.0969 8.09243 33.5406C7.63243 32.9848 7.48576 32.351 7.65243 31.6394L10.1524 19.9087C10.2666 19.3883 10.5324 18.961 10.9499 18.6269C11.3674 18.2923 11.842 18.125 12.3737 18.125H47.6237C48.1553 18.125 48.6299 18.2923 49.0474 18.6269C49.4649 18.961 49.7308 19.3883 49.8449 19.9087L52.3449 31.6394C52.5116 32.351 52.3649 32.9848 51.9049 33.5406C51.4449 34.0969 50.8591 34.375 50.1474 34.375H49.3737V47.5C49.3737 48.0312 49.1939 48.4765 48.8343 48.8356C48.4747 49.1952 48.0293 49.375 47.4981 49.375C46.9664 49.375 46.5212 49.1952 46.1624 48.8356C45.8033 48.4765 45.6237 48.0312 45.6237 47.5V34.375H34.3737V47.1156C34.3737 47.7556 34.1572 48.2923 33.7243 48.7256C33.291 49.1585 32.7543 49.375 32.1143 49.375H12.8831ZM14.3737 45.625H30.6237V34.375H14.3737V45.625ZM11.6618 30.625H48.3356L46.4268 21.875H13.5706L11.6618 30.625Z"
                                    fill="black" />
                            </svg>
                            <h6 class="fw-bold ">
                                Business
                            </h6>
                            @if($userType === 'business')
                            <svg class="position-absolute top-0 end-0 m-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                        </button>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="{{ route('home') }}" class="btn btn-defualt">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>
                    </a>
                    <button class="btn btn-dark btn-sm px-5 py-3 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Next
                    </button>
                </div>
            @elseif($step == 2 && $userType === 'individual')
                <div class="row">
                    <div class="col-6 col-md-8">
                        <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 col-md-4 text-end">
                        <div class="d-flex justify-content-end align-items-center mb-2">
                            @for ($i = 1; $i <= $totalSteps; $i++)
                                <div class="ms-2" style="height: 8px; width: 32px; border-radius: 4px; background-color: {{ $step >= $i ? '#000' : '#dee2e6' }};"></div>
                            @endfor
                        </div>
                    
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <span class="text-muted">
                                Step <strong>{{ str_pad($step, 2, '0', STR_PAD_LEFT) }} of 0{{$totalSteps}}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted fst-italic mb-3">"Great! Just a few details to tailor your experience."</h6>
                <h5 class="fw-bold mb-4">Personal Details</h5>
                <div class="mb-3 form-floating">
                    <input type="text" id="name" class="form-control" wire:model="name"
                        placeholder="Please enter your name">
                    <label for="name">Name</label>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row mb-5">
                    <!-- Phone Number -->
                    <div class="col-12 col-md-6">
                        <div class="mb-3 form-floating">
                            <input maxlength="10" type="number" id="phone" class="form-control" wire:model="phone"
                                placeholder="Please enter your phone number">
                            <label for="phone">Phone Number*</label>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="col-12 col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="email" id="email" class="form-control" wire:model="email"
                                placeholder="Please enter your email">
                            <label for="email">Email ID*</label>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mb-4">Address</h5>

                <div class="row">
                    <!-- State Dropdown -->
                    <div class="col-12 col-md-6">
                        <div class="mb-3 form-floating">
                            <select class="form-select" id="state" wire:model="state" wire:click="setState">
                                <option value="">Select State</option>
                                @foreach ($stateOptions as $stateOption)
                                    <option @if ($stateOption == $state) selected @endif
                                        value="{{ $stateOption }}">{{ $stateOption }}</option>
                                @endforeach
                            </select>
                            <label for="state">State</label>
                            @error('state')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- City Dropdown -->
                    <div class="col-12 col-md-6">
                        <div class="mb-3 form-floating">
                            <select class="form-select" id="city" wire:model="city" wire:click="setCity">
                                <option value="">Select City</option>
                                @foreach ($cityOptions as $cityOption)
                                    <option @if ($cityOption == $city) selected @endif
                                        value="{{ $cityOption }}">{{ $cityOption }}</option>
                                @endforeach
                            </select>
                            <label for="city">City</label>
                            @error('city')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 py-3 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Next
                    </button>
                </div>
            @elseif($step == 3 && $userType === 'individual')
                <div class="row">
                    <div class="col-6 col-md-8">
                        <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 col-md-4 text-end">
                        <div class="d-flex justify-content-end align-items-center mb-2">
                            @for ($i = 1; $i <= $totalSteps; $i++)
                                <div class="ms-2" style="height: 8px; width: 32px; border-radius: 4px; background-color: {{ $step >= $i ? '#000' : '#dee2e6' }};"></div>
                            @endfor
                        </div>
                    
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <span class="text-muted">
                                Step <strong>{{ str_pad($step, 2, '0', STR_PAD_LEFT) }} of 0{{$totalSteps}}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-4 offset-lg-3 col-lg-6 col-12 col-md-4 text-center">
                        <img class="mb-5 w-100" src="{{ asset('assets/image/final.png') }}">
                    </div>
                </div>
                <!-- Navigation Buttons -->
                <div class="mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button type="button" class="btn btn-dark btn-sm px-5 py-3 rounded-5" wire:click="finalize">
                        Done
                    </button>
                </div>
            @elseif($step == 2 && $userType === 'business')
                <div class="row">
                    <div class="col-6 col-md-8">
                        <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 col-md-4 text-end">
                        <div class="d-flex justify-content-end align-items-center mb-2">
                            @for ($i = 1; $i <= $totalSteps; $i++)
                                <div class="ms-2" style="height: 8px; width: 32px; border-radius: 4px; background-color: {{ $step >= $i ? '#000' : '#dee2e6' }};"></div>
                            @endfor
                        </div>
                    
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <span class="text-muted">
                                Step <strong>{{ str_pad($step, 2, '0', STR_PAD_LEFT) }} of 0{{$totalSteps}}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted fst-italic mb-3">"Awesome! Share some quick info to get started."</h6>
                <h5 class="fw-bold mb-4">Business Details</h5>
                <div class="row">
                    <!-- Business Name -->
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="form-floating">
                            <input type="text" id="business_name" class="form-control" wire:model="name"
                                placeholder="Please enter your business name">
                            <label for="business_name">Business Name *</label>
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- GST Number -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" id="gst_number" class="form-control" wire:model="gst_number"
                                placeholder="Please enter your GST number">
                            <label for="gst_number">GST Number</label>
                        </div>
                        @error('gst_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Phone Number -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-floating">
                            <input maxlength="10" type="text" id="phone" class="form-control"
                                wire:model="phone" placeholder="Please enter your phone number">
                            <label for="phone">Phone Number *</label>
                        </div>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="email" id="email" class="form-control" wire:model="email"
                                placeholder="Please enter your email">
                            <label for="email">Email ID *</label>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h5 class="fw-bold mb-4">Business Address</h5>

                <div class="row">
                    <!-- Business Address -->
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <input type="text" id="business_address" class="form-control" wire:model="address"
                                placeholder="Please enter your business address">
                            <label for="business_address">Business Address</label>
                        </div>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State Dropdown -->
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="form-floating">
                            <select class="form-select" id="state" wire:model="state" wire:click="setState">
                                <option value="">Select State</option>
                                @foreach ($stateOptions as $stateOption)
                                    <option @if ($stateOption == $state) selected @endif
                                        value="{{ $stateOption }}">{{ $stateOption }}</option>
                                @endforeach
                            </select>
                            <label for="state">State</label>
                        </div>
                        @error('state')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City Dropdown -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-floating">
                            <select class="form-select" id="city" wire:model="city" wire:click="setCity">
                                <option value="">Select City</option>
                                @foreach ($cityOptions as $cityOption)
                                    <option @if ($cityOption == $city) selected @endif
                                        value="{{ $cityOption }}">{{ $cityOption }}</option>
                                @endforeach
                            </select>
                            <label for="city">City</label>
                        </div>
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Google Map Link -->
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" id="google_map_link" class="form-control" wire:model="google_map_link"
                            placeholder="Please enter your Google Map link">
                        <label for="google_map_link">Google Map Link</label>
                    </div>
                    @error('google_map_link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 py-3 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Next
                    </button>
                </div>
            @elseif($step == 3 && $userType === 'business')
                <div class="row">
                    <div class="col-6 col-md-8">
                        <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 col-md-4 text-end">
                        <div class="d-flex justify-content-end align-items-center mb-2">
                            @for ($i = 1; $i <= $totalSteps; $i++)
                                <div class="ms-2" style="height: 8px; width: 32px; border-radius: 4px; background-color: {{ $step >= $i ? '#000' : '#dee2e6' }};"></div>
                            @endfor
                        </div>
                    
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <span class="text-muted">
                                Step <strong>{{ str_pad($step, 2, '0', STR_PAD_LEFT) }} of 0{{$totalSteps}}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted fst-italic mb-3">"Great! Share some more about your business"</h6>
                <h5 class="fw-bold mb-4">Business Offerings</h5>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-2" wire:click="setOffering('product')">
                        <button class="border border-2 rounded-2 p-3 w-100">
                            <div class="row align-items-center">
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
                            </div>
                        </button>
                    </div>
                    <div class="col-lg-6 col-md-12" wire:click="setOffering('service')">
                        <button class="border border-2 rounded-2 p-3 align-items-center w-100">
                            <div class="row align-items-center">
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
                            </div>
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
                <!-- Navigation Buttons -->
                <div class="mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 py-3 rounded-5" wire:click="nextStep"
                        {{ $offering && count($categoryIds) > 0 ? '' : 'disabled' }}>
                        Next
                    </button>
                </div>
            @elseif($step == 4 && $userType === 'business')
                <div class="row">
                    <div class="col-6 col-md-8">
                        <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 col-md-4 text-end">
                        <div class="d-flex justify-content-end align-items-center mb-2">
                            @for ($i = 1; $i <= $totalSteps; $i++)
                                <div class="ms-2" style="height: 8px; width: 32px; border-radius: 4px; background-color: {{ $step >= $i ? '#000' : '#dee2e6' }};"></div>
                            @endfor
                        </div>
                    
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <span class="text-muted">
                                Step <strong>{{ str_pad($step, 2, '0', STR_PAD_LEFT) }} of 0{{$totalSteps}}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-12 col-md-12">
                        <img class="mb-5 mt-5 w-100" src="{{ asset('assets/image/final.png') }}">
                    </div>
                </div>
                <!-- Navigation Buttons -->
                <div class="mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button type="button" class="btn btn-dark btn-sm px-5 py-3 rounded-5" wire:click="finalize"
                        {{ $userType ? '' : 'disabled' }}>
                        Done
                    </button>
                </div>
            @endif
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 text-end d-none d-md-block">
            <img src="{{ asset('assets/image/rectangle_3.png') }}" alt="Onboarding Image" class="img-fluid">
        </div>
    </div>
</div>
@push('style')
    <style>
        .h-180 {
           height: 180px !important;
        }
        .h-2{
            height: 5px;
        }
        .w-6{
            width: 15px;
        }
    </style>
@endpush
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const width = window.innerWidth;
        @this.set('deviceWidth', width);
    });
</script>
@endpush