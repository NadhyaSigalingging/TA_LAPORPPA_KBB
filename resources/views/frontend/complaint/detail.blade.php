@extends('frontend.layouts.app')
@section('title', 'Detail Laporan - LAPORPPA-KBB')

@section('css')
<style>
    .detail-card {
        border-radius: 16px !important;
        border: 1.5px solid rgba(216,145,181,0.15) !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important;
        overflow: hidden;
        animation: fadeUp 0.6s ease both;
        margin-bottom: 24px;
    }

    .detail-card-header {
        background: linear-gradient(135deg, #E9A5C5, #D891B5);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .detail-card-header .header-left {
        display: flex; align-items: center; gap: 12px;
    }
    .detail-card-header .header-icon {
        width: 38px; height: 38px;
        background: rgba(255,255,255,0.3);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px; color: #1a1a2e;
    }
    .detail-card-header h5 { margin: 0; font-size: 15px; font-weight: 700; color: #1a1a2e; }

    .info-row {
        display: flex;
        padding: 14px 0;
        border-bottom: 1px solid rgba(216,145,181,0.1);
        gap: 12px;
        align-items: flex-start;
    }
    .info-row:last-child { border-bottom: none; padding-bottom: 0; }

    .info-label {
        font-size: 13px;
        font-weight: 600;
        color: #6c757d;
        min-width: 200px;
        flex-shrink: 0;
    }
    .info-value {
        font-size: 13.5px;
        color: #1a1a2e;
        font-weight: 500;
        flex: 1;
    }

    .desc-box {
        background: #f8f6fb;
        border: 1.5px solid rgba(216,145,181,0.2);
        border-radius: 10px;
        padding: 16px 18px;
        font-size: 13.5px;
        color: #1a1a2e;
        line-height: 1.7;
    }

    .response-box {
        border-radius: 10px;
        padding: 16px 18px;
        font-size: 13.5px;
        line-height: 1.7;
    }
    .response-box.ada {
        background: #f0fdf4;
        border: 1.5px solid #bbf7d0;
        color: #166534;
    }
    .response-box.belum {
        background: #fffbeb;
        border: 1.5px solid #fde68a;
        color: #92400e;
    }

    .bukti-img {
        border-radius: 12px;
        border: 1.5px solid rgba(216,145,181,0.2);
        max-width: 100%;
        max-height: 420px;
        object-fit: contain;
    }

    .btn-kembali {
        border: 1.5px solid #1a1a2e;
        color: #1a1a2e;
        background: transparent;
        border-radius: 50px;
        padding: 10px 24px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }
    .btn-kembali:hover { background: #1a1a2e; color: #fff; }

    .footer-card-hint {
        font-size: 13px;
        color: #6c757d;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 576px) {
        .info-row { flex-direction: column; gap: 4px; }
        .info-label { min-width: unset; }
        .detail-card-header { flex-direction: column; align-items: flex-start; }
        .footer-card-body { flex-direction: column; align-items: flex-start !important; }
    }
</style>
@endsection

@section('content')

<x-hero
    title="Detail Laporan"
    subtitle="Informasi lengkap laporan yang telah Anda buat"
/>

<div class="container pb-5">

    <div class="card detail-card">
        <div class="detail-card-header">
            <div class="header-left">
                <div class="header-icon"><i class="fas fa-user"></i></div>
                <h5>Informasi Pelapor</h5>
            </div>
            <x-status-badge status="{{ $complaint->status }}" />
        </div>
        <div class="card-body p-4">
            <div class="info-row">
                <div class="info-label"><i class="fas fa-user me-2 text-muted"></i>Nama Pelapor</div>
                <div class="info-value">{{ $complaint->Society->name ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-id-card me-2 text-muted"></i>NIK Pelapor</div>
                <div class="info-value">{{ $complaint->nik ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-phone me-2 text-muted"></i>Nomor Telepon Pelapor</div>
                <div class="info-value">{{ $complaint->Society->phone_number ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-calendar me-2 text-muted"></i>Tanggal Laporan</div>
                <div class="info-value">{{ date('d F Y, H:i', strtotime($complaint->created_at)) }} WIB</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-hashtag me-2 text-muted"></i>Kode Laporan</div>
                <div class="info-value">
                    <span style="background:#1a1a2e; color:#fff; font-size:13px; font-weight:700; padding:4px 14px; border-radius:50px; letter-spacing:1px;">
                        {{ $complaint->unique_code ?? '-' }}
                    </span>
                    <div style="font-size:11px; color:#999; margin-top:4px;">
                        Gunakan kode ini untuk melacak laporan Anda
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card detail-card" style="animation-delay: 0.1s;">
        <div class="detail-card-header">
            <div class="header-left">
                <div class="header-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <h5>Data Korban & Kejadian</h5>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="info-row">
                <div class="info-label"><i class="fas fa-shield-alt me-2 text-muted"></i>Jenis Kekerasan</div>
                <div class="info-value">
                    @if($complaint->jenis_kekerasan)
                        <span style="background:#e8f4fd; color:#1a5276; padding:4px 12px; border-radius:50px; font-size:12px; font-weight:600;">
                            {{ ucfirst($complaint->jenis_kekerasan) }}
                        </span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-user-injured me-2 text-muted"></i>Nama Korban</div>
                <div class="info-value">{{ $complaint->nama_korban ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-birthday-cake me-2 text-muted"></i>Tanggal Lahir Korban</div>
                <div class="info-value">
                    @if($complaint->tgl_lahir_korban)
                        {{ \Carbon\Carbon::parse($complaint->tgl_lahir_korban)->format('d F Y') }}
                        <span style="background:rgba(216,145,181,0.12); color:#B5618E; font-size:12px; font-weight:600; padding:2px 10px; border-radius:50px; margin-left:6px;">
                            {{ \Carbon\Carbon::parse($complaint->tgl_lahir_korban)->age }} tahun
                        </span>
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-venus-mars me-2 text-muted"></i>Jenis Kelamin</div>
                <div class="info-value">{{ $complaint->jenis_kelamin_korban ? ucfirst($complaint->jenis_kelamin_korban) : '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-home me-2 text-muted"></i>Alamat Korban</div>
                <div class="info-value">{{ $complaint->alamat_korban_tinggal ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-phone me-2 text-muted"></i>Nomor Telepon Korban</div>
                <div class="info-value">{{ $complaint->nomor_korban ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-id-card me-2 text-muted"></i>NIK Korban</div>
                <div class="info-value">{{ $complaint->nik_korban ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-map-marker-alt me-2 text-muted"></i>Lokasi Kejadian</div>
                <div class="info-value">{{ $complaint->alamat_korban ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label"><i class="fas fa-clock me-2 text-muted"></i>Waktu Kejadian</div>
                <div class="info-value">
                    {{ $complaint->waktu_kejadian ? date('d F Y, H:i', strtotime($complaint->waktu_kejadian)).' WIB' : '-' }}
                </div>
            </div>
        </div>
    </div>

    <div class="card detail-card" style="animation-delay: 0.15s;">
        <div class="detail-card-header">
            <div class="header-left">
                <div class="header-icon"><i class="fas fa-file-alt"></i></div>
                <h5>Deskripsi / Kronologi Kejadian</h5>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="desc-box">
                {{ $complaint->contents_of_the_report ?? 'Tidak ada deskripsi.' }}
            </div>
        </div>
    </div>

    <div class="card detail-card" style="animation-delay: 0.2s;">
        <div class="detail-card-header">
            <div class="header-left">
                <div class="header-icon"><i class="fas fa-image"></i></div>
                <h5>Bukti Foto</h5>
            </div>
        </div>
        <div class="card-body p-4">
            @if($complaint->photo)
                <img src="{{ url('avatar_complaint/'.$complaint->photo) }}"
                     alt="Bukti Kejadian"
                     class="bukti-img">
            @else
                <p class="text-muted mb-0" style="font-size:13.5px;">
                    <i class="fas fa-image me-2"></i>Tidak ada bukti foto yang dilampirkan
                </p>
            @endif
        </div>
    </div>

    <div class="card detail-card" style="animation-delay: 0.25s;">
        <div class="detail-card-header">
            <div class="header-left">
                <div class="header-icon"><i class="fas fa-comment-dots"></i></div>
                <h5>Respon dari Petugas</h5>
            </div>
        </div>
        <div class="card-body p-4">
            @php
                $res = $complaint->response ?? $complaint->Response ?? null;
            @endphp

            @if($res && $res->response)
                <div class="response-box ada">
                    <div class="mb-2" style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:1px; opacity:0.7;">
                        Tanggal Respon:
                        {{ $res->updated_at ? date('d F Y', strtotime($res->updated_at)) : '-' }}
                    </div>
                    {{ $res->response }}
                </div>

                @if($res->bukti)
                    <div class="mt-3">
                        <div style="font-size:12px; font-weight:700; color:#6c757d; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">
                            <i class="fas fa-paperclip me-1"></i> Bukti dari Petugas
                        </div>
                        @php
                            $ext = strtolower(pathinfo($res->bukti, PATHINFO_EXTENSION));
                        @endphp
                        @if(in_array($ext, ['jpg','jpeg','png']))
                            <img src="{{ url('bukti_laporan/' . $res->bukti) }}"
                                 alt="Bukti Respon"
                                 class="bukti-img">
                        @elseif($ext === 'pdf')
                            <a href="{{ url('bukti_laporan/' . $res->bukti) }}"
                               target="_blank"
                               style="display:inline-flex; align-items:center; gap:8px; background:#1a1a2e; color:#fff; padding:10px 20px; border-radius:50px; font-size:13px; font-weight:600; text-decoration:none;">
                                <i class="fas fa-file-pdf"></i> Lihat Dokumen PDF
                            </a>
                        @endif
                    </div>
                @endif

            @else
                <div class="response-box belum">
                    <i class="fas fa-hourglass-half me-2"></i>
                    Respon dari petugas belum tersedia. Laporan Anda sedang dalam proses penanganan.
                </div>
            @endif
        </div>
    </div>

    <div class="card detail-card" style="animation-delay: 0.3s;">
        <div class="card-body p-4 d-flex justify-content-between align-items-center footer-card-body flex-wrap gap-3">
            <span class="footer-card-hint">
                <i class="fas fa-info-circle me-1"></i>
                Jika ada pertanyaan, silakan hubungi petugas yang berwenang.
            </span>
            <a href="{{ route('complaint') }}" class="btn-kembali">
                <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
            </a>
        </div>
    </div>

</div>

@endsection