@extends('frontend.layouts.auth')

@section('title', 'Reset Password — LAPORPPA-KBB')

@section('form')

<div class="auth-form-title">Reset <span class="accent">Password</span></div>
<p class="auth-form-subtitle">
    Buat password baru yang kuat untuk mengamankan akun Anda.
</p>

<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    {{-- Email (readonly) --}}
    <div class="auth-field">
        <label class="auth-label" for="email_display">
            <i class="fas fa-envelope"></i> Email
        </label>
        <input
            type="email"
            class="auth-input"
            id="email_display"
            value="{{ $email }}"
            readonly
            style="background: rgba(201,75,120,0.04); color: var(--text-soft); cursor: not-allowed;">
    </div>

    {{-- Password Baru --}}
    <div class="auth-field">
        <label class="auth-label" for="password">
            <i class="fas fa-lock"></i> Password Baru
            <span class="req">*</span>
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
        @error('password')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
        <p class="auth-hint">Gunakan kombinasi huruf, angka, dan simbol untuk keamanan lebih baik.</p>
    </div>

    {{-- Konfirmasi Password --}}
    <div class="auth-field">
        <label class="auth-label" for="password_confirmation">
            <i class="fas fa-lock-open"></i> Konfirmasi Password Baru
            <span class="req">*</span>
        </label>
        <div class="auth-input-group">
            <input
                type="password"
                class="auth-input"
                name="password_confirmation" id="password_confirmation"
                placeholder="Ulangi password baru"
                required>
            <button type="button" class="auth-toggle-pw" data-target="password_confirmation">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>

    <button type="submit" class="btn-auth-submit">
        <i class="fas fa-check"></i> Reset Password
    </button>
</form>

<div class="auth-switch">
    <a href="{{ route('user_login') }}">
        <i class="fas fa-arrow-left" style="font-size:11px;"></i> Kembali Login
    </a>
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