<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-defualt" wire:click="pageChange('signin')">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="20" transform="matrix(-1 0 0 1 40 0)"
                            fill="white" fill-opacity="0.8" />
                        <path
                            d="M16.7345 19.9974L23.472 13.2599C23.7012 13.0307 23.812 12.7595 23.8043 12.4464C23.7967 12.1332 23.6783 11.862 23.4491 11.6328C23.2199 11.4036 22.9488 11.2891 22.6356 11.2891C22.3224 11.2891 22.0512 11.4036 21.822 11.6328L14.7866 18.6911C14.6033 18.8745 14.4658 19.0807 14.3741 19.3099C14.2824 19.5391 14.2366 19.7682 14.2366 19.9974C14.2366 20.2266 14.2824 20.4557 14.3741 20.6849C14.4658 20.9141 14.6033 21.1203 14.7866 21.3036L21.8449 28.362C22.0741 28.5911 22.3415 28.7019 22.647 28.6943C22.9526 28.6866 23.2199 28.5682 23.4491 28.3391C23.6783 28.1099 23.7929 27.8387 23.7929 27.5255C23.7929 27.2123 23.6783 26.9411 23.4491 26.712L16.7345 19.9974Z"
                            fill="black" />
                    </svg>

                </button>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card rounded-4 p-xl-5" style="opacity: 0.97">
                    <div class="card-body p-xl-5">

                        <form wire:submit.prevent="register" class="@if ($page == 'otp') d-none @endif">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <img class=" logo-img" src="{{ asset('assets/logo/logo.png') }}">
                                </div>
                            </div>
                            <div class="row">
                                <h3>Sign In</h3>
                                <p>Great to have you back!</p>
                            </div>
                            <div class="row text-center justify-content-center mb-5">
                                <div class="bg-white rounded-5 p-2" style="width: fit-content;">
                                    {{-- <button wire:click="tabChange('email')" type="button"
                                        class="btn rounded-5 email-toggle-btn @if ($tab == 'email') btn-dark @endif"
                                        data-item="email">Email ID</button> --}}
                                    <button wire:click="tabChange('phone')" type="button"
                                        class="btn rounded-5 email-toggle-btn @if ($tab == 'phone') btn-dark @endif"
                                        data-item="phone">Phone</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <input type="hidden" wire:model="tab" value="email" id="tab">
                                <div class="col-md-12 @if ($tab == 'phone') d-none @endif" id="emailDiv">
                                    <div class="form-floating">
                                        <input type="email" class="form-control rounded-4" id="emailInput"
                                            placeholder="name@example.com" wire:model="email">
                                        <label for="emailInput">Email address</label>
                                    </div>
                                    @error('email')
                                        <span class="text-danger text-sm">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 @if ($tab == 'email') d-none @endif" id="phoneDiv">
                                    <div class="form-floating">
                                        <input type="number" class="form-control rounded-4" id="phoneInput"
                                            placeholder="" wire:model="phone">
                                        <label for="phoneInput">Phone</label>
                                    </div>
                                    @error('phone')
                                        <span class="text-danger text-sm">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-dark w-100">Proceed</button>
                                </div>
                            </div>
                            {{-- <div class="row mt-5 text-center">
                                <div class="col-md-12">
                                    <p>or continue with</p>
                                </div>
                            </div>
                            <div class="row m-0 text-center">
                                <div class="col-md-12 fs-2">
                                    <a href="{{ url('/auth/redirect/google') }}" class="me-2 text-danger"><i
                                            class="fa-brands fa-google"></i></a>
                                    <a class="me-2 text-grey"><i class="fa-brands fa-apple"></i></a>
                                    <a class="me-2 text-primary"><i class="fa-brands fa-facebook"></i></a>
                                </div>
                            </div> --}}
                            <div class="row mt-3 text-center">
                                <div class="col-md-12">
                                    New to {{ env('APP_NAME') }}? <a href="{{ route('signup') }}"
                                        class="text-primary">Sign Up</a>
                                </div>
                            </div>
                        </form>

                        <form wire:submit.prevent="verifyOtp" class="@if ($page == 'signin') d-none @endif">
                            @csrf
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <img class=" logo-img" src="{{ asset('assets/logo/logo.png') }}">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="fw-bold">OTP Verification</h3>
                                <p>Enter OTP shared on @if ($tab == 'email')
                                        {{ $email }}
                                    @else
                                        {{ $phone }}
                                    @endif
                                </p>
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
                                    @if ($seconds > 0)
                                        Resend OTP in <span class="text-dark fw-bold"
                                            wire:poll.1s="tick">{{ $seconds }} Sec</span>
                                    @else
                                        <button class="btn btn-dark" type="button" wire:click="resendOtp()">Resend
                                            OTP</button>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-dark w-100">Sign In</button>
                                </div>
                            </div>
                            <div class="row mt-3 text-center">
                                <div class="col-md-12">
                                    New to {{ env('APP_NAME') }}? <a href="{{ route('signup') }}"
                                        class="text-primary">Sign Up</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="module">
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
