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

        <!-- Right Column - Login Form -->
        <div class="col-lg-6 login-right">
            <div class="auth-form-container">
                <div class="auth-form-wrapper">
                    <h2 class="auth-form-title">LOGIN</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Username</label>
                            <input id="email" type="email" class="form-control login-input @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="username">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-input-wrapper">
                                <input id="password" type="password" class="form-control login-input @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password" placeholder="••••••">
                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="bi bi-eye" id="password-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3">
                            Sign In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordEye = document.getElementById('password-eye');

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
