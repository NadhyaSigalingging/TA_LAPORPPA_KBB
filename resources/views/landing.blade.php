@extends('frontend.layouts.landing')
@section('title', 'LAPORPPA-KBB — Pelaporan Online Kekerasan Perempuan & Anak')
@section('meta_description', 'Layanan pelaporan online kekerasan perempuan dan anak Kabupaten Bandung Barat')

@section('navbar')
<nav class="lp-nav" id="mainNav">
    <a href="{{ route('home_public') }}" class="lp-logo">
        Lapor<span class="logo-accent">PPA</span><span class="logo-muted">·KBB</span>
    </a>

    <ul class="lp-nav-links">
        <li><a href="#beranda" class="nav-link active">Beranda</a></li>
        <li><a href="#mengapa-melapor" class="nav-link">Mengapa Melapor?</a></li>
        <li><a href="#cara-melapor" class="nav-link">Cara Melapor</a></li>
        <li><a href="#jenis-kekerasan" class="nav-link">Jenis Kekerasan</a></li>
        <li><a href="#kerahasiaan" class="nav-link">Kerahasiaan</a></li>
    </ul>

    <div class="lp-nav-right">
        <a href="{{ route('user_login') }}" class="btn-nav-masuk">Masuk</a>
        <a href="{{ route('user_register') }}" class="btn-nav-lapor">
            <i class="fas fa-file-alt"></i> Buat Laporan
        </a>
        <button class="lp-hamburger" id="hamburgerBtn" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
    <a href="#beranda" class="mobile-nav-link">Beranda</a>
    <a href="#mengapa-melapor" class="mobile-nav-link">Mengapa Melapor?</a>
    <a href="#cara-melapor" class="mobile-nav-link">Cara Melapor</a>
    <a href="#jenis-kekerasan" class="mobile-nav-link">Jenis Kekerasan</a>
    <a href="#kerahasiaan" class="mobile-nav-link">Kerahasiaan</a>
    <div class="mobile-divider"></div>
    <a href="{{ route('user_login') }}" class="mobile-nav-link">Masuk</a>
    <a href="{{ route('user_register') }}" class="mobile-nav-link mobile-cta">Buat Laporan</a>
</div>
@endsection


@section('content')

<section id="beranda" class="hero-section">

    <div class="hero-left">
        <div class="section-eyebrow" style="margin-bottom:24px;">
            <span class="section-eyebrow-line"></span>
            <span class="section-eyebrow-text">Layanan Resmi DP2KBP3A KBB</span>
        </div>

        <h1 class="hero-heading">
            <span class="word-italic">lapor</span>
            sekarang<span style="color:var(--pink);">.</span>
        </h1>

        <p class="hero-desc">
            Pelaporan Online Kekerasan Perempuan &amp; Anak —
            Kabupaten Bandung Barat.<br><br>
            Jika Anda, keluarga, atau seseorang di sekitar Anda menjadi
            <strong>korban kekerasan</strong> — jangan ragu untuk melapor.
            Kami siap membantu dengan <strong>aman &amp; rahasia.</strong>
        </p>

        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-num">24/7</span>
                <span class="hero-stat-label">Layanan Aktif</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">100%</span>
                <span class="hero-stat-label">Terjaga Rahasia</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">Gratis</span>
                <span class="hero-stat-label">Tanpa Biaya</span>
            </div>
        </div>

        <div class="hero-cta-row">
            <a href="{{ route('user_login') }}" class="btn-cta-primary">
                Mulai Melapor <i class="fas fa-arrow-right"></i>
            </a>
            <a href="#cara-melapor" class="btn-cta-secondary">
                <i class="fas fa-info-circle"></i> Cara Melapor
            </a>
        </div>

        <div class="hero-badges">
            <div class="hero-badge">
                <div class="hero-badge-icon"><i class="fas fa-shield-alt"></i></div>
                <div>
                    <div class="hero-badge-text">100% Rahasia</div>
                    <span class="hero-badge-sub">Terlindungi &amp; Aman</span>
                </div>
            </div>
            <div class="hero-badge">
                <div class="hero-badge-icon"><i class="fas fa-gavel"></i></div>
                <div>
                    <div class="hero-badge-text">Dilindungi Hukum</div>
                    <span class="hero-badge-sub">UU PKDRT &amp; UU PA</span>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-right">
        <div class="photo-deco-circle"></div>
        <div class="photo-deco-rect"></div>
        <div class="photo-grid">
            <div class="photo-item-1">
                <img src="{{ asset('assets/images/hero/foto1.png') }}" alt="Pendampingan korban kekerasan">
            </div>
            <div class="photo-item-2">
                <img src="{{ asset('assets/images/hero/foto2.png') }}" alt="Layanan konseling">
            </div>
            <div class="photo-item-3">
                <img src="{{ asset('assets/images/hero/foto3.png') }}" alt="Tim DP2KBP3A">
            </div>
        </div>
    </div>

</section>


<x-section.mengapa-melapor />
<x-section.cara-melapor :guest="true" />
<x-section.jenis-kekerasan />
<x-section.kerahasiaan />


<section id="mulai-melapor" class="cta-band">
    <div class="cta-band-inner">
        <div class="cta-band-left">
            <div class="section-eyebrow" style="margin-bottom:12px;">
                <span class="section-eyebrow-line"></span>
                <span class="section-eyebrow-text">Siap Mengambil Langkah?</span>
            </div>
            <div class="cta-band-title">Jangan Tunda,<br>Lapor Sekarang</div>
            <p class="cta-band-desc">
                Setiap menit yang berlalu berarti. Daftarkan diri dan buat laporan Anda
                sekarang — tim kami siap membantu setiap saat, aman dan rahasia.
            </p>
        </div>
        <div class="cta-band-right">
            <a href="{{ route('user_register') }}" class="btn-cta-white">
                <i class="fas fa-file-alt"></i> Buat Laporan Sekarang
            </a>
            <a href="{{ route('user_login') }}" class="btn-cta-ghost">
                <i class="fas fa-sign-in-alt"></i> Sudah Punya Akun? Masuk
            </a>
        </div>
    </div>
</section>

@endsection


@section('footer-slot')
<x-footer />
@endsection


@includeIf('components.ticker')


@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
    });

    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                navLinks.forEach(link => link.classList.remove('active'));
                const active = document.querySelector(`.nav-link[href="#${entry.target.id}"]`);
                if (active) active.classList.add('active');
            }
        });
    }, { threshold: 0.35 });

    sections.forEach(s => sectionObserver.observe(s));

    const hamburger = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    hamburger.addEventListener('click', () => mobileMenu.classList.toggle('open'));

    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', () => mobileMenu.classList.remove('open'));
    });

    document.addEventListener('click', (e) => {
        if (!nav.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.remove('open');
        }
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
        });
    });

});
</script>
@endpush