@extends('layouts.auth-layout')

@section('content')
    <div class="container">
        <div class="row pb-md-0 pb-4">
            <div class="col-md-6">
                <button class="btn btn-defualt @if ($page == 'signup') d-none @endif">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="20" transform="matrix(-1 0 0 1 40 0)" fill="white"
                            fill-opacity="0.8" />
                        <path
                            d="M16.7345 19.9974L23.472 13.2599C23.7012 13.0307 23.812 12.7595 23.8043 12.4464C23.7967 12.1332 23.6783 11.862 23.4491 11.6328C23.2199 11.4036 22.9488 11.2891 22.6356 11.2891C22.3224 11.2891 22.0512 11.4036 21.822 11.6328L14.7866 18.6911C14.6033 18.8745 14.4658 19.0807 14.3741 19.3099C14.2824 19.5391 14.2366 19.7682 14.2366 19.9974C14.2366 20.2266 14.2824 20.4557 14.3741 20.6849C14.4658 20.9141 14.6033 21.1203 14.7866 21.3036L21.8449 28.362C22.0741 28.5911 22.3415 28.7019 22.647 28.6943C22.9526 28.6866 23.2199 28.5682 23.4491 28.3391C23.6783 28.1099 23.7929 27.8387 23.7929 27.5255C23.7929 27.2123 23.6783 26.9411 23.4491 26.712L16.7345 19.9974Z"
                            fill="black" />
                    </svg>
                </button>
                <a href="{{ route('home') }}" class="btn btn-defualt @if ($page != 'signup') d-none @endif">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="20" transform="matrix(-1 0 0 1 40 0)" fill="white"
                            fill-opacity="0.8" />
                        <path
                            d="M16.7345 19.9974L23.472 13.2599C23.7012 13.0307 23.812 12.7595 23.8043 12.4464C23.7967 12.1332 23.6783 11.862 23.4491 11.6328C23.2199 11.4036 22.9488 11.2891 22.6356 11.2891C22.3224 11.2891 22.0512 11.4036 21.822 11.6328L14.7866 18.6911C14.6033 18.8745 14.4658 19.0807 14.3741 19.3099C14.2824 19.5391 14.2366 19.7682 14.2366 19.9974C14.2366 20.2266 14.2824 20.4557 14.3741 20.6849C14.4658 20.9141 14.6033 21.1203 14.7866 21.3036L21.8449 28.362C22.0741 28.5911 22.3415 28.7019 22.647 28.6943C22.9526 28.6866 23.2199 28.5682 23.4491 28.3391C23.6783 28.1099 23.7929 27.8387 23.7929 27.5255C23.7929 27.2123 23.6783 26.9411 23.4491 26.712L16.7345 19.9974Z"
                            fill="black" />
                    </svg>

                </a>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center" style="min-height: 80vh;">
                <div class="card rounded-4 p-xl-5 w-100" style="opacity: 0.97">
                    <div class="card-body p-xl-5">
                        <form id="phoneForm" class="phone-div">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <img class=" logo-img" src="{{ asset('assets/logo/logo.png') }}">
                                    <h3 class="mt-2">Sign Up</h3>
                                    <p>Great to have you back!</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 py-4">
                                    <div>Get started using,</div>
                                    <div class="text-dark fs-5 fw-bold">Phone Number</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12" id="phoneDiv">
                                    <div class="form-floating">
                                        <input type="number" class="form-control rounded-4" id="phoneInput" placeholder="" name="phone">
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
                                <div class="col-md-12">
                                    <button id="proceed" type="submit" class="btn w-100 btn-secondary">Proceed</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 my-2">
                                    <p>By signing up you agree to our <a href="{{route('page',['slug'=>'terms-and-conditions'])}}">Terms & Conditions</a> and <a href="{{route('page',['slug'=>'privacy-policy'])}}">Privacy Policy</a></p>
                                </div>
                            </div>
                            <div class="row mt-2  text-center">
                                <div class="col-md-12 my-5">
                                    New to {{ env('APP_NAME') }}? <a href="{{ route('login') }}" class="text-primary">Sign In</a>
                                </div>
                            </div>
                        </form>

                        <form id="otpForm" class="d-none otp-div">
                            @csrf
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <img class=" logo-img" src="{{ asset('assets/logo/logo.png') }}">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="fw-bold">OTP Verification</h3>
                                <p>Enter OTP shared on <span id="phoneSpan"></span>
                                </p>
                            </div>
                            <div class="row mb-5">
                                <input type="hidden" name="phone" id="hiddenPhone">
                                <div class="col-md-12">
                                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                        <input name="one" class="m-md-2 me-1 text-center form-control rounded"
                                            type="password" id="first" maxlength="1" placeholder="-" />
                                        <input name="two" class="m-md-2 me-1 text-center form-control rounded"
                                            type="password" id="second" maxlength="1" placeholder="-" />
                                        <input name="three" class="m-md-2 me-1 text-center form-control rounded"
                                            type="password" id="third" maxlength="1" placeholder="-" />
                                        <input name="four" class="m-md-2 me-1 text-center form-control rounded"
                                            type="password" id="fourth" maxlength="1" placeholder="-" />
                                        <input name="five" class="m-md-2 me-1 text-center form-control rounded"
                                            type="password" id="fifth" maxlength="1" placeholder="-" />
                                        <input name="six" class="m-md-2 me-1 text-center form-control rounded"
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
                                    <span id="otp-timer" class="text-dark fw-bold"></span>
                                    <button id="resend-otp-btn" class="btn btn-dark d-none" type="button">Resend OTP</button>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-dark w-100">Sign Up</button>
                                </div>
                            </div>
                            <div class="row mt-2 text-center">
                                <div class="col-md-12 my-5">
                                    New to {{ env('APP_NAME') }}? <a href="{{ route('login') }}" class="text-primary">Sign In</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        let seconds = 120; // Set initial countdown seconds from backend
        let timerInterval = '';

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

        function updateTimer() {
            if (seconds > 0) {
                $('#otp-timer').text(`Resend OTP in ${seconds} Sec`);
                $('#resend-otp-btn').addClass('d-none');
                seconds--;
            } else {
                $('#otp-timer').text('');
                $('#resend-otp-btn').removeClass('d-none');
                clearInterval(timerInterval);
            }
        }

        function sendOtp(){
            $.ajax({
                url: '{{ route("register") }}',
                type: 'POST',
                data: $('#phoneForm').serialize(),
                success: function(response) {
                    if (response.success) {
                        Toastify({
                            text: "OTP sent successfully!",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor:"black",
                        }).showToast();
                        $('#phoneSpan').html($('#phoneInput').val())
                        $('.phone-div').addClass('d-none')
                        $('.otp-div').removeClass('d-none')
                        $('#hiddenPhone').val($('#phoneInput').val())
                        seconds = 120;
                        updateTimer();
                        timerInterval = setInterval(updateTimer, 1000);
                    } else {
                        Toastify({
                            text: "Invalid OTP",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor:"black",
                        }).showToast();
                    }
                    $('#verify-btn').prop('disabled', false).text('Verify');
                },
                error: function() {
                    Toastify({
                        text: "Server error while verifying OTP.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor:"black",
                    }).showToast();
                    $('#verify-btn').prop('disabled', false).text('Verify');
                }
            });
        }

        $(document).ready(function(){
            $(document).on('keyup','#phoneInput',function(){
                let phone = $(this).val();
                if(phone.length > 9){
                    $('#proceed').removeClass('btn-secondary').addClass('btn-dark')
                }
            })

            // Handle resend OTP button click
            $('#resend-otp-btn').on('click', function() {
                // $(this).prop('disabled', true).text('Sending...');
                sendOtp();
            });
        })

        $('#phoneForm').on('submit', function(e) {
            e.preventDefault();
            $('#verify-btn').prop('disabled', true).text('Verifying...');
            sendOtp();
        });

        $('#otpForm').on('submit', function(e) {
            e.preventDefault();
            $('#verify-btn').prop('disabled', true).text('Verifying...');

            $.ajax({
                url: '{{ route("verify.otp") }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Toastify({
                            text: "OTP verified successfully!",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor:"black",
                        }).showToast();
                        $('.phone-div').addClass('d-none')
                        $('.otp-div').removeClass('d-none')
                        window.location.href = response.route;
                    } else {
                        Toastify({
                        text: "Invalid OTP.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor:"black",
                    }).showToast();
                    }
                    $('#verify-btn').prop('disabled', false).text('Verify');
                },
                error: function() {
                    Toastify({
                        text: "Server error while verifying OTP.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor:"black",
                    }).showToast();
                    $('#verify-btn').prop('disabled', false).text('Verify');
                }
            });
        });
    </script>
@endpush

