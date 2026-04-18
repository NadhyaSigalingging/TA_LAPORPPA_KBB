<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Daftar | Sistem Pelaporan Kekerasan</title>
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
        .register-container { width: 100%; max-width: 500px; padding: 15px; }
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
        .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220,53,69,0.25);
        }
        .auth-logo { text-align: center; margin-bottom: 20px; }
        .auth-logo h3 { color: #420a31; font-weight: 700; margin: 0; }
        .form-text { font-size: 0.85rem; color: #6c757d; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="card">

            <!-- Header Card -->
            <div class="bg-primary bg-soft">
                <div class="row g-0">
                    <div class="col-7">
                        <div class="text-primary p-4">
                            <h5 class="text-primary">Daftar!</h5>
                            <p class="mb-0">Buat akun baru untuk melaporkan</p>
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

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>
                        {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{url('user/register/save')}}" method="POST">
                    @csrf

                    <!-- NIK -->
                    <div class="mb-3">
                        <label for="nik" class="form-label">
                            <i class="mdi mdi-card-account-details me-1"></i>NIK
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('nik') is-invalid @enderror"
                               name="nik" id="nik"
                               placeholder="Masukkan 16 digit NIK"
                               value="{{ old('nik') }}"
                               maxlength="16"
                               inputmode="numeric"
                               required>
                        <small class="form-text">Nomor Induk Kependudukan (16 digit angka)</small>
                        @error('nik')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="mdi mdi-account me-1"></i>Nama Lengkap
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" id="name"
                               placeholder="Masukkan nama lengkap"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">
                            <i class="mdi mdi-at me-1"></i>Username
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('username') is-invalid @enderror"
                               name="username" id="username"
                               placeholder="Pilih username unik"
                               value="{{ old('username') }}"
                               required>
                        @error('username')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="mdi mdi-email me-1"></i>Email
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" id="email"
                               placeholder="Masukkan email aktif"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="mdi mdi-lock me-1"></i>Password
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" id="password"
                                   placeholder="Minimal 6 karakter"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                        <small class="form-text">Minimal 6 karakter</small>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="mdi mdi-lock-check me-1"></i>Konfirmasi Password
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   placeholder="Ulangi password"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirm">
                                <i class="mdi mdi-eye-outline"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-4 d-grid gap-2">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-account-plus me-2"></i>Daftar
                        </button>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-muted">Sudah punya akun?</p>
                        <a href="{{url('user/login')}}" class="btn btn-outline-primary btn-sm">
                            <i class="mdi mdi-login me-1"></i>Masuk di sini
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

        document.getElementById('toggleConfirm').addEventListener('click', function () {
            const f = document.getElementById('password_confirmation');
            const i = this.querySelector('i');
            f.type = f.type === 'password' ? 'text' : 'password';
            i.classList.toggle('mdi-eye-outline');
            i.classList.toggle('mdi-eye-off-outline');
        });

        // Auto hide alerts
        setTimeout(function () {
            document.querySelectorAll('.alert').forEach(function (el) {
                new bootstrap.Alert(el).close();
            });
        }, 4000);
    </script>
</body>
</html>