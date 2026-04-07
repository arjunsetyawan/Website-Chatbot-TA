<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – RSUD Sultan Fatah</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Sign In</h2>
                <p>Masuk ke akun RSUD Sultan Fatah Anda</p>
            </div>

            {{-- Flash message dari session --}}
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            {{-- Error umum (email/password salah) --}}
            @if ($errors->has('email') && !$errors->has('name'))
                <div class="alert-error">{{ $errors->first('email') }}</div>
            @endif

            <form class="login-form" method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                        <label for="email">Email</label>
                    </div>
                    @error('email')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                        <label for="password">Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle"
                            aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="form-options">
                    <div class="remember-wrapper">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="checkbox-label">
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">Sign In</span>
                    <span class="btn-loader"></span>
                </button>
            </form>

            <div class="signup-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
            </div>
        </div>
    </div>

    <script>
        // Toggle show/hide password
        const toggle = document.getElementById('passwordToggle');
        const pwInput = document.getElementById('password');
        if (toggle && pwInput) {
            toggle.addEventListener('click', () => {
                pwInput.type = pwInput.type === 'password' ? 'text' : 'password';
            });
        }

        // Loading state saat submit
        const form = document.querySelector('.login-form');
        const btn = document.querySelector('.login-btn');
        if (form && btn) {
            form.addEventListener('submit', () => {
                btn.disabled = true;
                btn.querySelector('.btn-text').textContent = 'Signing in...';
            });
        }
    </script>
</body>

</html>
