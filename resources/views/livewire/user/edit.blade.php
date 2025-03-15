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
            <div class="col-12 mt-4">
                <img class="w-100" src="{{ asset('assets/bg/bg_profile.png') }}">
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2">
                        <img class="w-100 ms-md-4" style="margin-top:-70px" src="{{ asset('assets/image/profile.png') }}">
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
