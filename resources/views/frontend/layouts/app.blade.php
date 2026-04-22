@extends('frontend.layouts.base')

@section('navbar')
<nav class="lp-nav" id="mainNav">
    <a class="lp-logo" href="{{ url('user/home') }}">
        Lapor<span class="logo-accent">PPA</span><span class="logo-muted">·KBB</span>
    </a>

    <ul class="lp-nav-links">
        <li><a href="{{ url('user/home') }}#beranda"
               class="{{ Route::currentRouteName() == 'user_home' ? 'active-menu' : '' }}">Beranda</a></li>
        <li><a href="{{ url('user/home') }}#mengapa-melapor">Mengapa Melapor?</a></li>
        <li><a href="{{ url('user/home') }}#cara-melapor">Cara Melapor</a></li>
        <li><a href="{{ url('user/home') }}#jenis-kekerasan">Jenis Kekerasan</a></li>
        <li><a href="{{ url('user/home') }}#kerahasiaan">Kerahasiaan</a></li>

        <li style="display:flex;align-items:center;"><span class="nav-divider"></span></li>

        <li>
            <a href="{{ route('complaint') }}"
               class="{{ Route::currentRouteName() == 'complaint' ? 'active-menu' : '' }}">
                <i class="fas fa-list-alt" style="font-size:10px;margin-right:4px;color:var(--pink);"></i>Riwayat
            </a>
        </li>
        <li>
            <a href="{{ route('track_complaint') }}"
               class="{{ Route::currentRouteName() == 'track_complaint' ? 'active-menu' : '' }}">
                <i class="fas fa-search-location" style="font-size:10px;margin-right:4px;color:var(--pink);"></i>Lacak
            </a>
        </li>
    </ul>

    <div class="lp-nav-right">
        <a href="{{ route('choose_victim') }}" class="btn-nav-lapor">
            <i class="fas fa-file-alt"></i> LAPOR
        </a>

        <a href="#" class="notif-bell" title="Notifikasi">
            <i class="fas fa-bell"></i>
        </a>

        <div class="dropdown">
            <div class="user-trigger" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ url('avatar_society/', Session::get('photo')) }}"
                     alt="Avatar" class="rounded-circle"
                     style="width:28px;height:28px;object-fit:cover;border:2px solid rgba(201,75,120,0.3);">
                <span class="user-name">{{ Session::get('name') }}</span>
                <i class="fas fa-chevron-down" style="font-size:10px;color:var(--text-muted);"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2"
                style="font-family:'Barlow',sans-serif; border:1.5px solid var(--pink-border) !important; min-width:200px;">
                <li>
                    <span class="dropdown-item-text fw-bold" style="font-size:13px;color:var(--text-main);">
                        {{ Session::get('name') }}
                    </span>
                    <span class="dropdown-item-text text-muted" style="font-size:11px;padding-top:0;">Masyarakat</span>
                </li>
                <li><hr class="dropdown-divider my-1" style="border-color:rgba(201,75,120,0.15);"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('complaint') }}" style="font-size:13px;font-weight:600;">
                        <i class="fas fa-list-alt me-2" style="color:var(--pink);"></i>Riwayat Laporan
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('track_complaint') }}" style="font-size:13px;font-weight:600;">
                        <i class="fas fa-search-location me-2" style="color:var(--pink);"></i>Lacak Laporan
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1" style="border-color:rgba(201,75,120,0.15);"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('user_profile') }}" style="font-size:13px;font-weight:600;">
                        <i class="fas fa-user-edit me-2" style="color:var(--pink);"></i>Profil Saya
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1" style="border-color:rgba(201,75,120,0.15);"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('user_logout') }}"
                       style="font-size:13px;font-weight:600;"
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

<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-section-label">Informasi</div>
    <a href="{{ url('user/home') }}#beranda">Beranda</a>
    <a href="{{ url('user/home') }}#mengapa-melapor">Mengapa Melapor?</a>
    <a href="{{ url('user/home') }}#cara-melapor">Cara Melapor</a>
    <a href="{{ url('user/home') }}#jenis-kekerasan">Jenis Kekerasan</a>
    <a href="{{ url('user/home') }}#kerahasiaan">Kerahasiaan</a>
    <div class="mobile-divider"></div>
    <div class="mobile-section-label">Fitur Saya</div>
    <a href="{{ route('complaint') }}"><i class="fas fa-list-alt" style="color:var(--pink);margin-right:6px;"></i>Riwayat Laporan</a>
    <a href="{{ route('track_complaint') }}"><i class="fas fa-search-location" style="color:var(--pink);margin-right:6px;"></i>Lacak Laporan</a>
    <a href="{{ route('user_profile') }}"><i class="fas fa-user-edit" style="color:var(--pink);margin-right:6px;"></i>Profil Saya</a>
    <div class="mobile-divider"></div>
    <a href="{{ route('choose_victim') }}" class="mobile-cta"><i class="fas fa-file-alt" style="margin-right:6px;"></i>Buat Laporan Sekarang</a>
    <a href="{{ route('user_logout') }}" style="color:#dc3545 !important;" onclick="return confirm('Yakin ingin logout?')">
        <i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>Logout
    </a>
</div>
@endsection


@section('footer-slot')
<x-footer>
    <x-slot name="extraLinks">
        <li><a href="{{ route('complaint') }}"><i class="fas fa-chevron-right"></i> Riwayat Laporan</a></li>
        <li><a href="{{ route('track_complaint') }}"><i class="fas fa-chevron-right"></i> Lacak Laporan</a></li>
    </x-slot>
</x-footer>
@endsection

@includeIf('components.ticker')