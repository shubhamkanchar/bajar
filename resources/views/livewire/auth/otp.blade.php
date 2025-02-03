<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-defualt">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </button>
            </div>
            <div class="col-md-6">
                <div class="card rounded-4 p-xl-5" style="opacity: 0.97">
                    <div class="card-body p-xl-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <img src="{{ asset('assests/logo/logo.png') }}">
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="fw-bold">OTP Verification</h3>
                                <p>Enter OTP shared on </p>
                            </div>
                            <div class="row mb-5">

                                <div class="col-md-12">
                                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                        <input class="m-md-2 me-1 text-center form-control rounded" type="password"
                                            id="first" maxlength="1" placeholder="-" />
                                        <input class="m-md-2 me-1 text-center form-control rounded" type="text"
                                            id="second" maxlength="1" placeholder="-" />
                                        <input class="m-md-2 me-1 text-center form-control rounded" type="text"
                                            id="third" maxlength="1" placeholder="-" />
                                        <input class="m-md-2 me-1 text-center form-control rounded" type="text"
                                            id="fourth" maxlength="1" placeholder="-" />
                                        <input class="m-md-2 me-1 text-center form-control rounded" type="text"
                                            id="fifth" maxlength="1" placeholder="-" />
                                        <input class="m-md-2 me-1 text-center form-control rounded" type="text"
                                            id="sixth" maxlength="1" placeholder="-" />
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
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
                                    <button type="submit" class="btn btn-dark w-100">Sign In</button>
                                </div>
                            </div>
                            <div class="row mt-3 text-center">
                                <div class="col-md-12">
                                    New to {{ env('APP_NAME') }}? <a class="text-primary">Sign Up</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
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
