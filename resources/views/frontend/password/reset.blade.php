<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Reset Password | LAPORPPA-KBB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <style>
        :root {
            --pink:       #D891B5;
            --pink-light: #E9A5C5;
            --navy:       #1a1a2e;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--pink-light) 0%, var(--pink) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .reset-container {
            width: 100%;
            max-width: 460px;
        }

        .reset-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .reset-header {
            background: linear-gradient(135deg, var(--navy), #16213e);
            padding: 32px 32px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .reset-header::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(216,145,181,0.15);
        }
        .reset-header::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: rgba(216,145,181,0.1);
        }
        .reset-header .key-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--pink-light), var(--pink));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 26px; color: white;
            position: relative; z-index: 1;
        }
        .reset-header h4 {
            color: #fff;
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 6px;
            position: relative; z-index: 1;
        }
        .reset-header p {
            color: rgba(255,255,255,0.65);
            font-size: 13px;
            margin: 0;
            position: relative; z-index: 1;
        }

        .reset-body { padding: 28px 32px 32px; }

        .form-label {
            font-weight: 600;
            font-size: 13.5px;
            color: var(--navy);
            margin-bottom: 6px;
        }
        .form-control {
            border-radius: 9px !important;
            border: 1.5px solid #ddd !important;
            font-size: 14px;
            padding: 11px 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: var(--pink) !important;
            box-shadow: 0 0 0 3px rgba(216,145,181,0.18) !important;
        }
        .form-control.is-invalid { border-color: #dc3545 !important; }

        .password-wrapper {
            position: relative;
        }
        .password-wrapper .form-control {
            padding-right: 44px;
        }
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            font-size: 15px;
            background: none;
            border: none;
            padding: 0;
        }
        .toggle-password:hover { color: var(--pink); }

        .btn-reset {
            background: linear-gradient(135deg, var(--pink), #B5618E);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-size: 14.5px;
            font-weight: 600;
            width: 100%;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(184,97,142,0.3);
            font-family: 'Poppins', sans-serif;
        }
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(184,97,142,0.42);
            color: #fff;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13.5px;
            color: #6c757d;
        }
        .back-link a {
            color: var(--pink);
            text-decoration: none;
            font-weight: 600;
        }
        .back-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-card">

            <div class="reset-header">
                <div class="key-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h4>Reset Password</h4>
                <p>Masukkan password baru untuk akun Anda</p>
            </div>

            <div class="reset-body">

                {{-- Error --}}
                @if($errors->any())
                <div style="background:#fff5f5; border:1.5px solid #fecaca; border-radius:10px; padding:14px 16px; font-size:13.5px; color:#991b1b; margin-bottom:20px;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    {{-- Email (readonly) --}}
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-envelope me-1"></i> Email
                        </label>
                        <input type="email"
                               class="form-control"
                               value="{{ $email }}"
                               readonly
                               style="background:#f8f6fb; color:#6c757d;">
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-1"></i> Password Baru
                        </label>
                        <div class="password-wrapper">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimal 6 karakter"
                                   required>
                            <button type="button" class="toggle-password" onclick="togglePass('password', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock-open me-1"></i> Konfirmasi Password Baru
                        </label>
                        <div class="password-wrapper">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password baru"
                                   required>
                            <button type="button" class="toggle-password" onclick="togglePass('password_confirmation', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-reset">
                        <i class="fas fa-check me-2"></i> Reset Password
                    </button>
                </form>

                <div class="back-link">
                    <a href="{{ route('user_login') }}">
                        <i class="fas fa-arrow-left me-1"></i> Kembali Login
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function togglePass(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const icon  = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>