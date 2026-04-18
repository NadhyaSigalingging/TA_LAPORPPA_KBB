<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'LAPORPPA-KBB')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="LAPORPPA-KBB" name="description" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />

    <style>
        :root {
            --pink:       #D891B5;
            --pink-light: #E9A5C5;
            --navy:       #1a1a2e;
            --navy-mid:   #16213e;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Navbar ── */
        .navbar {
            background: linear-gradient(135deg, var(--pink-light), var(--pink)) !important;
            min-height: 64px;
            padding-top: 0;
            padding-bottom: 0;
            position: relative;
        }
        .navbar .container { height: 64px; }

        .navbar-brand {
            color: var(--navy) !important;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 0.5px;
            flex-shrink: 0;
            position: relative;
        }
        .navbar-brand::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0;
            width: 0; height: 2px;
            background: var(--navy);
            transition: width 0.3s ease;
        }
        .navbar-brand:hover::after { width: 100%; }

        .nav-link {
            color: var(--navy) !important;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 14px !important;
            border-radius: 6px;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .nav-link:hover { color: #fff !important; background: rgba(255,255,255,0.18); }
        .nav-link.active-menu { color: #fff !important; background: rgba(255,255,255,0.18); font-weight: 600; }

        .navbar-toggler { border-color: rgba(26,26,46,0.4); }
        .navbar-toggler:focus { box-shadow: none; }
        .navbar-toggler-icon { filter: invert(1); }

        .btn-lapor {
            background: var(--navy) !important;
            color: #fff !important;
            border-radius: 50px !important;
            padding: 8px 24px !important;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.3px;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-lapor:hover {
            background: #0d0d1a !important;
            color: #fff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0,0,0,0.22);
        }

        .btn-masuk {
            border: 2px solid var(--navy);
            color: var(--navy) !important;
            border-radius: 6px;
            padding: 6px 18px;
            font-weight: 500;
            font-size: 14px;
            background: transparent;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-masuk:hover { background: var(--navy); color: #fff !important; }

        .btn-daftar {
            background: var(--navy);
            color: #fff !important;
            border-radius: 50px;
            padding: 7px 22px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-daftar:hover { background: #0d0d1a; color: #fff !important; }

        .user-trigger {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px 5px 5px;
            border-radius: 50px;
            background: rgba(255,255,255,0.28);
            border: 1.5px solid rgba(255,255,255,0.45);
            transition: background 0.2s;
        }
        .user-trigger:hover { background: rgba(255,255,255,0.44); }
        .user-trigger .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .dropdown-item.text-danger:hover { background: #fff5f5; }

        .notif-bell {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.28);
            border: 1.5px solid rgba(255,255,255,0.45);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--navy);
            text-decoration: none;
            transition: background 0.2s;
            flex-shrink: 0;
        }
        .notif-bell:hover { background: rgba(255,255,255,0.45); }
        /* ── Hero ── */
        .hero-section {
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            color: #fff;
            padding: 70px 20px;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: rgba(216,145,181,0.12);
            pointer-events: none;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: rgba(216,145,181,0.08);
            pointer-events: none;
        }
        .hero-section .container { position: relative; z-index: 1; }
        .hero-section h1 {
            font-size: clamp(20px, 3vw, 28px);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.4;
            color: #ffffff;
        }
        .hero-section p {
            font-size: 15px;
            color: rgba(255,255,255,0.75);
            font-weight: 300;
        }

        .hero-animate       { animation: fadeUp 0.7s ease both; }
        .hero-animate-delay { animation: fadeUp 0.7s ease 0.2s both; }

        .process-icon {
            width: 70px; height: 70px;
            background: linear-gradient(135deg, var(--pink-light), var(--pink));
            border-radius: 50%;
            font-size: 28px;
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            transition: transform 0.3s ease;
        }
        .process-card {
            border-radius: 15px !important;
            transition: all 0.35s ease;
            opacity: 0;
            transform: translateY(30px);
        }
        .process-card.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .process-card:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 15px 30px rgba(0,0,0,0.12) !important;
            border-color: var(--pink) !important;
        }
        .process-card:hover .process-icon {
            transform: scale(1.1) rotate(-5deg);
        }
        .card-delay-1 { transition-delay: 0.05s; }
        .card-delay-2 { transition-delay: 0.15s; }
        .card-delay-3 { transition-delay: 0.25s; }
        .card-delay-4 { transition-delay: 0.35s; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Footer ── */
        footer {
            background: linear-gradient(135deg, var(--pink-light), var(--pink));
            color: var(--navy);
            margin-top: auto;
        }
        .footer-social .social-icon {
            width: 38px; height: 38px;
            background: var(--navy);
            color: #fff;
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            text-decoration: none;
            transition: all 0.3s;
        }
        .footer-social .social-icon:hover {
            transform: scale(1.15) rotate(8deg);
            background: #fff;
            color: var(--navy);
        }
    </style>

    @stack('css')
    @yield('css')
</head>
<body>

{{-- ── NAVBAR ── --}}
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">

        @if(Session::has('society_id'))
            <a class="navbar-brand" href="{{ url('user/home') }}">LAPORPPA-KBB</a>
        @else
            <a class="navbar-brand" href="{{ route('home_public') }}">LAPORPPA-KBB</a>
        @endif

        <button class="navbar-toggler ms-auto me-0 border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto gap-1">
                @if(Session::has('society_id'))
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'user_home' ? 'active-menu' : '' }}"
                           href="{{ url('user/home') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'complaint' ? 'active-menu' : '' }}"
                           href="{{ route('complaint') }}">
                            <i class="fas fa-history me-1"></i>Riwayat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'track_complaint' ? 'active-menu' : '' }}"
                           href="{{ route('track_complaint') }}">
                            <i class="fas fa-search me-1"></i>Lacak
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'home_public' ? 'active-menu' : '' }}"
                           href="{{ route('home_public') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'track_complaint' ? 'active-menu' : '' }}"
                           href="{{ route('track_complaint') }}">
                            <i class="fas fa-search me-1"></i>Lacak
                        </a>
                    </li>
                @endif
            </ul>

            <div class="d-flex align-items-center gap-2">
                @if(Session::has('society_id'))
                    <a href="{{ route('choose_victim') }}" class="btn-lapor">
                        <i class="fas fa-file-alt"></i> LAPOR
                    </a>
                    <a href="#" class="notif-bell ms-1">
                        <i class="fas fa-bell" style="font-size:14px;"></i>
                    </a>
                    <div class="dropdown">
                        <div class="user-trigger" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ url('avatar_society/', Session::get('photo')) }}"
                                 alt="Avatar" class="rounded-circle"
                                 style="width:28px;height:28px;object-fit:cover;">
                            <span class="user-name">{{ Session::get('name') }}</span>
                            <i class="fas fa-chevron-down" style="font-size:10px;color:var(--navy);"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2">
                            <li>
                                <span class="dropdown-item-text fw-semibold" style="font-size:13px;">
                                    {{ Session::get('name') }}
                                </span>
                                <span class="dropdown-item-text text-muted" style="font-size:11px;padding-top:0;">
                                    Masyarakat
                                </span>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
    <a class="dropdown-item"
       href="{{ route('user_profile') }}">
        <i class="fas fa-user-edit me-2"></i>Profil Saya
    </a>
