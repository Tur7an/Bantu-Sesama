@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <h2 class="login-header">{{ __('Login') }}</h2>

        <div class="login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="error-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="error-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group remember-me">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">{{ __('Login') }}</button>
                    @if (Route::has('password.request'))
                    <a class="link-forgot" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Login Container */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f8fafc;
    margin: 0;
}

/* Card */
.login-card {
    background: #ffffff;
    border-radius: 8px;
    padding: 2rem;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.login-header {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #333333;
}

/* Form Styles */
.form-group {
    margin-bottom: 1rem;
}

label {
    font-size: 0.9rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    display: block;
    color: #555555;
}

.form-input {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    border: 1px solid #dcdcdc;
    border-radius: 4px;
    transition: border-color 0.3s;
}

.form-input:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 4px rgba(13, 110, 253, 0.2);
}

.error-feedback {
    font-size: 0.85rem;
    color: #dc3545;
    margin-top: 0.25rem;
}

/* Remember Me */
.remember-me {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: #555555;
}

.remember-me input {
    margin-right: 0.5rem;
}

/* Actions */
.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1.5rem;
}

.btn-submit {
    background-color: #0d6efd;
    color: #ffffff;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-submit:hover {
    background-color: #084298;
}

.link-forgot {
    font-size: 0.9rem;
    color: #0d6efd;
    text-decoration: none;
}

.link-forgot:hover {
    text-decoration: underline;
}
</style>
@endsection
