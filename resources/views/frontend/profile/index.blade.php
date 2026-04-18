@extends('frontend.layouts.app')
@section('title', 'Profil Saya - LAPORPPA-KBB')

@section('css')
<style>
    .profile-card {
        border-radius: 16px !important;
        border: 1.5px solid rgba(216,145,181,0.15) !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important;
        overflow: hidden;
        animation: fadeUp 0.6s ease both;
        margin-bottom: 24px;
    }
    .profile-card-header {
        background: linear-gradient(135deg, #E9A5C5, #D891B5);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .profile-card-header .header-icon {
        width: 38px; height: 38px;
        background: rgba(255,255,255,0.3);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px; color: #1a1a2e;
    }
    .profile-card-header h5 {
        margin: 0; font-size: 15px; font-weight: 700; color: #1a1a2e;
    }

    .avatar-wrapper {
        position: relative;
        width: 110px;
        height: 110px;
        margin: 0 auto 16px;
    }
    .avatar-wrapper img {
        width: 110px; height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #D891B5;
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: 4px; right: 4px;
        width: 30px; height: 30px;
        background: #D891B5;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 12px;
        cursor: pointer;
        border: 2px solid #fff;
        transition: background 0.2s;
    }
    .avatar-edit-btn:hover { background: #B5618E; }

    .form-label {
        font-weight: 600;
        font-size: 13.5px;
        color: #1a1a2e;
        margin-bottom: 6px;
    }
    .form-control, .form-select {
        border-radius: 9px !important;
        border: 1.5px solid #ddd !important;
        font-size: 14px;
        padding: 10px 14px;
        transition: all 0.2s;
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
    .form-text { font-size: 12px; color: #999; margin-top: 5px; }

    /* Badge kelengkapan profil */
    .completeness-bar {
        height: 8px;
        border-radius: 50px;
        background: #f0e8f4;
        overflow: hidden;
        margin-top: 8px;
    }
    .completeness-fill {
        height: 100%;
        border-radius: 50px;
        background: linear-gradient(135deg, #D891B5, #B5618E);
        transition: width 0.6s ease;
    }
    .field-group {
        padding: 16px 0;
        border-bottom: 1px solid rgba(216,145,181,0.1);
    }
    .field-group:last-child { border-bottom: none; padding-bottom: 0; }

   

    .btn-simpan {
        background: linear-gradient(135deg, #D891B5, #B5618E);
        color: #fff; border: none; border-radius: 50px;
        padding: 11px 32px; font-size: 14.5px; font-weight: 600;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(184,97,142,0.3);
    }
    .btn-simpan:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(184,97,142,0.42);
        color: #fff;
    }

    .info-tip {
        background: rgba(216,145,181,0.08);
        border: 1.5px solid rgba(216,145,181,0.2);
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        color: #B5618E;
        margin-bottom: 24px;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')

<x-hero
    title="Profil Saya"
    subtitle="Lengkapi data profil untuk mempermudah proses pelaporan"
/>

<div class="container pb-5">

    @php
        $fields = [
            $society->birth_date,
            $society->gender,
            $society->phone_number,
            $society->address,
            $society->photo && $society->photo !== 'default.png' ? true : null,
        ];
        $filled = collect($fields)->filter()->count();
        $percent = round(($filled / count($fields)) * 100);
    @endphp

    <div class="info-tip" style="animation: fadeUp 0.5s ease both;">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Kelengkapan profil: {{ $percent }}%</strong> —
        @if($percent < 100)
            Lengkapi data tambahan agar data korban terisi otomatis saat membuat laporan.
        @else
            Profil Anda sudah lengkap! Data korban akan terisi otomatis saat membuat laporan.
        @endif
        <div class="completeness-bar mt-2">
            <div class="completeness-fill" style="width: {{ $percent }}%"></div>
        </div>
    </div>

    <form action="{{ route('user_profile_update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card profile-card">
            <div class="profile-card-header">
                <div class="header-icon"><i class="fas fa-id-card"></i></div>
                <h5>Data Pribadi</h5>
            </div>
            <div class="card-body p-4">

                <div class="text-center mb-4">
                    <div class="avatar-wrapper">
                        <img src="{{ url('avatar_society/' . $society->photo) }}"
                             alt="Foto Profil"
                             id="previewPhoto">
                        <label for="photo" class="avatar-edit-btn" title="Ganti foto">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" name="photo" id="photo"
                               accept="image/*" class="d-none"
                               onchange="previewFoto(this)">
                    </div>
                    <div style="font-size:12px; color:#999;">
                        Klik ikon kamera untuk ganti foto<br>
                        <span style="font-size:11px;">Format JPG/PNG, maks. 2MB</span>
                    </div>
                    @error('photo')
                        <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="nik">
                        <i class="fas fa-id-card me-1"></i>NIK
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                        class="form-control @error('nik') is-invalid @enderror"
                        name="nik" id="nik"
                        value="{{ old('nik', $society->nik) }}"
                        maxlength="16"
                        inputmode="numeric"
                        placeholder="Masukkan 16 digit NIK"
                        required>
                    <div class="form-text">
                        <i class="fas fa-exclamation-triangle me-1" style="color:#f59e0b;"></i>
                        Jika NIK diubah, semua laporan Anda akan ikut diperbarui secara otomatis
                    </div>
                    @error('nik')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="username">
                        <i class="fas fa-at me-1"></i>Username
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        name="username" id="username"
                        value="{{ old('username', $society->username) }}"
                        placeholder="Masukkan username"
                        required>
                    @error('username')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope me-1"></i>Email
                        <span class="text-danger">*</span>
                    </label>
                    <input type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" id="email"
                        value="{{ old('email', $society->email) }}"
                        placeholder="Masukkan email aktif"
                        required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="name">
                        <i class="fas fa-user me-1"></i>Nama Lengkap
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" id="name"
                           value="{{ old('name', $society->name) }}"
                           placeholder="Masukkan nama lengkap"
                           required>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="card profile-card" style="animation-delay: 0.1s;">
            <div class="profile-card-header">
                <div class="header-icon"><i class="fas fa-user-edit"></i></div>
                <h5>Data Tambahan <span style="font-size:12px; font-weight:400; opacity:0.8;">(untuk auto-fill laporan)</span></h5>
            </div>
            <div class="card-body p-4">

                <div class="field-group">
                    <label class="form-label" for="birth_date">
                        <i class="fas fa-birthday-cake me-1"></i>Tanggal Lahir
                    </label>
                    <input type="date"
                           class="form-control @error('birth_date') is-invalid @enderror"
                           name="birth_date" id="birth_date"
                           value="{{ old('birth_date', $society->birth_date ? $society->birth_date->format('Y-m-d') : '') }}"
                           max="{{ date('Y-m-d', strtotime('-1 day')) }}">
                    @if($society->birth_date)
                        <div class="form-text">
                            Usia saat ini:
                            <strong>{{ \Carbon\Carbon::parse($society->birth_date)->age }} tahun</strong>
                        </div>
                    @endif
                    @error('birth_date')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="gender">
                        <i class="fas fa-venus-mars me-1"></i>Jenis Kelamin
                    </label>
                    <select class="form-select @error('gender') is-invalid @enderror"
                            name="gender" id="gender">
                        <option value="">- Pilih jenis kelamin -</option>
                        <option value="perempuan" {{ old('gender', $society->gender) == 'perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                        <option value="laki-laki" {{ old('gender', $society->gender) == 'laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="phone_number">
                        <i class="fas fa-phone me-1"></i>Nomor Telepon
                    </label>
                    <input type="text"
                           class="form-control @error('phone_number') is-invalid @enderror"
                           name="phone_number" id="phone_number"
                           value="{{ old('phone_number', $society->phone_number) }}"
                           placeholder="Contoh: 081234567890"
                           inputmode="numeric"
                           maxlength="13">
                    @error('phone_number')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="form-label" for="address">
                        <i class="fas fa-home me-1"></i>Alamat Tempat Tinggal
                    </label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              name="address" id="address"
                              rows="3"
                              placeholder="Masukkan alamat lengkap tempat tinggal">{{ old('address', $society->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div style="animation: fadeUp 0.6s ease 0.2s both;">
            <button type="submit" class="btn-simpan">
                <i class="fas fa-save me-2"></i>Simpan Perubahan
            </button>
        </div>

    </form>
</div>

@endsection

@push('script')
<script>
    function previewFoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewPhoto').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush