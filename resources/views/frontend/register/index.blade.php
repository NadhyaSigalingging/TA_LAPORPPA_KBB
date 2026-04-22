@extends('frontend.layouts.auth')

@section('title', 'Daftar — LAPORPPA-KBB')

@section('form')

<div class="auth-form-title">Buat <span class="accent">Akun</span></div>
<p class="auth-form-subtitle">Daftarkan diri untuk mulai membuat laporan secara online.</p>

<form action="{{ url('user/register/save') }}" method="POST">
    @csrf

    {{-- NIK --}}
    <div class="auth-field">
        <label class="auth-label" for="nik">
            <i class="fas fa-id-card"></i> NIK <span class="req">*</span>
        </label>
        <input
            type="text"
            class="auth-input {{ $errors->has('nik') ? 'is-invalid' : '' }}"
            name="nik" id="nik"
            placeholder="Masukkan 16 digit NIK"
            value="{{ old('nik') }}"
            maxlength="16"
            inputmode="numeric"
            required>
        <div class="auth-hint">Nomor Induk Kependudukan (16 digit angka)</div>
        @error('nik')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Nama Lengkap --}}
    <div class="auth-field">
        <label class="auth-label" for="name">
            <i class="fas fa-user"></i> Nama Lengkap <span class="req">*</span>
        </label>
        <input
            type="text"
            class="auth-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
            name="name" id="name"
            placeholder="Masukkan nama lengkap"
            value="{{ old('name') }}"
            required>
        @error('name')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Username --}}
    <div class="auth-field">
        <label class="auth-label" for="username">
            <i class="fas fa-at"></i> Username <span class="req">*</span>
        </label>
        <input
            type="text"
            class="auth-input {{ $errors->has('username') ? 'is-invalid' : '' }}"
            name="username" id="username"
            placeholder="Pilih username unik"
            value="{{ old('username') }}"
            required>
        @error('username')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Email --}}
    <div class="auth-field">
        <label class="auth-label" for="email">
            <i class="fas fa-envelope"></i> Email <span class="req">*</span>
        </label>
        <input
            type="email"
            class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
            name="email" id="email"
            placeholder="Masukkan email aktif"
            value="{{ old('email') }}"
            required>
        @error('email')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Password --}}
    <div class="auth-field">
        <label class="auth-label" for="password">
            <i class="fas fa-lock"></i> Password <span class="req">*</span>
        </label>
        <div class="auth-input-group">
            <input
                type="password"
                class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                name="password" id="password"
                placeholder="Minimal 6 karakter"
                required>
            <button type="button" class="auth-toggle-pw" data-target="password">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        <div class="auth-hint">Minimal 6 karakter</div>
        @error('password')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Konfirmasi Password --}}
    <div class="auth-field">
        <label class="auth-label" for="password_confirmation">
            <i class="fas fa-lock"></i> Konfirmasi Password <span class="req">*</span>
        </label>
        <div class="auth-input-group">
            <input
                type="password"
                class="auth-input"
                name="password_confirmation"
                id="password_confirmation"
                placeholder="Ulangi password"
                required>
            <button type="button" class="auth-toggle-pw" data-target="password_confirmation">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>

    <button type="submit" class="btn-auth-submit">
        <i class="fas fa-user-plus"></i> Buat Akun
    </button>

</form>

<div class="auth-switch">
    Sudah punya akun?
    <a href="{{ url('user/login') }}">Masuk di sini</a>
</div>

@endsection

@push('script')
<script>
document.querySelectorAll('.auth-toggle-pw').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const input = document.getElementById(this.dataset.target);
        const icon  = this.querySelector('i');
        input.type  = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
});
</script>
@endpush