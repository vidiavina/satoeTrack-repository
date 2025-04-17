@extends('layout.app')
@section('title', 'Login')
@push('styles_top')
<style>
    body,
    main {
        margin: 0 !important;
        padding: 0 !important;
    }

    main {
        height: 100vh !important;
    }

    .bg-login {
        position: relative;
        background-image: url("{{asset('assets/auth/banner.svg')}}");
        background-repeat: no-repeat;
        background-size: contain;
        background-position: top center;
    }

    .form-container {
        position: relative;
        bottom: -150px;
    }

    .form-title h1,
    .form-title h3 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        color: #07A4E3;
    }

    .form-control:focus,
    .form-control:focus {
        box-shadow: none !important;
        background-color: transparent;
    }

    .form-floating input {
        border: 0;
        border-bottom: 1px solid #00000080;
        border-radius: 0;
        background-color: transparent;
        font-size: 1.3rem;
    }

    .form-floating>.form-control:focus~label,
    label {
        font-weight: bold !important;
        color: inherit !important
    }

    .form-floating>.form-control:focus~label::after {
        background-color: transparent !important;
    }

    .form-floating>.form-control:focus,
    .form-floating>.form-control:not(:placeholder-shown) {
        padding-top: 2.7rem;
        padding-bottom: 1.5rem;
    }

    @media (min-width: 610px) {
        .form-container {
            bottom: -200px
        }
    }

    @media (min-width: 924px) {
        .bg-login {
            top: -30px;
        }

        .form-container {
            bottom: -230px
        }
    }

    @media (min-width: 1100px) {
        .form-container {
            bottom: -250px
        }
    }

    @media (min-width: 1200px) {
        .bg-login {
            top: -45px;
        }
    }

    @media (min-width: 1250px) {
        .bg-login {
            top: -55px;
        }

        .form-container {
            bottom: -280px
        }
    }

    @media (min-width: 1300px) {
        .form-container {
            bottom: -300px
        }
    }

    @media (min-width: 1500px) {
        .bg-login {
            top: -70px;
        }

        .form-container {
            bottom: -340px
        }
    }

    @media (min-width: 2560px) {
        .form-container {
            top: 600px;
        }
    }
</style>
@endpush

@section('content')
<section class="vh-100 bg-login">
    <div class="container">
        <div class="form-container">
            <div class="form-title">
                <h1 class="mb-0">Welcome</h1>
                <h3 class="mb-2">Please login to continue</h3>
            </div>

            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="login"
                        id="login"
                        placeholder="Masukkan NIS/NIP/Email"
                        required autofocus />
                    <label for="login" class="msr-font">NIS/NIP/Email</label>
                </div>
                <div class="form-floating mb-4">
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        placeholder="Masukkan Kata Sandi" required />
                    <label for="password" class="msr-font">Password</label>
                </div>
                <button type="submit" class="btn btn-main w-100 d-flex-center">Login</button>
            </form>
        </div>
    </div>

    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
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
        </div>
    </div> -->
</section>
@endsection