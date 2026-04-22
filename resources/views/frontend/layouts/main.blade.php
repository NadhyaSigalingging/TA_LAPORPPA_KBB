@extends('frontend.layouts.app')

@section('title', 'Beranda — LAPORPPA-KBB')

@section('content')

<section id="beranda" class="hero-section">

    <div class="hero-left">

        <div class="hero-user-greeting">
            <img src="{{ url('avatar_society/', Session::get('photo')) }}" alt="Avatar">
            <div class="hero-user-greeting-text">
                <span class="hero-user-greeting-hi">Selamat datang kembali,</span>
                <span class="hero-user-greeting-name">{{ Session::get('name') }}</span>
            </div>
        </div>

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
            <a href="{{ route('choose_victim') }}" class="btn-cta-primary">
                <i class="fas fa-file-alt"></i> Buat Laporan
            </a>
            <a href="{{ route('complaint') }}" class="btn-cta-secondary">
                <i class="fas fa-list-alt"></i> Riwayat Saya
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
            <div class="hero-badge">
                <div class="hero-badge-icon"><i class="fas fa-search-location"></i></div>
                <div>
                    <div class="hero-badge-text">Lacak Laporan</div>
                    <span class="hero-badge-sub">
                        <a href="{{ route('track_complaint') }}" style="color:var(--pink);text-decoration:none;">Pantau status →</a>
                    </span>
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
<x-section.cara-melapor :guest="false" />
<x-section.jenis-kekerasan />
<x-section.kerahasiaan />


<section id="mulai-melapor" class="cta-band">
    <div class="cta-band-inner">
        <div class="cta-band-left">
            <div class="section-eyebrow" style="margin-bottom:12px;">
                <span class="section-eyebrow-line"></span>
                <span class="section-eyebrow-text">Anda Sudah Siap</span>
            </div>
            <div class="cta-band-title">Buat Laporan,<br>Kami Siap Membantu</div>
            <p class="cta-band-desc">Akun Anda sudah aktif. Jangan tunda lagi — buat laporan sekarang atau pantau status laporan yang sudah Anda kirimkan.</p>
        </div>
        <div class="cta-band-right">
            <a href="{{ route('choose_victim') }}" class="btn-cta-white">
                <i class="fas fa-file-alt"></i> Buat Laporan Sekarang
            </a>
            <a href="{{ route('track_complaint') }}" class="btn-cta-ghost">
                <i class="fas fa-search-location"></i> Lacak Status Laporan
            </a>
        </div>
    </div>
</section>

@endsection