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
<div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 position-relative">
                @if($bgImage)
                <img class="w-100 h-250" src="{{$bgImage->temporaryUrl()}}" >
                @elseif(auth()->user()->bg_image)
                <img class="w-100 h-250" src="{{ asset('storage/'.auth()->user()->bg_image) }}">
                @else
                    <img class="w-100 h-250" src="{{ asset('assets/bg/bg_profile.png') }}">
                @endif
                <input type="file" wire:model="bgImage" hidden id="bgImage"> 
                <label role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1" wire:target="bgImage" for="bgImage">
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
                        if ($user->role == 'individual') {
                            $route = route('user.profile');
                        } elseif ($user->role == 'business') {
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
                        @if($profileImage)
                            <img class="w-100 ms-md-4 h-100" src="{{ $profileImage->temporaryUrl() }}">
                        @elseif(auth()->user()->profile_image)
                            <img class="w-100 ms-md-4 h-100" src="{{ asset('storage/'.auth()->user()->profile_image) }}">
                        @else
                            <img class="w-100 ms-md-4 h-100" src="{{ asset('assets/image/profile.png') }}">
                        @endif
                        <input type="file" wire:model="profileImage" hidden id="profileImage"> 
                        <label for="profileImage" role="button" class="position-absolute top-0 end-0 p-2" style="z-index: 1">
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
                            Individual
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <form>
                <div class="alert bg-custom-secondary fw-bold" role="alert">
                    Personal Details
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" wire:model="name" class="form-control" placeholder="Name"
                                id="name">
                            <label for="name">Name</label>
                        </div>
                        @error('name')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" wire:model="phone" class="form-control" placeholder="Phone"
                                id="phone">
                            <label for="phone">Phone Number</label>
                        </div>
                        @error('phone')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        @if ($phoneVerifiedAt)
                            <button class="btn bg-custom-secondary mt-2 fw-bold p-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.79476 7.05613C4.79476 5.80713 5.80676 4.79513 7.05576 4.79413H8.08476C8.68176 4.79413 9.25376 4.55713 9.67776 4.13713L10.3968 3.41713C11.2778 2.53113 12.7098 2.52713 13.5958 3.40813L13.5968 3.40913L13.6058 3.41713L14.3258 4.13713C14.7498 4.55813 15.3218 4.79413 15.9188 4.79413H16.9468C18.1958 4.79413 19.2088 5.80613 19.2088 7.05613V8.08313C19.2088 8.68013 19.4448 9.25313 19.8658 9.67713L20.5858 10.3971C21.4718 11.2781 21.4768 12.7101 20.5958 13.5961L20.5948 13.5971L20.5858 13.6061L19.8658 14.3261C19.4448 14.7491 19.2088 15.3211 19.2088 15.9181V16.9471C19.2088 18.1961 18.1968 19.2081 16.9478 19.2081H16.9468H15.9168C15.3198 19.2081 14.7468 19.4451 14.3238 19.8661L13.6038 20.5851C12.7238 21.4711 11.2928 21.4761 10.4068 20.5971C10.4058 20.5961 10.4048 20.5951 10.4038 20.5941L10.3948 20.5851L9.67576 19.8661C9.25276 19.4451 8.67976 19.2091 8.08276 19.2081H7.05576C5.80676 19.2081 4.79476 18.1961 4.79476 16.9471V15.9161C4.79476 15.3191 4.55776 14.7471 4.13676 14.3241L3.41776 13.6041C2.53176 12.7241 2.52676 11.2931 3.40676 10.4071C3.40676 10.4061 3.40776 10.4051 3.40876 10.4041L3.41776 10.3951L4.13676 9.67513C4.55776 9.25113 4.79476 8.67913 4.79476 8.08113V7.05613"
                                        stroke="black" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M8.4375 11.998L10.8115 14.371L15.5575 9.625" stroke="black"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Verified
                            </button>
                        @else
                            <button type="button" wire:click="openVerifySlider('phone')"
                                class="btn btn-dark mt-2 fw-bold py-3 px-4">Verify</button>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" wire:model="email" class="form-control" placeholder="Brand Name"
                                id="email">
                            <label for="email">Email</label>
                        </div>
                        @error('Email')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        @if ($emailVerifiedAt)
                            <button class="btn bg-custom-secondary mt-2 fw-bold p-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.79476 7.05613C4.79476 5.80713 5.80676 4.79513 7.05576 4.79413H8.08476C8.68176 4.79413 9.25376 4.55713 9.67776 4.13713L10.3968 3.41713C11.2778 2.53113 12.7098 2.52713 13.5958 3.40813L13.5968 3.40913L13.6058 3.41713L14.3258 4.13713C14.7498 4.55813 15.3218 4.79413 15.9188 4.79413H16.9468C18.1958 4.79413 19.2088 5.80613 19.2088 7.05613V8.08313C19.2088 8.68013 19.4448 9.25313 19.8658 9.67713L20.5858 10.3971C21.4718 11.2781 21.4768 12.7101 20.5958 13.5961L20.5948 13.5971L20.5858 13.6061L19.8658 14.3261C19.4448 14.7491 19.2088 15.3211 19.2088 15.9181V16.9471C19.2088 18.1961 18.1968 19.2081 16.9478 19.2081H16.9468H15.9168C15.3198 19.2081 14.7468 19.4451 14.3238 19.8661L13.6038 20.5851C12.7238 21.4711 11.2928 21.4761 10.4068 20.5971C10.4058 20.5961 10.4048 20.5951 10.4038 20.5941L10.3948 20.5851L9.67576 19.8661C9.25276 19.4451 8.67976 19.2091 8.08276 19.2081H7.05576C5.80676 19.2081 4.79476 18.1961 4.79476 16.9471V15.9161C4.79476 15.3191 4.55776 14.7471 4.13676 14.3241L3.41776 13.6041C2.53176 12.7241 2.52676 11.2931 3.40676 10.4071C3.40676 10.4061 3.40776 10.4051 3.40876 10.4041L3.41776 10.3951L4.13676 9.67513C4.55776 9.25113 4.79476 8.67913 4.79476 8.08113V7.05613"
                                        stroke="black" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M8.4375 11.998L10.8115 14.371L15.5575 9.625" stroke="black"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Verified
                            </button>
                        @else
                            <button type="button" wire:click="openVerifySlider('email')"
                                class="btn btn-dark mt-2 fw-bold py-3 px-4">Verify</button>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">
                        Address
                    </div>
                    <!-- State Dropdown -->
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
                        <button type="button" class="btn btn-dark mt-3 w-100">Switch to Business</button>
                    </div>
                </div>

                <hr>
                <div class="col-md-12 mt-4">
                    <button type="button" wire:click="update"  class="btn btn-dark btn-lg">update</button>
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
                            <img class="logo-img" src="{{ asset('assets/logo/logo.png') }}">
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
@push('scripts')
    <script>
        // const openSliderBtn = document.getElementById("openSliderBtn");
        // const sliderForm = document.querySelector(".slider-form");
        // // const closeSliderBtn = document.getElementById("closeSliderBtn");

        // openSliderBtn.addEventListener("click", function() {
        //     sliderForm.classList.toggle("open");
        // });

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
