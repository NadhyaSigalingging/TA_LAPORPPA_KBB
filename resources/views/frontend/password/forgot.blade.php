@extends('frontend.layouts.auth')

@section('title', 'Lupa Password — LAPORPPA-KBB')

@section('form')

<div class="auth-form-title">Lupa <span class="accent">Password?</span></div>
<p class="auth-form-subtitle">
    Masukkan email yang terdaftar. Kami akan mengirimkan link untuk mereset password Anda.
</p>

{{-- Info box --}}
<div style="
    display: flex; align-items: flex-start; gap: 12px;
    background: rgba(201,75,120,0.06);
    border: 1px solid rgba(201,75,120,0.18);
    border-radius: 10px;
    padding: 14px 16px;
    margin-bottom: 24px;
    font-size: 13px;
    color: var(--text-muted);
    line-height: 1.6;
">
    <i class="fas fa-info-circle" style="color: var(--pink); font-size: 15px; flex-shrink:0; margin-top:1px;"></i>
    <span>Link reset password hanya berlaku selama <strong style="color:var(--text-main);">60 menit</strong> setelah dikirim.</span>
</div>

<form action="{{ route('password.email') }}" method="POST">
    @csrf

    {{-- Email --}}
    <div class="auth-field">
        <label class="auth-label" for="email">
            <i class="fas fa-envelope"></i> Alamat Email
        </label>
        <input
            type="email"
            class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
            name="email" id="email"
            placeholder="Masukkan email yang terdaftar"
            value="{{ old('email') }}"
            required>
        @error('email')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
        <p class="auth-hint">Kami akan mengirimkan link reset password ke email ini.</p>
    </div>

    <button type="submit" class="btn-auth-submit">
        <i class="fas fa-paper-plane"></i> Kirim Link Reset Password
    </button>
</form>

<div class="auth-switch">
    Ingat password Anda?
    <a href="{{ route('user_login') }}"><i class="fas fa-arrow-left" style="font-size:11px;"></i> Kembali Login</a>
</div>

@endsection