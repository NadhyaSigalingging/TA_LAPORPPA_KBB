@extends('frontend.layouts.app')
@section('title', 'Hasil Pencarian Laporan - LAPORPPA-KBB')

@section('css')
<style>
    .result-header {
        max-width: 900px;
        margin: 0 auto 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        animation: fadeUp 0.5s ease both;
    }
    .result-info {
        font-size: 14px;
        color: #6c757d;
    }
    .result-info span {
        font-weight: 700;
        color: #1a1a2e;
    }

    .btn-cari-lagi {
        border: 1.5px solid #1a1a2e;
        color: #1a1a2e; background: transparent;
        border-radius: 50px; padding: 8px 20px;
        font-size: 13.5px; font-weight: 500;
        transition: all 0.2s; text-decoration: none;
        display: inline-flex; align-items: center; gap: 7px;
    }
    .btn-cari-lagi:hover { background: #1a1a2e; color: #fff; }

    .complaint-card {
        background: white;
        border-radius: 16px;
        border: 1.5px solid rgba(216,145,181,0.15);
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        overflow: hidden;
        max-width: 900px;
        margin: 0 auto 24px;
        animation: fadeUp 0.6s ease both;
    }

    .complaint-card-header {
        background: linear-gradient(135deg, #E9A5C5, #D891B5);
        padding: 16px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    .complaint-card-header .ch-left {
        display: flex; align-items: center; gap: 10px;
    }
    .complaint-card-header .ch-icon {
        width: 34px; height: 34px;
        background: rgba(255,255,255,0.3);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 14px; color: #1a1a2e;
    }
    .complaint-card-header .ch-name {
        font-weight: 700; font-size: 15px; color: #1a1a2e;
    }
    .complaint-card-header .ch-meta {
        font-size: 12px; color: rgba(26,26,46,0.65); margin-top: 2px;
    }

    .code-badge {
    display: inline-block;
    background: #1a1a2e !important;
    color: #ffffff !important;
    font-size: 12px;
    font-weight: 700;
    padding: 3px 12px;
    border-radius: 50px;
    letter-spacing: 1px;
}

    .complaint-info {
        padding: 20px 22px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        border-bottom: 1px solid rgba(216,145,181,0.1);
    }
    .info-item .info-label {
        font-size: 11.5px; color: #999;
        text-transform: uppercase; letter-spacing: 0.5px;
        margin-bottom: 4px;
        display: flex; align-items: center; gap: 5px;
    }
    .info-item .info-label i { color: #D891B5; font-size: 11px; }
    .info-item .info-value {
        font-size: 13.5px; font-weight: 600; color: #1a1a2e;
    }

    .violence-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: #e8f4fd; color: #1a5276;
        padding: 4px 12px; border-radius: 50px;
        font-size: 12px; font-weight: 600;
    }

    .progress-section { padding: 20px 22px; }
    .progress-title {
        font-size: 13px; font-weight: 700; color: #1a1a2e;
        margin-bottom: 20px;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .progress-steps {
        display: flex; align-items: flex-start; position: relative;
    }
    .progress-line-track {
        position: absolute; top: 18px;
        left: calc(16.66%); right: calc(16.66%);
        height: 3px; background: #e0e0e0;
        border-radius: 3px; z-index: 1;
    }
    .progress-line-fill {
        height: 100%;
        background: linear-gradient(135deg, #D891B5, #B5618E);
        border-radius: 3px; transition: width 0.8s ease;
    }
    .progress-step {
        flex: 1; text-align: center; position: relative; z-index: 2;
    }
    .step-circle {
        width: 38px; height: 38px; border-radius: 50%;
        background: #e0e0e0; color: #999;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 10px; font-size: 14px;
        transition: all 0.4s ease;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .step-circle.active    { background: linear-gradient(135deg, #D891B5, #B5618E); color: white; }
    .step-circle.completed { background: linear-gradient(135deg, #48bb78, #38a169); color: white; }
    .step-label { font-size: 11.5px; color: #6c757d; font-weight: 500; line-height: 1.3; }
    .step-label.active    { color: #B5618E; font-weight: 700; }
    .step-label.completed { color: #38a169; font-weight: 600; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 576px) {
        .complaint-info { grid-template-columns: 1fr 1fr; }
        .step-label { font-size: 10px; }
        .step-circle { width: 32px; height: 32px; font-size: 12px; }
    }
</style>
@endsection

@section('content')

<x-hero
    title="Hasil Pencarian Laporan"
    subtitle="Menampilkan laporan berdasarkan kode yang Anda masukkan"
/>

<div class="container pb-5">

    <div class="result-header">
        <div class="result-info">
    Laporan ditemukan dengan kode
    <span style="display:inline-block; background:#1a1a2e; color:#ffffff; font-size:12px; font-weight:700; padding:4px 14px; border-radius:50px; letter-spacing:1px; margin-left:6px;">
        {{ $complaint->unique_code }}
    </span>
</div>
        <a href="{{ route('track_complaint') }}" class="btn-cari-lagi">
            <i class="fas fa-arrow-left"></i> Cari Lagi
        </a>
    </div>

    @php
        $progressWidth = match((string)$complaint->status) {
            '0'        => '0%',
            'process'  => '50%',
            'finished' => '100%',
            default    => '0%',
        };
    @endphp

    <div class="complaint-card">

        {{-- Header card --}}
        <div class="complaint-card-header">
            <div class="ch-left">
                <div class="ch-icon"><i class="fas fa-file-alt"></i></div>
                <div>
                    <div class="ch-name">{{ $complaint->nama_korban }}</div>
                    <div class="ch-meta">
                        <i class="fas fa-calendar me-1"></i>
                        {{ \Carbon\Carbon::parse($complaint->date_complaint)->format('d M Y') }}
                    </div>
                </div>
            </div>
            <x-status-badge status="{{ $complaint->status }}" />
        </div>

        {{-- Info grid --}}
        <div class="complaint-info">

            <div class="info-item">
                <div class="info-label"><i class="fas fa-hashtag"></i> Kode Laporan</div>
                <div class="info-value">
                    <span class="code-badge">{{ $complaint->unique_code }}</span>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</div>
                <div class="info-value">{{ ucfirst($complaint->jenis_kelamin_korban ?? '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label"><i class="fas fa-birthday-cake"></i> Tanggal Lahir / Usia</div>
                <div class="info-value">
                    @if($complaint->tgl_lahir_korban)
                        {{ \Carbon\Carbon::parse($complaint->tgl_lahir_korban)->format('d M Y') }}
                        <span style="font-size:12px; color:#B5618E; font-weight:600;">
                            ({{ \Carbon\Carbon::parse($complaint->tgl_lahir_korban)->age }} thn)
                        </span>
                    @else
                        -
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label"><i class="fas fa-exclamation-triangle"></i> Jenis Kekerasan</div>
                <div class="info-value">
                    <span class="violence-badge">
                        {{ ucfirst($complaint->jenis_kekerasan ?? '-') }}
                    </span>
                </div>
            </div>

        </div>

        {{-- Progress --}}
        <div class="progress-section">
            <div class="progress-title">Progress Laporan</div>
            <div class="progress-steps">
                <div class="progress-line-track">
                    <div class="progress-line-fill" style="width: {{ $progressWidth }};"></div>
                </div>

                {{-- Step 1: Laporan Diterima (selalu completed) --}}
                <div class="progress-step">
                    <div class="step-circle completed">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="step-label completed">Laporan<br>Diterima</div>
                </div>

                {{-- Step 2: Diproses --}}
                <div class="progress-step">
                    <div class="step-circle {{ (string)$complaint->status === 'process' ? 'active' : ((string)$complaint->status === 'finished' ? 'completed' : '') }}">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <div class="step-label {{ (string)$complaint->status === 'process' ? 'active' : ((string)$complaint->status === 'finished' ? 'completed' : '') }}">
                        Sedang<br>Diproses
                    </div>
                </div>

                {{-- Step 3: Selesai --}}
                <div class="progress-step">
                    <div class="step-circle {{ (string)$complaint->status === 'finished' ? 'completed' : '' }}">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div class="step-label {{ (string)$complaint->status === 'finished' ? 'completed' : '' }}">
                        Selesai
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection