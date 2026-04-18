<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Lupa Password | LAPORPPA-KBB</title>
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

        .forgot-container {
            width: 100%;
            max-width: 460px;
        }

        .forgot-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .forgot-header {
            background: linear-gradient(135deg, var(--navy), #16213e);
            padding: 32px 32px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .forgot-header::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(216,145,181,0.15);
        }
        .forgot-header::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: rgba(216,145,181,0.1);
        }
        .forgot-header .lock-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--pink-light), var(--pink));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 26px; color: white;
            position: relative; z-index: 1;
        }
        .forgot-header h4 {
            color: #fff;
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 6px;
            position: relative; z-index: 1;
        }
        .forgot-header p {
            color: rgba(255,255,255,0.65);
            font-size: 13px;
            margin: 0;
            position: relative; z-index: 1;
        }

        .forgot-body { padding: 28px 32px 32px; }

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

        .btn-kirim {
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
        .btn-kirim:hover {
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

        .alert-success-custom {
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 13.5px;
            color: #166534;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-card">

            <div class="forgot-header">
                <div class="lock-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h4>Lupa Password?</h4>
                <p>Masukkan email Anda dan kami akan mengirimkan link untuk mereset password</p>
            </div>

            <div class="forgot-body">

                {{-- Success --}}
                @if(session('success'))
                <div class="alert-success-custom">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
                @endif

                {{-- Error --}}
                @if($errors->any())
                <div style="background:#fff5f5; border:1.5px solid #fecaca; border-radius:10px; padding:14px 16px; font-size:13.5px; color:#991b1b; margin-bottom:20px;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i> Alamat Email
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Masukkan email yang terdaftar"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div style="font-size:12px; color:#999; margin-top:5px;">
                            Kami akan mengirimkan link reset password ke email ini
                        </div>
                    </div>

                    <button type="submit" class="btn-kirim">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Link Reset Password
                    </button>
                </form>

                <div class="back-link">
                    Ingat password Anda?
                    <a href="{{ route('user_login') }}"><i class="fas fa-arrow-left me-1"></i> Kembali Login</a>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>