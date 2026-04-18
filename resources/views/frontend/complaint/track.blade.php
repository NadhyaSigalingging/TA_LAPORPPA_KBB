@extends('frontend.layouts.app')
@section('title', 'Lacak Status Laporan - LAPORPPA-KBB')

@section('css')
<style>
    .track-card {
        background: white;
        border-radius: 16px;
        border: 1.5px solid rgba(216,145,181,0.15);
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        overflow: hidden;
        max-width: 600px;
        margin: 0 auto;
        animation: fadeUp 0.6s ease both;
    }
    .track-card-header {
        background: linear-gradient(135deg, #E9A5C5, #D891B5);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .track-card-header .header-icon {
        width: 38px; height: 38px;
        background: rgba(255,255,255,0.3);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px; color: #1a1a2e;
    }
    .track-card-header h5 { margin: 0; font-size: 15px; font-weight: 700; color: #1a1a2e; }

    .track-form .form-label {
        font-weight: 600; font-size: 13.5px; color: #1a1a2e; margin-bottom: 6px;
    }
    .track-form .form-control {
        border-radius: 9px !important;
        border: 1.5px solid #ddd !important;
        font-size: 14px; padding: 11px 14px; transition: all 0.2s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .track-form .form-control:focus {
        border-color: #D891B5 !important;
        box-shadow: 0 0 0 3px rgba(216,145,181,0.18) !important;
    }

    .btn-cari {
        background: linear-gradient(135deg, #D891B5, #B5618E);
        color: #fff; border: none; border-radius: 50px;
        padding: 11px 32px; font-size: 14.5px; font-weight: 600;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(184,97,142,0.3);
        width: 100%;
    }
    .btn-cari:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(184,97,142,0.42);
        color: #fff;
    }

    .not-found-box {
        background: #fff5f5;
        border: 1.5px solid #fecaca;
        border-radius: 10px;
        padding: 16px 18px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        animation: fadeUp 0.5s ease both;
    }
    .not-found-box i { color: #e53e3e; font-size: 18px; margin-top: 2px; flex-shrink: 0; }
    .not-found-box .nf-title { font-weight: 700; color: #c53030; font-size: 14px; margin-bottom: 4px; }
    .not-found-box .nf-desc  { font-size: 13px; color: #742a2a; line-height: 1.6; }

    .code-example {
        display: inline-block;
        background: #1a1a2e;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 50px;
        letter-spacing: 1px;
        margin: 4px 0;
    }

    .info-box {
        background: #f8f6fb;
        border-radius: 10px;
        padding: 16px 18px;
        margin-top: 20px;
    }
    .info-box .info-title {
        font-size: 13px; font-weight: 700; color: #1a1a2e;
        margin-bottom: 10px;
        display: flex; align-items: center; gap: 7px;
    }
    .info-box ul { list-style: none; padding: 0; margin: 0; }
    .info-box li {
        font-size: 12.5px; color: #6c757d;
        padding: 5px 0;
        display: flex; align-items: center; gap: 8px;
    }
    .info-box li i { color: #D891B5; font-size: 11px; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')

<x-hero
    title="Lacak Status Laporan"
    subtitle="Masukkan kode laporan untuk melihat progres laporan Anda"
/>

<div class="container pb-5">
    <div class="track-card">
        <div class="track-card-header">
            <div class="header-icon"><i class="fas fa-search"></i></div>
            <h5>Cari Laporan Berdasarkan Kode</h5>
        </div>

        <div class="card-body p-4">

            {{-- Alert tidak ditemukan --}}
            @if(isset($not_found) && $not_found)
            <div class="not-found-box">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <div class="nf-title">Laporan Tidak Ditemukan</div>
                    <div class="nf-desc">
                        Tidak ada laporan dengan kode
                        <strong>{{ strtoupper($unique_code) }}</strong>.<br>
                        Pastikan kode yang dimasukkan sudah benar.
                    </div>
                </div>
            </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('search_complaint') }}" method="POST" class="track-form">
                @csrf
                <div class="mb-4">
                    <label for="unique_code" class="form-label">
                        Kode Laporan <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           id="unique_code"
                           name="unique_code"
                           class="form-control @error('unique_code') is-invalid @enderror"
                           placeholder="Contoh: RPT-2026-A1B2C"
                           value="{{ old('unique_code', isset($unique_code) ? strtoupper($unique_code) : '') }}"
                           maxlength="20"
                           required>
                    @error('unique_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div style="font-size:12px; color:#999; margin-top:6px;">
                        Kode laporan dikirimkan saat laporan berhasil dibuat, dan dapat dilihat di halaman
                        <a href="{{ route('complaint') }}" style="color:#D891B5; text-decoration:none; font-weight:600;">Riwayat Laporan</a>
                    </div>
                </div>

                <button type="submit" class="btn-cari">
                    <i class="fas fa-search me-2"></i> Cari Laporan
                </button>
            </form>

            {{-- Info --}}
            <div class="info-box">
                <div class="info-title">
                    <i class="fas fa-info-circle" style="color:#D891B5;"></i>
                    Informasi
                </div>
                <ul>
                    <li>
                        <i class="fas fa-circle"></i>
                        Kode laporan diberikan otomatis saat laporan berhasil dikirim
                    </li>
                    <li>
                        <i class="fas fa-circle"></i>
                        Format kode: <span class="code-example">RPT-2026-XXXXX</span>
                    </li>
                    <li>
                        <i class="fas fa-circle"></i>
                        Kode dapat dilihat di halaman Riwayat Laporan atau halaman Detail Laporan
                    </li>
                    <li>
                        <i class="fas fa-circle"></i>
                        Pencarian tidak membedakan huruf besar dan kecil
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>

@endsection