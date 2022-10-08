@extends('auth.layouts.app')

@section('content')
    <a href="{{ route('login') }}" class="brand-logo">
        <h2 class="brand-text text-primary ms-1">LOGIN</h2>
    </a>

    <h4 class="card-title mb-1">Welcome to ILPC 2022! 👋</h4>
    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>

    <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-1">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                placeholder="your_username" aria-describedby="username" tabindex="1" autofocus
                value="{{ old('username') ?? '' }}" />
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </div>

        <div class="mb-1">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <small>Forgot Password?</small>
                    </a>
                @endif
            </div>
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" name="password" tabindex="2"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror
            </div>
        </div>
        <div class="mb-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name='remember' tabindex="3" />
                <label class="form-check-label" for="remember"> Remember Me </label>
            </div>
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

        <button type="submit" class="btn btn-primary w-100" tabindex="4">Log In</button>
    </form>

    <div class="divider my-2">
        <div class="divider-text">or</div>
    </div>

    <p class="text-center mt-2">
        <span>Belum punya akun?</span>
        <a href={{ route('register') }}>
            <span>Lakukan Registrasi disini</span>
        </a>
    </p>
@endsection 