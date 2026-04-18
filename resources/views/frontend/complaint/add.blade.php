@extends('frontend.layouts.app')
@section('title', 'Buat Pengaduan - LAPORPPA-KBB')

@section('css')
<style>
    .victim-badge {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 6px 16px; border-radius: 50px;
        font-size: 13px; font-weight: 600; margin-bottom: 24px;
    }
    .victim-badge.self  { background: rgba(216,145,181,0.15); color: #B5618E; border: 1.5px solid rgba(216,145,181,0.3); }
    .victim-badge.other { background: rgba(26,26,46,0.07); color: #1a1a2e; border: 1.5px solid rgba(26,26,46,0.15); }

    .form-card {
        border-radius: 16px !important;
        border: 1.5px solid rgba(216,145,181,0.15) !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important;
        overflow: hidden; animation: fadeUp 0.6s ease both; margin-bottom: 24px;
    }
    .form-card-header {
        background: linear-gradient(135deg, #E9A5C5, #D891B5);
        padding: 18px 24px; display: flex; align-items: center; gap: 12px;
    }
    .form-card-header .header-icon {
        width: 38px; height: 38px; background: rgba(255,255,255,0.3);
        border-radius: 10px; display: flex; align-items: center;
        justify-content: center; font-size: 16px; color: #1a1a2e;
    }
    .form-card-header h5 { margin: 0; font-size: 15px; font-weight: 700; color: #1a1a2e; }

    .form-label { font-weight: 600; font-size: 13.5px; color: #1a1a2e; margin-bottom: 6px; }
    .form-control, .form-select {
        border-radius: 9px !important; border: 1.5px solid #ddd !important;
        font-size: 14px; padding: 10px 14px; transition: all 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #D891B5 !important;
        box-shadow: 0 0 0 3px rgba(216,145,181,0.18) !important;
    }
    .form-control[readonly] {
        background: #f8f6fb !important;
        border-color: rgba(216,145,181,0.3) !important;
        color: #6c757d;
    }
    .form-control.is-invalid, .form-select.is-invalid { border-color: #dc3545 !important; }
    .form-text { font-size: 12px; color: #999; margin-top: 5px; }
    .form-text.auto-fill { color: #B5618E; font-weight: 500; }

    .field-group { padding: 20px 0; border-bottom: 1px solid rgba(216,145,181,0.1); }
    .field-group:last-child { border-bottom: none; padding-bottom: 0; }

    .usia-display {
        display: inline-block;
        background: rgba(216,145,181,0.12);
        color: #B5618E;
        font-size: 12px;
        font-weight: 600;
        padding: 3px 12px;
        border-radius: 50px;
        margin-top: 6px;
    }

    .btn-kirim {
        background: linear-gradient(135deg, #D891B5, #B5618E);
        color: #fff; border: none; border-radius: 50px;
        padding: 11px 32px; font-size: 14.5px; font-weight: 600;
        transition: all 0.25s; box-shadow: 0 4px 14px rgba(184,97,142,0.3);
    }
    .btn-kirim:hover { transform: translateY(-2px); box-shadow: 0 7px 20px rgba(184,97,142,0.42); color: #fff; }
    .btn-kembali {
        border: 1.5px solid #1a1a2e; color: #1a1a2e; background: transparent;
        border-radius: 50px; padding: 10px 24px; font-size: 14.5px; font-weight: 500;
        transition: all 0.2s; text-decoration: none;
    }
    .btn-kembali:hover { background: #1a1a2e; color: #fff; }
    .btn-reset {
        border: 1.5px solid #dee2e6; color: #6c757d; background: transparent;
        border-radius: 50px; padding: 10px 24px; font-size: 14.5px; font-weight: 500;
        transition: all 0.2s;
    }
    .btn-reset:hover { background: #f8f9fa; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
        .form-card-header { padding: 14px 18px; }
        .btn-actions { flex-direction: column; gap: 10px; }
        .btn-actions a, .btn-actions button { width: 100%; text-align: center; justify-content: center; }
    }
</style>
@endsection

@section('content')

@php
    $victimType = request('victim_type', 'self');

    // Auto-fill: ambil dari profil jika korban = diri sendiri
    $autoName    = $victimType === 'self' ? ($society->name ?? '')           : '';
    $autoNik     = $victimType === 'self' ? ($society->nik ?? '')            : '';
    $autoPhone   = $victimType === 'self' ? ($society->phone_number ?? '')   : '';
    $autoAddress = $victimType === 'self' ? ($society->address ?? '')        : '';
    $autoGender  = $victimType === 'self' ? ($society->gender ?? '')         : '';
    $autoBirth   = $victimType === 'self' && $society->birth_date
                    ? $society->birth_date->format('Y-m-d')
                    : '';

    // Tentukan field mana yang readonly (hanya jika ada datanya)
    $readonlyName    = $victimType === 'self' && !empty($autoName);
    $readonlyPhone   = $victimType === 'self' && !empty($autoPhone);
    $readonlyAddress = $victimType === 'self' && !empty($autoAddress);
    $readonlyGender  = $victimType === 'self' && !empty($autoGender);
    $readonlyBirth   = $victimType === 'self' && !empty($autoBirth);
@endphp

<x-hero
    title="Formulir Laporan Kekerasan"
    subtitle="Isi semua data dengan jelas dan lengkap untuk mempercepat proses penanganan"
/>

<div class="container pb-5">

    <div class="text-center mb-4" style="animation: fadeUp 0.5s ease both;">
        @if($victimType === 'self')
            <div class="victim-badge self">
                <i class="fas fa-user"></i> Melaporkan untuk diri sendiri
            </div>
        @else
            <div class="victim-badge other">
                <i class="fas fa-users"></i> Melaporkan untuk orang lain
            </div>
        @endif
        <div style="font-size:12px; color:#aaa;">
            Langkah 2 dari 2 &mdash;
            <a href="{{ route('choose_victim') }}" style="color:#D891B5; text-decoration:none;">Ubah pilihan</a>
        </div>
    </div>

    <form action="{{ url('user/complaint/save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="victim_type" value="{{ $victimType }}">

        {{-- Card 1: Data Korban --}}
        <div class="card form-card">
            <div class="form-card-header">
                <div class="header-icon"><i class="fas fa-user-shield"></i></div>
                <h5>Data Korban</h5>
            </div>
            <div class="card-body p-4">

                {{-- Nama Korban --}}
                <div class="field-group">
                    <label class="form-label" for="nama_korban">
                        Nama Korban <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control @error('nama_korban') is-invalid @enderror"
                           id="nama_korban" name="nama_korban"
                           value="{{ old('nama_korban', $autoName) }}"
                           {{ $readonlyName ? 'readonly' : '' }}
                           placeholder="Masukkan nama lengkap korban" required>
                    @error('nama_korban') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if($readonlyName)
                        <div class="form-text auto-fill">
                            <i class="fas fa-magic me-1"></i>Terisi otomatis dari profil Anda
                        </div>
                    @endif
                </div>

                {{-- NIK Korban --}}
                <div class="field-group">
                    <label class="form-label" for="nik_korban">
                        NIK Korban
                        @if($victimType === 'self')
                            {{-- self: readonly, dari session --}}
                        @else
                            <span class="text-muted fw-normal" style="font-size:12px;">(opsional)</span>
                        @endif
                    </label>
                    <input type="text"
                           class="form-control @error('nik_korban') is-invalid @enderror"
                           id="nik_korban" name="nik_korban"
                           value="{{ old('nik_korban', $autoNik) }}"
                           {{ $victimType === 'self' ? 'readonly' : '' }}
                           maxlength="16"
                           inputmode="numeric"
                           placeholder="{{ $victimType === 'self' ? '' : 'Kosongkan jika tidak tahu NIK korban' }}">
                    @error('nik_korban') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if($victimType === 'self')
                        <div class="form-text auto-fill">
                            <i class="fas fa-magic me-1"></i>Terisi otomatis dari profil Anda
                        </div>
                    @else
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>Tidak perlu diisi jika NIK korban tidak diketahui
                        </div>
                    @endif
                </div>

                {{-- Tanggal Lahir & Jenis Kelamin --}}
                <div class="field-group">
                    <div class="row g-3">

                        {{-- Tanggal Lahir --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="tgl_lahir_korban">
                                Tanggal Lahir Korban <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                   class="form-control @error('tgl_lahir_korban') is-invalid @enderror"
                                   id="tgl_lahir_korban" name="tgl_lahir_korban"
                                   value="{{ old('tgl_lahir_korban', $autoBirth) }}"
                                   {{ $readonlyBirth ? 'readonly' : '' }}
                                   max="{{ date('Y-m-d', strtotime('-1 day')) }}"
                                   onchange="hitungUsia(this.value)"
                                   required>
                            <div id="usia-result" class="mt-1">
                                @if($autoBirth)
                                    <span class="usia-display">
                                        Usia: {{ \Carbon\Carbon::parse($autoBirth)->age }} tahun
                                    </span>
                                @endif
                            </div>
                            @error('tgl_lahir_korban') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @if($readonlyBirth)
                                <div class="form-text auto-fill">
                                    <i class="fas fa-magic me-1"></i>Terisi otomatis dari profil Anda
                                </div>
                            @endif
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="jenis_kelamin_korban">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            @if($readonlyGender)
                                {{-- Readonly: pakai input hidden + tampilan teks --}}
                                <input type="hidden" name="jenis_kelamin_korban" value="{{ $autoGender }}">
                                <input type="text" class="form-control" value="{{ ucfirst($autoGender) }}" readonly>
                                <div class="form-text auto-fill">
                                    <i class="fas fa-magic me-1"></i>Terisi otomatis dari profil Anda
                                </div>
                            @else
                                <select class="form-select @error('jenis_kelamin_korban') is-invalid @enderror"
                                        name="jenis_kelamin_korban" id="jenis_kelamin_korban" required>
                                    <option value="">- Pilih jenis kelamin -</option>
                                    <option value="perempuan" {{ old('jenis_kelamin_korban', $autoGender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    <option value="laki-laki" {{ old('jenis_kelamin_korban', $autoGender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                </select>
                                @error('jenis_kelamin_korban') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @endif
                        </div>

                    </div>
                </div>

                {{-- Nomor Telepon Korban --}}
                <div class="field-group">
                    <label class="form-label" for="nomor_korban">
                        Nomor Telepon Korban <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control @error('nomor_korban') is-invalid @enderror"
                           id="nomor_korban" name="nomor_korban"
                           value="{{ old('nomor_korban', $autoPhone) }}"
                           {{ $readonlyPhone ? 'readonly' : '' }}
                           placeholder="Contoh: 08123456789"
                           inputmode="numeric" maxlength="13" required>
                    @error('nomor_korban') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if($readonlyPhone)
                        <div class="form-text auto-fill">
                            <i class="fas fa-magic me-1"></i>Terisi otomatis dari profil Anda
                        </div>
                    @endif
                </div>

                {{-- Alamat Tinggal Korban --}}
                <div class="field-group">
                    <label class="form-label" for="alamat_korban_tinggal">
                        Alamat Tempat Tinggal Korban <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('alamat_korban_tinggal') is-invalid @enderror"
                              id="alamat_korban_tinggal" name="alamat_korban_tinggal" rows="2"
                              placeholder="Masukkan alamat lengkap tempat tinggal korban"
                              {{ $readonlyAddress ? 'readonly' : '' }}
                              required>{{ old('alamat_korban_tinggal', $autoAddress) }}</textarea>
                    @error('alamat_korban_tinggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if($readonlyAddress)
                        <div class="form-text auto-fill">
                            <i class="fas fa-magic me-1"></i>Terisi otomatis dari profil Anda
                        </div>
                    @endif
                </div>

            </div>
        </div>

        {{-- Card 2: Detail Kejadian --}}
        <div class="card form-card" style="animation-delay: 0.1s;">
            <div class="form-card-header">
                <div class="header-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <h5>Detail Kejadian</h5>
            </div>
            <div class="card-body p-4">

                <div class="field-group">
                    <label class="form-label" for="jenis_kekerasan">
                        Jenis Kekerasan <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('jenis_kekerasan') is-invalid @enderror"
                            name="jenis_kekerasan" id="jenis_kekerasan" required>
                        <option value="">- Pilih jenis kekerasan -</option>
                        <option value="fisik"        {{ old('jenis_kekerasan') == 'fisik'        ? 'selected' : '' }}>Kekerasan Fisik</option>
                        <option value="psikis"       {{ old('jenis_kekerasan') == 'psikis'       ? 'selected' : '' }}>Kekerasan Psikis</option>
                        <option value="seksual"      {{ old('jenis_kekerasan') == 'seksual'      ? 'selected' : '' }}>Kekerasan Seksual</option>
                        <option value="ekonomi"      {{ old('jenis_kekerasan') == 'ekonomi'      ? 'selected' : '' }}>Kekerasan Ekonomi</option>
                        <option value="penelantaran" {{ old('jenis_kekerasan') == 'penelantaran' ? 'selected' : '' }}>Penelantaran</option>
                    </select>
                    @error('jenis_kekerasan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="waktu_kejadian">
                        Waktu Kejadian <span class="text-danger">*</span>
                    </label>
                    <input type="datetime-local"
                           class="form-control @error('waktu_kejadian') is-invalid @enderror"
                           id="waktu_kejadian" name="waktu_kejadian"
                           max="{{ now()->format('Y-m-d\TH:i') }}"
                           value="{{ old('waktu_kejadian') }}" required>
                    @error('waktu_kejadian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="alamat_korban">
                        Lokasi / Alamat Kejadian <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('alamat_korban') is-invalid @enderror"
                              id="alamat_korban" name="alamat_korban" rows="2"
                              placeholder="Masukkan lokasi atau alamat tempat kejadian" required>{{ old('alamat_korban') }}</textarea>
                    @error('alamat_korban') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="contents_of_the_report">
                        Deskripsi / Kronologi Kejadian <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('contents_of_the_report') is-invalid @enderror"
                              id="contents_of_the_report" name="contents_of_the_report" rows="6"
                              placeholder="Jelaskan kronologi kejadian secara lengkap dan jelas..." required>{{ old('contents_of_the_report') }}</textarea>
                    @error('contents_of_the_report') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="photo">
                        Upload Bukti <span class="text-muted fw-normal">(opsional)</span>
                    </label>
                    <input class="form-control @error('photo') is-invalid @enderror"
                           type="file" id="photo" name="photo" accept="image/*">
                    <div class="form-text">Format: JPG, PNG — Maksimal 50MB</div>
                    @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

            </div>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-3 btn-actions"
             style="animation: fadeUp 0.6s ease 0.2s both;">
            <a href="{{ route('choose_victim') }}" class="btn-kembali d-inline-flex align-items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn-kirim d-inline-flex align-items-center gap-2">
                <i class="fas fa-paper-plane"></i> Kirim Laporan
            </button>
            <button type="reset" class="btn-reset d-inline-flex align-items-center gap-2"
                    onclick="document.getElementById('usia-result').innerHTML=''">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div>

    </form>
</div>

@endsection

@push('script')
<script>
    function hitungUsia(tglLahir) {
        const el = document.getElementById('usia-result');
        if (!tglLahir) { el.innerHTML = ''; return; }

        const lahir = new Date(tglLahir);
        const today = new Date();
        let usia = today.getFullYear() - lahir.getFullYear();
        const bulan = today.getMonth() - lahir.getMonth();
        if (bulan < 0 || (bulan === 0 && today.getDate() < lahir.getDate())) {
            usia--;
        }

        if (usia < 0 || usia > 120) {
            el.innerHTML = '<span style="color:#dc3545; font-size:12px;">Tanggal lahir tidak valid</span>';
        } else {
            el.innerHTML = '<span class="usia-display">Usia: ' + usia + ' tahun</span>';
        }
    }
</script>
@endpush