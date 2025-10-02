@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="row g-0 min-vh-100">
        <!-- Left Column - Image and Title -->
        <div class="col-lg-6 auth-left">
            <div class="login-image-container">
                <div class="image-placeholder">
                    <img src="{{ asset('images/banner-auth.jpg') }}" alt="Banner" class="login-banner-image">
                </div>
                <div class="auth-title-section">
                    <h1 class="auth-main-title">Sistem Pengelolaan Penugasan dan Aset</h1>
                    <p class="auth-subtitle">Pelayanan Informasi Publik Dinas Komunikasi dan Informasi Kabupaten Badung</p>
                </div>
            </div>
        </div>

        <!-- Right Column - Register Form -->
        <div class="col-lg-6 login-right">
            <div class="auth-form-container">
                <div class="auth-form-wrapper">
                    <h2 class="auth-form-title">REGISTER</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control login-input @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                   placeholder="Full Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control login-input @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   placeholder="email@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="password-input-wrapper">
                                <input id="password" type="password" class="form-control login-input @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password" placeholder="••••••">
                                <button type="button" class="password-toggle" onclick="togglePassword('password', 'password-eye')">
                                    <i class="bi bi-eye" id="password-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <div class="password-input-wrapper">
                                <input id="password-confirm" type="password" class="form-control login-input"
                                       name="password_confirmation" required autocomplete="new-password" placeholder="••••••">
                                <button type="button" class="password-toggle" onclick="togglePassword('password-confirm', 'password-confirm-eye')">
                                    <i class="bi bi-eye" id="password-confirm-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 mb-3">
                            {{ __('Register') }}
                        </button>

                        <div class="text-center">
                            <p class="mb-0 text-muted">Already have an account?
                                <a href="{{ route('login') }}" class="text-decoration-none">Sign In</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, eyeId) {
    const passwordInput = document.getElementById(inputId);
    const passwordEye = document.getElementById(eyeId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordEye.classList.remove('bi-eye');
        passwordEye.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordEye.classList.remove('bi-eye-slash');
        passwordEye.classList.add('bi-eye');
    }
}
</script>
@endsection
