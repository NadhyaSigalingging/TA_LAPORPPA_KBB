@extends('auth.admin.layouts.main')
@section('title', 'Respon Pengaduan')

@section('content')

    <style>
        /* ================= WRAPPER ================= */
        .pengaduan-detail {
            font-family: 'Segoe UI', sans-serif;
        }

        /* TITLE */
        .pengaduan-detail h4 {
            font-weight: 700;
            color: #0B3C91;
            margin-bottom: 4px;
        }

        .pengaduan-detail small {
            color: #64748b;
        }

        /* CARD */
        .pengaduan-detail .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            background: white;
        }

        /* HEADER */
        .pengaduan-detail .card-header {
            background: linear-gradient(90deg, #0B3C91, #1E5ED7);
            color: white;
            font-weight: 600;
            font-size: 14px;
            padding: 14px 18px;
        }

        /* VALUE */
        .info-value {
            font-size: 14px;
            font-weight: 500;
            color: #0f172a;
        }

        /* FORM */
        .form-control,
        .form-select {
            border-radius: 12px;
            font-size: 13px;
            padding: 10px;
            border: 1px solid #e2e8f0;
        }

        /* REPORT */
        .report-box {
            background: #f8fbff;
            border: 1px solid #e3eaf5;
            border-radius: 14px;
            padding: 14px;
            font-size: 13px;
            line-height: 1.6;
        }

        /* IMAGE */
        img {
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        /* ================= STATUS ================= */
        .badge-status {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        /* WARNA */
        .badge-process {
            background: #e8f1ff;
            color: #1E5ED7;
        }

        .badge-finished {
            background: #e6f7ee;
            color: #27ae60;
        }

        .badge-rejected {
            background: #ffecec;
            color: #e74c3c;
        }

        /* BUTTON */
        .btn {
            border-radius: 12px;
            font-size: 13px;
            padding: 10px;
            font-weight: 500;
        }

        .btn-success {
            background: linear-gradient(90deg, #27ae60, #2ecc71);
            border: none;
        }

        .btn-navy {
            background: linear-gradient(90deg, #0B3C91, #1E5ED7);
            color: white;
        }

        /* ACTION */
        .action-area {
            display: flex;
            gap: 10px;
        }

        /* ================= DARK MODE ================= */
        body.dark-mode .pengaduan-detail {
            color: #e5e7eb;
        }

        body.dark-mode .pengaduan-detail .card {
            background: #1e293b;
        }

        body.dark-mode .info-value {
            color: #f1f5f9;
        }

        body.dark-mode .report-box {
            background: #0f172a;
            border: 1px solid #334155;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: #0f172a;
            border: 1px solid #334155;
            color: #e5e7eb;
        }
    </style>

    <div class="pengaduan-detail container-fluid">

        <!-- TITLE -->
        <div class="mb-4">
            <h4>Respon & Progres Pengaduan</h4>
            <small>Kelola dan tindak lanjuti laporan masyarakat</small>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('auth.admin.pengaduan.save', $complaint->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <!-- LEFT -->
                <div class="col-lg-6">

                    <div class="card mb-3">
                        <div class="card-header">Informasi Laporan</div>

                        <div class="card-body">

                            <div class="mb-3">
                                <small>Nama Pelapor</small>
                                <div class="info-value">{{ $complaint->society->name ?? '-' }}</div>
                            </div>

                            <div class="mb-3">
                                <small>NIK</small>
                                <div class="info-value">{{ $complaint->nik }}</div>
                            </div>

                            <div class="mb-3">
                                <small>Jenis</small>
                                <div class="info-value">{{ ucfirst($complaint->jenis_kekerasan) }}</div>
                            </div>

                            <!-- 🔥 STATUS FIX -->
                            <div class="mb-3">
                                <small>Status</small><br>

                                @php
                                    $statusText = match ($complaint->status) {
                                        'finished' => 'Selesai',
                                        'rejected' => 'Ditolak',
                                        'process', 'onprogres' => 'Diproses',
                                        default => ucfirst($complaint->status)
                                    };
                                @endphp

                                <span class="badge-status 
                                    {{ in_array($complaint->status, ['process', 'onprogres']) ? 'badge-process' : '' }}
                                    {{ $complaint->status == 'finished' ? 'badge-finished' : '' }}
                                    {{ $complaint->status == 'rejected' ? 'badge-rejected' : '' }}">
                                    {{ $statusText }}
                                </span>
                            </div>

                            <hr>

                            <small>Deskripsi</small>
                            <div class="report-box mt-2">
                                {!! nl2br(e($complaint->contents_of_the_report)) !!}
                            </div>

                            @if($complaint->photo)
                                <div class="mt-3">
                                    <small>Foto Bukti</small><br>
                                    <img src="{{ asset('avatar_complaint/' . $complaint->photo) }}" class="img-fluid mt-2">
                                </div>
                            @endif

                        </div>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-header">Form Respon Admin</div>

                        <div class="card-body">

                            <div class="mb-3">
                                <label>Admin</label>
                                <input type="text" class="form-control"
                                    value="{{ $complaint->response->admin->officer_name ?? auth()->user()->officer_name }}"
                                    readonly>
                            </div>

                            <!-- 🔥 SELECT STATUS FIX -->
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="process">Diproses</option>
                                    <option value="finished">Selesai</option>
                                    <option value="rejected">Ditolak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Keterangan</label>
                                <textarea name="response" class="form-control"
                                    rows="5">{{ optional($complaint->response)->response }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Upload Bukti</label>
                                <input type="file" name="bukti" class="form-control">
                            </div>

                            <div class="action-area">
                                <button type="submit" class="btn btn-success w-100">Simpan</button>
                                <a href="{{ route('auth.admin.pengaduan.index') }}" class="btn btn-navy w-100">Kembali</a>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </form>

    </div>

@endsection