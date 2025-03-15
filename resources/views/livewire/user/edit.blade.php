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
                @if(auth()->user()->bg_image)
                    <img class="w-100 h-250" src="{{ asset('storage/'.auth()->user()->bg_image) }}">
                @else
                    <img class="w-100 h-250" src="{{ asset('assets/bg/bg_profile.png') }}">
                @endif
                <input type="file" wire:change="save" wire:model="bgImage" hidden id="bgImage"> 
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
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 mb-3 position-relative" style="margin-top:-70px">
                        <img class="w-100 ms-md-4" src="{{ asset('assets/image/profile.png') }}">
                        <a class="position-absolute top-0 end-0 p-2" style="z-index: 1">
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
                        </a>
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
            <form wire:submit.prevent="updateProfile">
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
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-2 mt-2">
                            <input type="text" wire:model="phone" class="form-control" placeholder="Phone"
                                id="phone">
                            <label for="phone">Phone Number</label>
                        </div>
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
                            <input type="text" wire:model="email" class="form-control" placeholder="Brand Name"
                                id="email">
                            <label for="email">Email</label>
                        </div>
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
                        Address
                    </div>
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
                <div class="row">
                    <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">
                        Subscription Details
                    </div>
                    <div class="col-md-3">
                        <div class="border border-2 border-primary p-3 rounded-3 bg-primary bg-opacity-10">
                            <span class="d-block text-primary fw-bold">Premium</span>
                            <span>Valid Till : 24 Oct 2025</span>
                        </div>
                        <button type="submit" class="btn btn-dark mt-3 w-100">Switch to Business</button>
                    </div>
                </div>

                <hr>
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-dark btn-lg">Logout</button>
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
