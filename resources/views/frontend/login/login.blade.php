<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login | Sistem Pelaporan Kekerasan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background: linear-gradient(135deg, #FDB5CE 0%, #FDB5CE 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container { width: 100%; max-width: 450px; padding: 15px; }
        .card {
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            border: none;
            overflow: hidden;
        }
        .form-control:focus {
            border-color: #D891B5;
            box-shadow: 0 0 0 0.2rem rgba(216,145,181,0.25);
        }
        .auth-logo { text-align: center; margin-bottom: 20px; }
        .auth-logo h3 { color: #420a31; font-weight: 700; margin: 0; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">

            <!-- Header Card -->
            <div class="bg-primary bg-soft">
                <div class="row g-0">
                    <div class="col-7">
                        <div class="text-primary p-4">
                            <h5 class="text-primary">Masuk!</h5>
                            <p class="mb-0">Silakan masuk ke akun Anda</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>

            <!-- Body Card -->
            <div class="card-body pt-4">

                <div class="auth-logo">
                    <h3>LAPOR-PPA</h3>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-alert-circle-outline me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <strong>Error!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle me-2"></i>
                        {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>
                        {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{url('user/login/cek')}}" method="POST">
                    @csrf

                    <!-- Username atau Email -->
                    <div class="mb-3">
                        <label for="login" class="form-label">
                            <i class="mdi mdi-account me-1"></i>Username atau Email
                        </label>
                        <input type="text"
                               class="form-control @error('login') is-invalid @enderror"
                               name="login"
                               id="login"
                               placeholder="Masukkan username atau email"
                               value="{{ old('login') }}"
                               required>
                        @error('login')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="mdi mdi-lock me-1"></i>Password
                        </label>
                        <div class="input-group">
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" id="password"
                                   placeholder="Masukkan password"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lupa Password -->
                    <div class="text-end mb-2">
                        <a href="{{ route('password.request') }}"
                           style="font-size:13px; color:#D891B5; text-decoration:none;">
                            <i class="mdi mdi-lock-question me-1"></i>Lupa Password?
                        </a>
                    </div>

                    <!-- Submit -->
                    <div class="mt-2 d-grid gap-2">
                        <button class="btn btn-primary btn-login" type="submit">
                            <i class="mdi mdi-login me-2"></i>Masuk
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="mt-4 text-center">
                        <p class="text-muted">Belum punya akun?</p>
                        <a href="{{url('user/register')}}" class="btn btn-outline-primary btn-sm">
                            <i class="mdi mdi-account-plus me-1"></i>Daftar di sini
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <div class="mt-5 text-center">
            <p class="text-white-50">© 2026 Sistem Pelaporan Kekerasan - Semua Hak Dilindungi</p>
        </div>
    </div>

    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const f = document.getElementById('password');
            const i = this.querySelector('i');
            f.type = f.type === 'password' ? 'text' : 'password';
            i.classList.toggle('mdi-eye-outline');
            i.classList.toggle('mdi-eye-off-outline');
        });

        setTimeout(function () {
            document.querySelectorAll('.alert').forEach(function (el) {
                new bootstrap.Alert(el).close();
            });
        }, 4000);
    </script>
</body>
</html>