@extends('layouts.auth-layout')
@section('content')
<div class="container">
    <div class="row justify-content-center" style="background-image: url(https://s3-alpha-sig.figma.com/img/2a6e/2e4f/4ce8500a321c01850785ebe9c49be199?Expires=1737936000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=E-s0XUBS8sBBbtjH~Jq5Hl0EfQ4Cq6uzmfewakeO7E5gOjBTvT2VsSWmet4mA5UyM9MxOBqB745akHIZ66sRWXb044Adjq5cXKbWedYxHAoPEhfwGLWsnmz5Zn2CP6wDsvVc6j3q~9zzcwPyfvRh28dNsQWwD4CjQGI4pBcwEWM23QVx9NLPN9LIPznKBULwAKN0Pxzs8QAJnU5VAS9yJPYvtlY9VvjATlceLDNWJBcx8oKWOH7-Nal2fN4-5bQb1k15H8suflTqL9rwDz6s8SSqog~tKxaJgeFgrMV~Reo4jxbjlrM~JOU4ryAXQieEig7QhcRuJbEgk-3AenymHQ__);width: 100%; height: 100vh; background-repeat: no-repeat; background-size: cover;">
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
