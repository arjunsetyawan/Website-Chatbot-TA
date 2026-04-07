<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up – RSUD Sultan Fatah</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .field-error {
            color: #dc2626;
            font-size: 11.5px;
            margin-top: 4px;
            display: block;
        }

        .input-wrapper input.is-invalid {
            border-color: #dc2626 !important;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Sign Up</h2>
                <p>Buat akun baru sebagai pasien RSUD Sultan Fatah</p>
            </div>

            {{-- Error umum --}}
            @if ($errors->any() && !$errors->has('name') && !$errors->has('email') && !$errors->has('password'))
                <div class="alert-error">Terjadi kesalahan, silakan periksa kembali form.</div>
            @endif

            <form class="login-form" method="POST" action="{{ route('register.post') }}" novalidate>
                @csrf

                {{-- Nama --}}
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            autocomplete="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                        <label for="name">Nama Lengkap</label>
                    </div>
                    @error('name')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

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
                        <input type="password" id="password" name="password" required autocomplete="new-password"
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

                {{-- Confirm Password --}}
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            autocomplete="new-password"
                            class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <button type="button" class="password-toggle" id="confirmPasswordToggle"
                            aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">Daftar Sekarang</span>
                    <span class="btn-loader"></span>
                </button>
            </form>

            <div class="signup-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Sign in</a></p>
            </div>
        </div>
    </div>

    <script>
        // Toggle show/hide password
        document.getElementById('passwordToggle')?.addEventListener('click', () => {
            const pw = document.getElementById('password');
            pw.type = pw.type === 'password' ? 'text' : 'password';
        });
        document.getElementById('confirmPasswordToggle')?.addEventListener('click', () => {
            const pw = document.getElementById('password_confirmation');
            pw.type = pw.type === 'password' ? 'text' : 'password';
        });

        // Loading state saat submit
        const form = document.querySelector('.login-form');
        const btn = document.querySelector('.login-btn');
        if (form && btn) {
            form.addEventListener('submit', () => {
                btn.disabled = true;
                btn.querySelector('.btn-text').textContent = 'Mendaftarkan...';
            });
        }
    </script>
</body>

</html>
