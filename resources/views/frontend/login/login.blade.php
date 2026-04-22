@extends('frontend.layouts.auth')

@section('title', 'Masuk — LAPORPPA-KBB')

@section('form')

<div class="auth-form-title">Selamat <span class="accent">Datang</span></div>
<p class="auth-form-subtitle">Masuk ke akun Anda untuk membuat atau memantau laporan.</p>

<form action="{{ url('user/login/cek') }}" method="POST">
    @csrf

    {{-- Username / Email --}}
    <div class="auth-field">
        <label class="auth-label" for="login">
            <i class="fas fa-user"></i> Username atau Email
        </label>
        <input
            type="text"
            class="auth-input {{ $errors->has('login') ? 'is-invalid' : '' }}"
            name="login" id="login"
            placeholder="Masukkan username atau email"
            value="{{ old('login') }}"
            required>
        @error('login')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Password --}}
    <div class="auth-field">
        <label class="auth-label" for="password">
            <i class="fas fa-lock"></i> Password
        </label>
        <div class="auth-input-group">
            <input
                type="password"
                class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                name="password" id="password"
                placeholder="Masukkan password"
                required>
            <button type="button" class="auth-toggle-pw" data-target="password">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        @error('password')
            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
        @enderror
    </div>

    {{-- Lupa password --}}
    <div class="auth-forgot">
        <a href="{{ route('password.request') }}">
            <i class="fas fa-lock-open" style="font-size:10px;"></i> Lupa Password?
        </a>
    </div>

    <button type="submit" class="btn-auth-submit">
        <i class="fas fa-sign-in-alt"></i> Masuk
    </button>

</form>

<div class="auth-switch">
    Belum punya akun?
    <a href="{{ url('user/register') }}">Daftar di sini</a>
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