<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Login | Sistem Pengaduan Masyarakat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #20385F, #2C4A73);
            font-family: 'Segoe UI', Tahoma, sans-serif;
            min-height: 100vh;
        }

        /* ANIMASI */
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* HEADER (PINK + NAVY) */
        .bg-pink {
            background: linear-gradient(135deg, #F8AFC4, #20385F);
        }

        .bg-pink h5 {
            font-weight: 600;
        }

        .bg-pink p {
            font-size: 14px;
            opacity: 0.9;
        }

        .bg-pink img {
            max-height: 140px;
        }

        /* INPUT */
        .form-control {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ddd;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #F8AFC4;
            box-shadow: 0 0 0 0.2rem rgba(248, 175, 196, 0.25);
        }

        /* BUTTON */
        .btn-pink {
            background: linear-gradient(135deg, #F8AFC4, #20385F);
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 8px;
            padding: 10px;
            transition: 0.3s;
        }

        .btn-pink:hover {
            background: linear-gradient(135deg, #f48fb1, #162D4A);
        }

        /* LOGO */
        .avatar-title {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* LANGUAGE */
        .language-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .language-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 6px 12px;
            border-radius: 6px;
            backdrop-filter: blur(5px);
        }

        .language-options {
            display: none;
            position: absolute;
            background: white;
            right: 0;
            border-radius: 6px;
            overflow: hidden;
        }

        .language-option {
            padding: 10px;
            cursor: pointer;
        }

        .language-option:hover {
            background: #f1f1f1;
        }

        .language-switcher:hover .language-options {
            display: block;
        }

        /* ALERT */
        .alert {
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="language-container">
        <div class="language-switcher">
            <button class="language-btn" id="currentLanguage">
                🌐 ID
            </button>
            <div class="language-options">
                <div class="language-option" data-lang="id">Indonesia</div>
                <div class="language-option" data-lang="en">English</div>
            </div>
        </div>
    </div>

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="card overflow-hidden">

                        <div class="bg-pink bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-white p-4">
                                        <h5 data-translate="login.title">Masuk</h5>
                                        <p data-translate="login.subtitle">
                                            Masuk ke sistem pengaduan masyarakat
                                        </p>
                                    </div>
                                </div>

                                <div class="col-5 align-self-end text-end">
                                    <img src="{{asset('assets/images/profile-img.png')}}" class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">

                            <div class="auth-logo text-center">
                                <div class="avatar-md profile-user-wid mb-4 mx-auto">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="{{asset('assets/images/logo.svg')}}" height="34">
                                    </span>
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger">{{$message}}</div>
                            @endif

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">{{$message}}</div>
                            @endif

                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label data-translate="login.username">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ old('username') }}">
                                </div>

                                <div class="mb-3">
                                    <label data-translate="login.password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control">
                                        <button type="button" class="btn btn-light"
                                            onclick="togglePassword()">👁</button>
                                    </div>
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" name="remember" class="form-check-input">
                                    <label class="form-check-label" data-translate="login.remember">
                                        Ingat Saya
                                    </label>
                                </div>

                                <div class="mt-3 d-grid">
                                    <button class="btn btn-pink" type="submit" data-translate="login.button">
                                        Masuk
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="mt-5 text-center text-white">
                        <p>
                            ©
                            <script>document.write(new Date().getFullYear())</script>
                            Sistem Pengaduan Masyarakat
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        const translations = {
            id: {
                "login.title": "Masuk",
                "login.subtitle": "Masuk ke sistem pengaduan masyarakat",
                "login.username": "Username",
                "login.password": "Password",
                "login.remember": "Ingat Saya",
                "login.button": "Masuk"
            },
            en: {
                "login.title": "Login",
                "login.subtitle": "Login to public complaint system",
                "login.username": "Username",
                "login.password": "Password",
                "login.remember": "Remember Me",
                "login.button": "Login"
            }
        };

        function changeLanguage(lang) {
            localStorage.setItem('lang', lang);
            document.getElementById('currentLanguage').innerText = lang.toUpperCase();

            document.querySelectorAll('[data-translate]').forEach(el => {
                const key = el.getAttribute('data-translate');
                el.innerText = translations[lang][key];
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const lang = localStorage.getItem('lang') || 'id';
            changeLanguage(lang);

            document.querySelectorAll('.language-option').forEach(el => {
                el.addEventListener('click', () => {
                    changeLanguage(el.dataset.lang);
                });
            });

            setTimeout(() => {
                $('.alert').fadeOut();
            }, 2500);
        });
    </script>

</body>

</html>