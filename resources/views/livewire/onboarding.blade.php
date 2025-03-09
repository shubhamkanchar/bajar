<div class="card rounded-4 shadow">

    <div class="row p-4">
        <div class="offset-xl-2 offset-lg-1 col-xl-4 col-lg-6 col-md-6 col-sm-12 p-4">
            @if ($step === 1)
                <div class="row">
                    <div class="col-6">
                        <img class="mb-5" src="{{ asset('assets/logo/logo.png') }}">

                    </div>
                    <div class="col-6 text-end">
                        @if ($userType == 'Individual')
                            <img class="mb-5" src="{{ asset('assets/image/step_1.png') }}">
                        @else
                            <img class="mb-5" src="{{ asset('assets/image/business/step_1.png') }}">
                        @endif
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
                    <div class="col-xxl-4 col-xl-2 col-md-6 col-lg-6 col-6 mb-3">
                        <div class="border rounded-4 py-5 px-md-4 px-3 text-center">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M30 29.2344C27.5938 29.2344 25.534 28.3777 23.8206 26.6644C22.1069 24.9506 21.25 22.8906 21.25 20.4844C21.25 18.0781 22.1069 16.0183 23.8206 14.305C25.534 12.5913 27.5938 11.7344 30 11.7344C32.4062 11.7344 34.466 12.5913 36.1794 14.305C37.8931 16.0183 38.75 18.0781 38.75 20.4844C38.75 22.8906 37.8931 24.9506 36.1794 26.6644C34.466 28.3777 32.4062 29.2344 30 29.2344ZM11.25 44.475V42.715C11.25 41.4908 11.5825 40.3571 12.2475 39.3137C12.9125 38.2704 13.8012 37.4683 14.9137 36.9075C17.3846 35.6962 19.8773 34.7877 22.3919 34.1819C24.9065 33.576 27.4425 33.2731 30 33.2731C32.5575 33.2731 35.0935 33.576 37.6081 34.1819C40.1227 34.7877 42.6154 35.6962 45.0863 36.9075C46.1987 37.4683 47.0875 38.2704 47.7525 39.3137C48.4175 40.3571 48.75 41.4908 48.75 42.715V44.475C48.75 45.5292 48.3806 46.4258 47.6419 47.165C46.9031 47.9038 46.0065 48.2731 44.9519 48.2731H15.0481C13.9935 48.2731 13.0969 47.9038 12.3581 47.165C11.6194 46.4258 11.25 45.5292 11.25 44.475ZM15 44.5231H45V42.715C45 42.2087 44.8533 41.74 44.56 41.3088C44.2667 40.8779 43.8685 40.5262 43.3656 40.2537C41.2115 39.1929 39.0152 38.3892 36.7769 37.8425C34.5381 37.2963 32.2792 37.0231 30 37.0231C27.7208 37.0231 25.4619 37.2963 23.2231 37.8425C20.9848 38.3892 18.7885 39.1929 16.6344 40.2537C16.1315 40.5262 15.7333 40.8779 15.44 41.3088C15.1467 41.74 15 42.2087 15 42.715V44.5231ZM30 25.4844C31.375 25.4844 32.5521 24.9948 33.5312 24.0156C34.5104 23.0365 35 21.8594 35 20.4844C35 19.1094 34.5104 17.9323 33.5312 16.9531C32.5521 15.974 31.375 15.4844 30 15.4844C28.625 15.4844 27.4479 15.974 26.4688 16.9531C25.4896 17.9323 25 19.1094 25 20.4844C25 21.8594 25.4896 23.0365 26.4688 24.0156C27.4479 24.9948 28.625 25.4844 30 25.4844Z"
                                    fill="black" />
                            </svg>

                            <h6 class="fw-bold {{ $userType === 'individual' ? 'active' : '' }}"
                                wire:click="selectUserType('individual')">
                                Individual
                            </h6>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-2 col-md-6 col-lg-6 col-6 mb-3">
                        <div class="border rounded-4 py-5 px-md-4 px-3 text-center">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.4024 10.625H47.5949C48.1262 10.625 48.5714 10.8048 48.9305 11.1644C49.2901 11.524 49.4699 11.9694 49.4699 12.5006C49.4699 13.0323 49.2901 13.4775 48.9305 13.8363C48.5714 14.1954 48.1262 14.375 47.5949 14.375H12.4024C11.8712 14.375 11.426 14.1952 11.0668 13.8356C10.7072 13.476 10.5274 13.0306 10.5274 12.4994C10.5274 11.9677 10.7072 11.5225 11.0668 11.1637C11.426 10.8046 11.8712 10.625 12.4024 10.625ZM12.8831 49.375C12.2431 49.375 11.7064 49.1585 11.2731 48.7256C10.8401 48.2923 10.6237 47.7556 10.6237 47.1156V34.375H9.84993C9.13826 34.375 8.55243 34.0969 8.09243 33.5406C7.63243 32.9848 7.48576 32.351 7.65243 31.6394L10.1524 19.9087C10.2666 19.3883 10.5324 18.961 10.9499 18.6269C11.3674 18.2923 11.842 18.125 12.3737 18.125H47.6237C48.1553 18.125 48.6299 18.2923 49.0474 18.6269C49.4649 18.961 49.7308 19.3883 49.8449 19.9087L52.3449 31.6394C52.5116 32.351 52.3649 32.9848 51.9049 33.5406C51.4449 34.0969 50.8591 34.375 50.1474 34.375H49.3737V47.5C49.3737 48.0312 49.1939 48.4765 48.8343 48.8356C48.4747 49.1952 48.0293 49.375 47.4981 49.375C46.9664 49.375 46.5212 49.1952 46.1624 48.8356C45.8033 48.4765 45.6237 48.0312 45.6237 47.5V34.375H34.3737V47.1156C34.3737 47.7556 34.1572 48.2923 33.7243 48.7256C33.291 49.1585 32.7543 49.375 32.1143 49.375H12.8831ZM14.3737 45.625H30.6237V34.375H14.3737V45.625ZM11.6618 30.625H48.3356L46.4268 21.875H13.5706L11.6618 30.625Z"
                                    fill="black" />
                            </svg>

                            <h6 class="fw-bold {{ $userType === 'business' ? 'active' : '' }}"
                                wire:click="selectUserType('business')">
                                Business
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-5">
                    <button class="btn btn-defualt">
                        <svg width="35" height="35" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Next
                    </button>
                </div>
            @elseif($step == 2 && $userType === 'individual')
                <div class="row">
                    <div class="col-6">
                        <img class="mb-5" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 text-end">
                        <img class="mb-5" src="{{ asset('assets/image/step_2.png') }}">
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
                            <input type="number" id="phone" class="form-control" wire:model="phone"
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
                            <select class="form-select" id="state" wire:model="state">
                                <option value="">Select State</option>
                                @foreach ($states as $stateOption)
                                    <option value="{{ $stateOption }}">{{ $stateOption }}</option>
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
                            <select class="form-select" id="city" wire:model="city">
                                <option value="">Select City</option>
                                @foreach ($cities as $cityOption)
                                    <option value="{{ $cityOption }}">{{ $cityOption }}</option>
                                @endforeach
                            </select>
                            <label for="city">City</label>
                            @error('city')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="35" height="35" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Next
                    </button>
                </div>
            @elseif($step == 3 && $userType === 'individual')
                <div class="row">
                    <div class="col-6">
                        <img class="mb-5" src="{{ asset('assets/logo/logo.png') }}">

                    </div>
                    <div class="col-6 text-end">
                        <img class="mb-5" src="{{ asset('assets/image/step_3.png') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-4 offset-lg-3 col-lg-6 col-12 col-md-4 text-center">
                        <img class="mb-5 w-100" src="{{ asset('assets/image/final.png') }}">
                    </div>
                </div>
                <!-- Navigation Buttons -->
                <div class="d-flex mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="35" height="35" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Done
                    </button>
                </div>
            @elseif($step == 2 && $userType === 'business')
                <div class="row">
                    <div class="col-6">
                        <img class="mb-5" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 text-end">
                        <img class="mb-5" src="{{ asset('assets/image/business/step_2.png') }}">
                    </div>
                </div>
                <h6 class="text-muted fst-italic mb-3">"Awesome! Share some quick info to get started."</h6>
                <h5 class="fw-bold mb-4">Business Details</h5>
                <div class="row mb-3">
                    <!-- Business Name -->
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="form-floating">
                            <input type="text" id="business_name" class="form-control" wire:model="business_name"
                                placeholder="Please enter your business name">
                            <label for="business_name">Business Name *</label>
                        </div>
                        @error('business_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- GST Number -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="number" id="gst_number" class="form-control" wire:model="gst_number"
                                placeholder="Please enter your GST number">
                            <label for="gst_number">GST Number</label>
                        </div>
                        @error('gst_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <!-- Phone Number -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" id="phone" class="form-control" wire:model="phone"
                                placeholder="Please enter your phone number">
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
                            <input type="text" id="business_address" class="form-control"
                                wire:model="business_address" placeholder="Please enter your business address">
                            <label for="business_address">Business Address</label>
                        </div>
                        @error('business_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State Dropdown -->
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="form-floating">
                            <select class="form-select" id="state" wire:model="state">
                                <option value="">Select State</option>
                                @foreach ($states as $stateOption)
                                    <option value="{{ $stateOption }}">{{ $stateOption }}</option>
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
                            <select class="form-select" id="city" wire:model="city">
                                <option value="">Select City</option>
                                @foreach ($cities as $cityOption)
                                    <option value="{{ $cityOption }}">{{ $cityOption }}</option>
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
                <div class="d-flex mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="35" height="35" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Next
                    </button>
                </div>
            @elseif($step == 3 && $userType === 'business')
                <div class="row">
                    <div class="col-6">
                        <img class="mb-5" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 text-end">
                        <img class="mb-5" src="{{ asset('assets/image/business/step_3.png') }}">
                    </div>
                </div>
                <h6 class="text-muted fst-italic mb-3">"Awesome! Share some quick info to get started."</h6>
                <h5 class="fw-bold mb-4">Business Details</h5>
                <div class="row mb-3">
                    <!-- Business Name -->
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="form-floating">
                            <input type="text" id="business_name" class="form-control" wire:model="business_name"
                                placeholder="Please enter your business name">
                            <label for="business_name">Business Name *</label>
                        </div>
                        @error('business_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- GST Number -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="number" id="gst_number" class="form-control" wire:model="gst_number"
                                placeholder="Please enter your GST number">
                            <label for="gst_number">GST Number</label>
                        </div>
                        @error('gst_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <!-- Phone Number -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" id="phone" class="form-control" wire:model="phone"
                                placeholder="Please enter your phone number">
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
                            <input type="text" id="business_address" class="form-control"
                                wire:model="business_address" placeholder="Please enter your business address">
                            <label for="business_address">Business Address</label>
                        </div>
                        @error('business_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State Dropdown -->
                    <div class="col-12 col-md-6 mb-3 ">
                        <div class="form-floating">
                            <select class="form-select" id="state" wire:model="state">
                                <option value="">Select State</option>
                                @foreach ($states as $stateOption)
                                    <option value="{{ $stateOption }}">{{ $stateOption }}</option>
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
                            <select class="form-select" id="city" wire:model="city">
                                <option value="">Select City</option>
                                @foreach ($cities as $cityOption)
                                    <option value="{{ $cityOption }}">{{ $cityOption }}</option>
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
                <div class="d-flex mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="35" height="35" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Next
                    </button>
                </div>
            @elseif($step == 4 && $userType === 'business')
                <div class="row">
                    <div class="col-6">
                        <img class="mb-5" src="{{ asset('assets/logo/logo.png') }}">
                    </div>
                    <div class="col-6 text-end">
                        <img class="mb-5" src="{{ asset('assets/image/business/step_4.png') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-4 offset-lg-3 col-lg-6 col-12 col-md-4 text-center">
                        <img class="mb-5 w-100" src="{{ asset('assets/image/final.png') }}">
                    </div>
                </div>
                <!-- Navigation Buttons -->
                <div class="d-flex mt-5">
                    <button class="btn btn-defualt" wire:click="prevStep">
                        <svg width="35" height="35" viewBox="0 0 50 50" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="-1" y="1" width="47" height="47" rx="24"
                                transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                            <path
                                d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                                fill="black" />
                        </svg>

                    </button>
                    <button class="btn btn-dark btn-sm px-5 rounded-5" wire:click="nextStep"
                        {{ $userType ? '' : 'disabled' }}>
                        Done
                    </button>
                </div>
            @endif
        </div>
        <div class="col-xl-3 col-lg-5 col-md-6 text-end d-none d-md-block">
            <img src="{{ asset('assets/image/rectangle_3.png') }}" alt="Onboarding Image" class="img-fluid">
        </div>
    </div>
</div>