</li>
<li><hr class="dropdown-divider my-1"></li>
<li>
    <a class="dropdown-item text-danger"
       href="{{ route('user_logout') }}"
       onclick="return confirm('Yakin ingin logout?')">
        <i class="fas fa-sign-out-alt me-2"></i>Logout
    </a>
</li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('user_login') }}" class="btn-masuk">Masuk</a>
                    <a href="{{ route('user_register') }}" class="btn-daftar">Daftar</a>
                @endif
            </div>
        </div>
    </div>
</nav>

{{-- ── MAIN CONTENT ── --}}
<div class="flex-grow-1">

    @if(Route::currentRouteName() == 'user_home' || Route::currentRouteName() == 'home_public')
    <div class="hero-section">
        <div class="container">
            <h1 class="mb-3 hero-animate">PELAPORAN ONLINE KEKERASAN PEREMPUAN<br>DAN ANAK KABUPATEN BANDUNG BARAT</h1>
            <p class="mb-0 hero-animate-delay">Jika Anda, keluarga Anda, atau seseorang di sekitar Anda menjadi korban kekerasan,<br>jangan ragu untuk melapor!</p>
        </div>
    </div>

    <div class="container mb-5">
        <h2 class="text-center fw-bold mb-4" style="color:var(--navy);">Proses Laporan Anda</h2>
        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card process-card border h-100 text-center p-4 card-delay-1">
                    <div class="process-icon"><i class="fas fa-file-alt"></i></div>
                    <h5 class="fw-semibold" style="color:var(--navy);">1. Tulis Laporan</h5>
                    <p class="text-muted small mb-0">Isi formulir pengaduan dengan benar dan jelas</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card process-card border h-100 text-center p-4 card-delay-2">
                    <div class="process-icon"><i class="fas fa-check-circle"></i></div>
                    <h5 class="fw-semibold" style="color:var(--navy);">2. Proses Verifikasi</h5>
                    <p class="text-muted small mb-0">Tunggu hingga laporan Anda diverifikasi</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card process-card border h-100 text-center p-4 card-delay-3">
                    <div class="process-icon"><i class="fas fa-user-clock"></i></div>
                    <h5 class="fw-semibold" style="color:var(--navy);">3. Tindak Lanjut</h5>
                    <p class="text-muted small mb-0">Laporan Anda sedang ditindaklanjuti</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card process-card border h-100 text-center p-4 card-delay-4">
                    <div class="process-icon"><i class="fas fa-check-double"></i></div>
                    <h5 class="fw-semibold" style="color:var(--navy);">4. Selesai</h5>
                    <p class="text-muted small mb-0">Laporan pengaduan telah ditindaklanjuti</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <x-alert />

    {{-- Page content --}}
    @yield('content')

</div>

{{-- ── FOOTER ── --}}
<footer class="py-4">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div class="d-flex flex-column flex-sm-row gap-3">
            <a href="mailto:DP2KBP3A@gmail.com"
               class="text-decoration-none d-flex align-items-center gap-2"
               style="color:var(--navy); font-size:14px;">
                <i class="fas fa-envelope"></i> DP2KBP3A@gmail.com
            </a>
            <a href="tel:+6285243402748"
               class="text-decoration-none d-flex align-items-center gap-2"
               style="color:var(--navy); font-size:14px;">
                <i class="fas fa-phone"></i> +62 852-4340-2748
            </a>
        </div>
        <div class="footer-social d-flex gap-2">
            <a href="#" class="social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        </div>
    </div>
</footer>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.process-card').forEach(function(card) {
        observer.observe(card);
    });

    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(el) {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(function() { el.remove(); }, 500);
        });
    }, 4000);
</script>

@stack('script')
</body>
</html>