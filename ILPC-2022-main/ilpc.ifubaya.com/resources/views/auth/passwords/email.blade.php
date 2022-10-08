@extends('auth.passwords.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row"></div>
    <div class="content-body">
        <div class="auth-wrapper auth-basic px-2">
            <div class="auth-inner my-2">
                <!-- Forgot Password basic -->
                <div class="card mb-0">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('visitor.index') }}" class="brand-logo">
                            <img src="{{ asset('ilpc2022') }}/identity/logo-no-footer.png" width="100" alt="Logo ILPC" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;">
                        </a>

                        <h4 class="card-title mb-1">Forgot Password? 🔒</h4>
                        <p class="card-text mb-2">Enter your team leader's  email and we'll send you instructions to reset your password</p>
                        <small class="card-text text-warning mb-2">Upon submission, check your inbox or spam</small>

                        <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST" novalidate="novalidate">
                            @csrf
                            <div class="mb-1">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="theo@example.com" value="{{ old('email') }}" aria-describedby="email" tabindex="1" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>

                            {{-- Captcha --}}
                            {!! NoCaptcha::renderJs() !!}
                            <div class="form-check">
                                <div class="my-2">
                                    {!! NoCaptcha::display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                    <small class="text-danger">
                                        <small>{{ $errors->first('g-recaptcha-response') }}</small>
                                    </small>
                                    @endif
                                </div>
                            </div>
                            {{-- End Of Captcha --}}

                            <button class="btn btn-primary w-100 waves-effect waves-float waves-light" type="submit" tabindex="2">Send reset link</button>
                        </form>

                        <p class="text-center mt-2">
                            <a href="{{ route('login') }}"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg> Back to login </a>
                        </p>
                    </div>
                </div>
                <!-- /Forgot Password basic -->
            </div>
        </div>
    </div>
</div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection