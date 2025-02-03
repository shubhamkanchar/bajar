@extends('layouts.auth-layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-defualt">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </button>
            </div>
            <div class="col-md-6">
                <div class="card rounded-4 p-5" style="opacity: 0.97">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <h3>Sign In</h3>
                                <p>Great to have you back!</p>
                            </div>
                            <div class="row text-center justify-content-center mb-5">
                                <div class="col-md-6 bg-white rounded-5 p-0">
                                    <button type="button" class="btn rounded-5 btn-dark email-toggle-btn" data-item="email">Email ID</button>
                                    <button type="button" class="btn rounded-5 email-toggle-btn" data-item="phone">Phone</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12" id="emailDiv">
                                    <div class="form-floating">
                                        <input type="email" class="form-control rounded-4" id="emailInput"
                                            placeholder="name@example.com">
                                        <label for="emailInput">Email address</label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 d-none" id="phoneDiv">
                                    <div class="form-floating">
                                        <input type="number" class="form-control rounded-4" id="phoneInput" placeholder="">
                                        <label for="phoneInput">Phone</label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
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
                            <div class="row mt-5 text-center">
                                <div class="col-md-12">
                                    <p>or continue with</p>
                                </div>
                            </div>
                            <div class="row m-0 text-center">
                                <div class="col-md-12 fs-2">
                                    <a class="me-2 text-danger"><i class="fa-brands fa-google"></i></a>
                                    <a class="me-2 text-grey"><i class="fa-brands fa-apple"></i></a>
                                    <a class="me-2 text-primary"><i class="fa-brands fa-facebook"></i></a>
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
@endsection
@push('script')
    <script type="module">
        $(document).on('click','.email-toggle-btn',function(){
            $('.email-toggle-btn').removeClass('btn-dark');
            $(this).addClass('btn-dark')
            if($(this).data('item') == 'phone'){
                $('#emailDiv').addClass('d-none');
                $('#phoneDiv').removeClass('d-none');
            }else{
                $('#emailDiv').removeClass('d-none');
                $('#phoneDiv').addClass('d-none');
            }
        });
    </script>
@endpush