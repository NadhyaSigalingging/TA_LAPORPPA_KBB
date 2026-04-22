@extends('landing')

@section('title', 'Beranda — LAPORPPA-KBB')

@section('navbar')

{{-- Tambahan CSS khusus untuk elemen navbar logged-in --}}
@push('css')
<style>
    .btn-nav-lapor-auth {
        font-size: 13px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;
        color: #fff; background: var(--pink, #C94B78); border: none; border-radius: 8px;
        padding: 10px 20px; text-decoration: none;
        display: inline-flex; align-items: center; gap: 7px;
        box-shadow: 0 4px 16px rgba(201,75,120,0.32);
        transition: all 0.25s cubic-bezier(0.22,1,0.36,1);
        white-space: nowrap;
    }
    .btn-nav-lapor-auth:hover {
        background: #b03466; color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(201,75,120,0.42);
    }
    .btn-nav-lapor-auth i { font-size: 11px; }

    .notif-bell-auth {
        width: 38px; height: 38px;
        background: rgba(201,75,120,0.10); border: 1.5px solid rgba(201,75,120,0.22);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        color: var(--pink, #C94B78); text-decoration: none; font-size: 14px;
        transition: all 0.25s cubic-bezier(0.22,1,0.36,1); flex-shrink: 0; position: relative;
    }
    .notif-bell-auth:hover {
        background: rgba(201,75,120,0.20); color: var(--pink, #C94B78);
        transform: scale(1.08);
    }

    .user-trigger-auth {
        cursor: pointer; display: flex; align-items: center; gap: 8px;
        padding: 5px 14px 5px 5px; border-radius: 50px;
        background: rgba(201,75,120,0.10); border: 1.5px solid rgba(201,75,120,0.22);
        transition: background 0.2s; flex-shrink: 0;
    }
    .user-trigger-auth:hover { background: rgba(201,75,120,0.18); }
    .user-trigger-auth .user-name-auth {
        font-size: 13px; font-weight: 700; color: var(--text-main, #1A1140);
        max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .user-trigger-auth .chevron-auth {
        font-size: 10px; color: rgba(26,17,64,0.45);
    }

    .dropdown-menu-auth {
        font-family: 'Barlow', sans-serif;
        border: 1.5px solid rgba(201,75,120,0.18) !important;
        border-radius: 14px !important;
        box-shadow: 0 12px 40px rgba(201,75,120,0.14) !important;
        padding: 6px !important;
        min-width: 200px;
    }
    .dropdown-menu-auth .dropdown-item {
        border-radius: 8px; font-size: 13px; font-weight: 600; padding: 9px 14px;
        transition: background 0.15s;
    }
    .dropdown-menu-auth .dropdown-item:hover { background: rgba(201,75,120,0.08); }
    .dropdown-menu-auth .dropdown-divider {
        border-color: rgba(201,75,120,0.12); margin: 4px 0;
    }

    .lp-nav-links a.nav-route-active { color: var(--pink, #C94B78); }
    .lp-nav-links a.nav-route-active::after {
        content: ''; position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%);
        width: 4px; height: 4px; background: var(--pink, #C94B78); border-radius: 50%;
    }

    .mobile-menu-auth a { font-size: 14px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; }
    .mobile-lapor-cta {
        color: #fff !important; background: var(--pink, #C94B78) !important;
        border-radius: 10px !important; text-align: center; margin-top: 4px;
    }
    .mobile-lapor-cta:hover { background: #b03466 !important; }
</style>
@endpush

<nav class="lp-nav" id="mainNav">

    <a href="{{ url('user/home') }}" class="lp-logo">
        Lapor<span class="logo-accent">PPA</span><span class="logo-muted">·KBB</span>
    </a>

    <ul class="lp-nav-links">
        <li><a href="#beranda"          class="nav-link active">Beranda</a></li>
        <li><a href="#mengapa-melapor"  class="nav-link">Mengapa Melapor?</a></li>
        <li><a href="#cara-melapor"     class="nav-link">Cara Melapor</a></li>
        <li><a href="#jenis-kekerasan"  class="nav-link">Jenis Kekerasan</a></li>
        <li><a href="#kerahasiaan"      class="nav-link">Kerahasiaan</a></li>

        <li style="display:flex;align-items:center;">
            <span style="width:1px;height:18px;background:rgba(201,75,120,0.25);display:block;"></span>
        </li>

        <li>
            <a href="{{ route('complaint') }}"
               class="nav-link {{ Route::currentRouteName() == 'complaint' ? 'nav-route-active' : '' }}">
                Riwayat
            </a>
        </li>
        <li>
            <a href="{{ route('track_complaint') }}"
               class="nav-link {{ Route::currentRouteName() == 'track_complaint' ? 'nav-route-active' : '' }}">
                Lacak
            </a>
        </li>
    </ul>

    <div class="lp-nav-right">

        <a href="{{ route('choose_victim') }}" class="btn-nav-lapor-auth">
            <i class="fas fa-file-alt"></i> Lapor
        </a>

        <a href="#" class="notif-bell-auth" title="Notifikasi">
            <i class="fas fa-bell"></i>
        </a>

        <div class="dropdown">
            <div class="user-trigger-auth" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ url('avatar_society/', Session::get('photo')) }}"
                     alt="Avatar"
                     class="rounded-circle"
                     style="width:28px;height:28px;object-fit:cover;border:2px solid rgba(201,75,120,0.30);">
                <span class="user-name-auth">{{ Session::get('name') }}</span>
                <i class="fas fa-chevron-down chevron-auth"></i>
            </div>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-auth shadow mt-2">
                <li>
                    <span class="dropdown-item-text fw-bold" style="font-size:13px;color:var(--text-main,#1A1140);">
                        {{ Session::get('name') }}
                    </span>
                    <span class="dropdown-item-text text-muted" style="font-size:11px;padding-top:0;">
                        Masyarakat
                    </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('user_profile') }}">
                        <i class="fas fa-user-edit me-2" style="color:var(--pink,#C94B78);"></i>
                        Profil Saya
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('complaint') }}">
                        <i class="fas fa-list-alt me-2" style="color:var(--pink,#C94B78);"></i>
                        Riwayat Laporan
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('track_complaint') }}">
                        <i class="fas fa-search-location me-2" style="color:var(--pink,#C94B78);"></i>
                        Lacak Laporan
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('user_logout') }}"
                       onclick="return confirm('Yakin ingin logout?')">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>

        <button class="lp-hamburger" id="hamburgerBtn" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<div class="mobile-menu mobile-menu-auth" id="mobileMenu">
    <a href="#beranda"         class="mobile-nav-link">Beranda</a>
    <a href="#mengapa-melapor" class="mobile-nav-link">Mengapa Melapor?</a>
    <a href="#cara-melapor"    class="mobile-nav-link">Cara Melapor</a>
    <a href="#jenis-kekerasan" class="mobile-nav-link">Jenis Kekerasan</a>
    <a href="#kerahasiaan"     class="mobile-nav-link">Kerahasiaan</a>

    <div class="mobile-divider"></div>

    <a href="{{ route('complaint') }}"      class="mobile-nav-link">Riwayat Laporan</a>
    <a href="{{ route('track_complaint') }}" class="mobile-nav-link">Lacak Laporan</a>
    <a href="{{ route('user_profile') }}"   class="mobile-nav-link">Profil Saya</a>

    <div class="mobile-divider"></div>

    <a href="{{ route('choose_victim') }}" class="mobile-nav-link mobile-lapor-cta">
        <i class="fas fa-file-alt"></i> &nbsp;Buat Laporan
    </a>

    <a href="{{ route('user_logout') }}"
       class="mobile-nav-link"
       style="color:#e05555;"
       onclick="return confirm('Yakin ingin logout?')">
        <i class="fas fa-sign-out-alt me-1"></i> Logout
    </a>
</div>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}" defer></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>

@endsection


