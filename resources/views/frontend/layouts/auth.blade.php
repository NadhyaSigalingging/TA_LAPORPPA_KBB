<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'LAPORPPA-KBB')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Barlow:wght@300;400;500;600;700;800;900&family=Barlow+Condensed:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --pink:        #C94B78;
            --pink-2:      #E8638F;
            --pink-light:  #F4A8C0;
            --pink-pale:   rgba(201,75,120,0.08);
            --pink-border: rgba(201,75,120,0.20);
            --navy:        #1A1140;
            --navy-2:      #231550;
            --text-main:   #1A1140;
            --text-muted:  rgba(26,17,64,0.55);
            --text-soft:   rgba(26,17,64,0.38);
            --white:       #FFFFFF;
            --off-white:   #FEF8FB;
            --radius-md:   16px;
            --radius-lg:   24px;
            --transition:  all 0.25s cubic-bezier(0.22,1,0.36,1);
            --shadow-lg:   0 20px 60px rgba(201,75,120,0.18);
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'Barlow', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            overflow-x: hidden;
            background: var(--off-white);
        }

        body::after {
            content: '';
            position: fixed; inset: 0;
            background-image: radial-gradient(circle, rgba(201,75,120,0.10) 1px, transparent 1px);
            background-size: 36px 36px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.5;
        }

        .auth-left {
            width: 44%;
            flex-shrink: 0;
            background: linear-gradient(145deg, var(--navy) 0%, var(--navy-2) 60%, #3D1A6E 100%);
            position: sticky; 
            top: 0;
        
            min-height: 100vh;
            height: 100vh;   
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 52px 52px 44px;
            overflow: hidden;
            z-index: 1;
        }

        .auth-left::before {
            content: '';
            position: absolute; top: -100px; right: -100px;
            width: 380px; height: 380px; border-radius: 50%;
            background: radial-gradient(circle, rgba(201,75,120,0.25) 0%, transparent 70%);
            pointer-events: none;
        }
        .auth-left::after {
            content: '';
            position: absolute; bottom: -80px; left: -80px;
            width: 300px; height: 300px; border-radius: 50%;
            background: radial-gradient(circle, rgba(201,75,120,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .auth-left-dots {
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        .auth-left-top { position: relative; z-index: 1; }

        .auth-brand {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 26px; font-weight: 900; letter-spacing: 2px;
            text-transform: uppercase; color: #fff; text-decoration: none;
            display: inline-block; margin-bottom: 52px;
        }
        .auth-brand .accent { color: var(--pink-light); }
        .auth-brand .muted  { color: rgba(255,255,255,0.28); }

        .auth-left-heading {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(32px, 3.5vw, 52px);
            font-weight: 900; line-height: 0.95;
            text-transform: uppercase; letter-spacing: -0.5px;
            color: #fff; margin-bottom: 20px;
        }
        .auth-left-heading .italic {
            font-family: 'DM Serif Display', serif;
            font-style: italic; font-weight: 400;
            color: var(--pink-light); font-size: 0.80em;
            letter-spacing: 0; display: block; margin-bottom: 4px;
        }
        .auth-left-desc {
            font-size: 15px; line-height: 1.80;
            color: rgba(255,255,255,0.60);
            max-width: 320px; margin-bottom: 36px;
        }

        .auth-badges { display: flex; flex-direction: column; gap: 12px; }
        .auth-badge {
            display: inline-flex; align-items: center; gap: 12px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 50px; padding: 10px 18px;
            width: fit-content;
        }
        .auth-badge-icon {
            width: 28px; height: 28px; border-radius: 8px;
            background: rgba(201,75,120,0.30);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; color: var(--pink-light); flex-shrink: 0;
        }
        .auth-badge-text { font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.85); }

        .auth-left-bottom {
            position: relative; z-index: 1;
            font-size: 12px; color: rgba(255,255,255,0.30); letter-spacing: 0.5px;
        }

        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
            background: rgba(254,248,251,0.92);
        }

        .auth-form-wrap {
            width: 100%;
            max-width: 420px;
            padding: 20px 0;
            animation: authFadeUp 0.7s cubic-bezier(0.22,1,0.36,1) both;
        }

        .auth-form-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 34px; font-weight: 900; text-transform: uppercase;
            letter-spacing: -0.5px; color: var(--text-main);
            margin-bottom: 6px; line-height: 1.0;
        }
        .auth-form-title .accent { color: var(--pink); }
        .auth-form-subtitle {
            font-size: 14px; color: var(--text-muted); margin-bottom: 32px; line-height: 1.6;
        }

        .auth-field { margin-bottom: 20px; }
        .auth-label {
            display: flex; align-items: center; gap: 7px;
            font-size: 12px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--text-soft);
            margin-bottom: 8px;
        }
        .auth-label i { color: var(--pink); font-size: 11px; }
        .auth-label .req { color: var(--pink); margin-left: 2px; }

        .auth-input {
            width: 100%;
            font-family: 'Barlow', sans-serif;
            font-size: 14px; font-weight: 500; color: var(--text-main);
            background: #fff;
            border: 1.5px solid var(--pink-border);
            border-radius: 10px;
            padding: 11px 16px;
            transition: var(--transition);
            outline: none;
        }
        .auth-input::placeholder { color: var(--text-soft); font-weight: 400; }
        .auth-input:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(201,75,120,0.10);
        }
        .auth-input.is-invalid {
            border-color: #dc3545;
        }
        .auth-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220,53,69,0.10);
        }

        .auth-input-group { position: relative; }
        .auth-input-group .auth-input { padding-right: 48px; }
        .auth-toggle-pw {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: var(--text-soft);
            cursor: pointer; padding: 0; font-size: 15px; transition: color 0.2s;
            display: flex; align-items: center;
        }
        .auth-toggle-pw:hover { color: var(--pink); }

        .invalid-msg {
            font-size: 12px; color: #dc3545; margin-top: 5px;
            display: flex; align-items: center; gap: 5px;
        }
        .invalid-msg i { font-size: 11px; }

        .auth-hint { font-size: 12px; color: var(--text-soft); margin-top: 5px; }

        .btn-auth-submit {
            width: 100%;
            font-family: 'Barlow', sans-serif;
            font-size: 14px; font-weight: 800; letter-spacing: 2px;
            text-transform: uppercase;
            color: #fff; background: var(--pink);
            border: none; border-radius: 10px;
            padding: 13px 24px;
            cursor: pointer; transition: var(--transition);
            display: flex; align-items: center; justify-content: center; gap: 10px;
            box-shadow: 0 6px 20px rgba(201,75,120,0.30);
            margin-top: 8px;
        }
        .btn-auth-submit:hover {
            background: #b03466;
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(201,75,120,0.40);
        }

        .auth-switch {
            margin-top: 24px; text-align: center;
            font-size: 14px; color: var(--text-muted);
        }
        .auth-switch a {
            color: var(--pink); font-weight: 700; text-decoration: none;
            transition: color 0.2s;
        }
        .auth-switch a:hover { color: #b03466; text-decoration: underline; }

        .auth-forgot {
            text-align: right; margin-bottom: 4px;
        }
        .auth-forgot a {
            font-size: 12px; font-weight: 600; color: var(--text-soft);
            text-decoration: none; transition: color 0.2s;
        }
        .auth-forgot a:hover { color: var(--pink); }

        .auth-alert {
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            font-size: 13px; display: flex; gap: 10px; align-items: flex-start;
        }
        .auth-alert-danger {
            background: rgba(220,53,69,0.08); border: 1px solid rgba(220,53,69,0.20);
            color: #842029;
        }
        .auth-alert-success {
            background: rgba(25,135,84,0.08); border: 1px solid rgba(25,135,84,0.20);
            color: #0f5132;
        }
        .auth-alert i { font-size: 14px; flex-shrink: 0; margin-top: 1px; }
        .auth-alert ul { margin: 4px 0 0 0; padding-left: 16px; }
        .auth-alert ul li { font-size: 12.5px; margin-bottom: 2px; }

        .auth-divider {
            display: flex; align-items: center; gap: 12px;
            margin: 20px 0; color: var(--text-soft); font-size: 11px;
            font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
        }
        .auth-divider::before, .auth-divider::after {
            content: ''; flex: 1; height: 1px; background: var(--pink-border);
        }

        @keyframes authFadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 860px) {
            .auth-left { display: none; }
            .auth-right {
                padding: 32px 20px;
                background: var(--off-white);
            }
            body::before {
                content: '';
                position: fixed; inset: 0;
                background:
                    radial-gradient(ellipse 80% 60% at 15% 10%, #FFE4EE 0%, transparent 60%),
                    radial-gradient(ellipse 60% 70% at 85% 5%, #EDE9FF 0%, transparent 55%),
                    linear-gradient(145deg, #FFF5F8 0%, #F5F0FF 40%, #FFF5F8 100%);
                pointer-events: none;
                z-index: 0;
            }
        }
    </style>

    @stack('css')
</head>
<body>

    <div class="auth-left">
        <div class="auth-left-dots"></div>

        <div class="auth-left-top">
            <a href="{{ route('home_public') }}" class="auth-brand">
                Lapor<span class="accent">PPA</span><span class="muted">·KBB</span>
            </a>

            <div class="auth-left-heading">
                <span class="italic">bersama</span>
                Kita Bisa<br>Hentikan<br>Kekerasan<span style="color:var(--pink-light);">.</span>
            </div>
            <p class="auth-left-desc">
                Layanan pelaporan resmi kekerasan perempuan dan anak
                Kabupaten Bandung Barat — aman, rahasia, dan gratis.
            </p>

            <div class="auth-badges">
                <div class="auth-badge">
                    <div class="auth-badge-icon"><i class="fas fa-shield-alt"></i></div>
                    <span class="auth-badge-text">100% Rahasia & Terlindungi</span>
                </div>
                <div class="auth-badge">
                    <div class="auth-badge-icon"><i class="fas fa-clock"></i></div>
                    <span class="auth-badge-text">Layanan 24 Jam / 7 Hari</span>
                </div>
                <div class="auth-badge">
                    <div class="auth-badge-icon"><i class="fas fa-gavel"></i></div>
                    <span class="auth-badge-text">Dilindungi Hukum UU PKDRT</span>
                </div>
            </div>
        </div>

        <div class="auth-left-bottom">
            © {{ date('Y') }} DP2KBP3A Kabupaten Bandung Barat
        </div>
    </div>

    <div class="auth-right">
        <div class="auth-form-wrap">
            @if(session('success'))
                <div class="auth-alert auth-alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="auth-alert auth-alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="auth-alert auth-alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Terdapat kesalahan:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('form')

        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
    setTimeout(function () {
        document.querySelectorAll('.auth-alert').forEach(function (el) {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 5000);
    </script>

    @stack('script')
</body>
</html>