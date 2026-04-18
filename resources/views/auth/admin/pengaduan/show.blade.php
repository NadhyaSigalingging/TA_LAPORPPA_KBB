@extends('auth.admin.layouts.main')
@section('title', 'Detail Pengaduan | Pengaduan Masyarakat')

@section('content')

<style>

/* ================= WRAPPER ================= */
.detail-page {
    font-family: 'Segoe UI', sans-serif;
}

/* HEADER */
.page-header h4 {
    color: #0B3C91;
    font-weight: 700;
}

.page-header small {
    color: #64748b;
}

/* CARD */
.card-modern {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    background: white;
}

.card-modern .card-header {
    background: linear-gradient(90deg, #0B3C91, #1E5ED7);
    color: white;
    font-size: 14px;
    font-weight: 600;
}

/* LABEL */
.label {
    font-size: 12px;
    color: #64748b;
}

/* VALUE */
.value {
    font-size: 14px;
    font-weight: 500;
    color: #0f172a;
}

/* REPORT */
.report-box {
    background: #f8fbff;
    border: 1px solid #e3eaf5;
    border-radius: 12px;
    padding: 14px;
    font-size: 13px;
    line-height: 1.6;
}

/* IMAGE */
.img-bukti {
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

/* ================= STATUS ================= */
.status-badge {
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
}

/* WARNA */
.status-proses {
    background: #e8f1ff;
    color: #1E5ED7;
}

.status-selesai {
    background: #e6f7ee;
    color: #27ae60;
}

.status-ditolak {
    background: #ffecec;
    color: #e74c3c;
}

.status-belum {
    background: #eef2f7;
    color: #6c757d;
}

/* BUTTON */
.btn {
    border-radius: 10px;
    font-size: 13px;
}

.btn-navy {
    background: #0B3C91;
    color: white;
}

/* ================= DARK MODE ================= */
body.dark-mode .card-modern {
    background: #1e293b;
}

body.dark-mode .value {
    color: #f1f5f9;
}

body.dark-mode .label {
    color: #cbd5f5;
}

body.dark-mode .report-box {
    background: #0f172a;
    border: 1px solid #334155;
    color: #e5e7eb;
}

body.dark-mode .card-header {
    color: white;
}

</style>

<div class="detail-page container-fluid">

    <!-- HEADER -->
    <div class="page-header mb-4">
        <h4>Detail Pengaduan</h4>
        <small>Informasi lengkap laporan masyarakat</small>
    </div>

    @php
        $statusText = match($complaint->status) {
            'finished' => 'Selesai',
            'rejected' => 'Ditolak',
            'process', 'onprogres' => 'Diproses',
            default => 'Belum Diproses'
        };
    @endphp

    <div class="row">

        <!-- LEFT -->
        <div class="col-lg-8">

            <!-- DATA PELAPOR -->
            <div class="card card-modern mb-3">
                <div class="card-header">Data Pelapor</div>
                <div class="card-body row">

                    <div class="col-md-6 mb-3">
                        <div class="label">Nama</div>
                        <div class="value">{{ $complaint->society->name ?? '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="label">NIK</div>
                        <div class="value">{{ $complaint->nik }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="label">Telepon</div>
                        <div class="value">{{ $complaint->society->phone_number ?? '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="label">Tanggal</div>
                        <div class="value">{{ date('d F Y H:i', strtotime($complaint->created_at)) }}</div>
                    </div>

                </div>
            </div>

            <!-- DATA KORBAN -->
            <div class="card card-modern mb-3">
                <div class="card-header">Data Korban</div>
                <div class="card-body row">

                    <div class="col-md-6 mb-3">
                        <div class="label">Jenis</div>
                        <div class="value">{{ ucfirst($complaint->victim_type) }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="label">Nama</div>
                        <div class="value">{{ $complaint->nama_korban ?? '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="label">Usia</div>
                        <div class="value">{{ $complaint->usia_korban ?? '-' }} tahun</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="label">Jenis Kelamin</div>
                        <div class="value">{{ ucfirst($complaint->jenis_kelamin_korban) }}</div>
                    </div>

                </div>
            </div>

            <!-- KEJADIAN -->
            <div class="card card-modern mb-3">
                <div class="card-header">Data Kejadian</div>
                <div class="card-body">

                    <div class="mb-3">
                        <div class="label">Jenis Kekerasan</div>
                        <div class="value">{{ ucfirst($complaint->jenis_kekerasan) }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="label">Alamat</div>
                        <div class="value">{{ $complaint->alamat_korban ?? '-' }}</div>
                    </div>

                </div>
            </div>

            <!-- LAPORAN -->
            <div class="card card-modern mb-3">
                <div class="card-header">Isi Laporan</div>
                <div class="card-body">

                    <div class="report-box">
                        {!! nl2br(e($complaint->contents_of_the_report)) !!}
                    </div>

                    @if ($complaint->photo)
                        <img src="{{ asset('avatar_complaint/' . $complaint->photo) }}"
                            class="img-fluid img-bukti mt-3">
                    @endif

                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-lg-4">

            <!-- STATUS -->
            <div class="card card-modern mb-3">
                <div class="card-header">Status</div>
                <div class="card-body">

                    <span class="status-badge
                        {{ in_array($complaint->status,['process','onprogres']) ? 'status-proses' : '' }}
                        {{ $complaint->status == 'finished' ? 'status-selesai' : '' }}
                        {{ $complaint->status == 'rejected' ? 'status-ditolak' : '' }}">
                        {{ $statusText }}
                    </span>

                    <hr>

                    <div class="label">Ditangani Oleh</div>
                    <div class="value">
                        {{ optional(optional($complaint->response)->admin)->officer_name ?? '-' }}
                    </div>

                </div>
            </div>

            <!-- PROGRES -->
            <div class="card card-modern mb-3">
                <div class="card-header">Progres</div>
                <div class="card-body">

                    <div class="report-box">
                        {!! nl2br(e($complaint->response->response ?? 'Belum ada keterangan')) !!}
                    </div>

                    @if($complaint->response && $complaint->response->bukti)
                        <a href="{{ asset('bukti_laporan/' . $complaint->response->bukti) }}"
                           target="_blank"
                           class="btn btn-outline-primary mt-3 w-100">
                            Lihat Bukti
                        </a>
                    @endif

                </div>
            </div>

            <!-- ACTION -->
            <div class="card card-modern">
                <div class="card-body d-flex gap-2">

                    <a href="{{ route('auth.admin.pengaduan.edit', $complaint->id) }}"
                       class="btn btn-warning w-100">
                        Kelola
                    </a>

                    <a href="{{ route('auth.admin.pengaduan.index') }}"
                       class="btn btn-navy w-100">
                        Kembali
                    </a>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection