<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Reset Password</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="min-h-screen relative text-white">

    <!-- BACKGROUND -->
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/bg-login.jpeg') }}"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center">

        <div class="bg-white/10 backdrop-blur-xl p-8 rounded-2xl w-full max-w-md border border-white/20 shadow-xl">

            <!-- ICON HEADER -->
            <div class="flex justify-center mb-5">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-blue-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2"
                            d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                        <path stroke-width="2"
                            d="M5 11h14v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8z" />
                    </svg>
                </div>
            </div>

            <!-- TITLE -->
            <h2 class="text-2xl font-bold text-center mb-2">
                Reset Password
            </h2>

            <p class="text-center text-gray-300 text-sm mb-6">
                Masukkan password baru untuk akun Anda
            </p>

            <!-- FORM -->
            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <!-- EMAIL -->
                <div class="relative mb-4">
                    <input type="email" name="email" value="{{ $email }}"
                        class="w-full px-4 py-2 pl-10 rounded-lg bg-white/20 border border-white/20 text-white"
                        readonly>

                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M16 12H8m0 0l4-4m-4 4l4 4" />
                    </svg>
                </div>

                <!-- PASSWORD -->
                <div class="relative mb-4">
                    <input type="password" name="password" id="password"
                        placeholder="Password Baru"
                        class="w-full px-4 py-2 pl-10 pr-10 rounded-lg bg-white/20 border border-white/20 text-white 
                        focus:ring-2 focus:ring-blue-400 outline-none">

                    <!-- LOCK ICON -->
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                        <path d="M5 11h14v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8z" />
                    </svg>

                    <!-- EYE ICON -->
                    <button type="button" onclick="togglePassword('password')"
                        class="absolute right-3 top-2.5 text-gray-300 hover:text-white">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-width="2"
                                d="M15 12A3 3 0 119 12a3 3 0 016 0z" />
                            <path stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                    </button>
                </div>

                <!-- CONFIRM -->
                <div class="relative mb-4">
                    <input type="password" name="password_confirmation" id="confirm"
                        placeholder="Konfirmasi Password"
                        class="w-full px-4 py-2 pl-10 pr-10 rounded-lg bg-white/20 border border-white/20 text-white 
                        focus:ring-2 focus:ring-blue-400 outline-none">

                    <!-- LOCK ICON -->
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                        <path d="M5 11h14v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8z" />
                    </svg>

                    <!-- EYE ICON -->
                    <button type="button" onclick="togglePassword('confirm')"
                        class="absolute right-3 top-2.5 text-gray-300 hover:text-white">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-width="2"
                                d="M15 12A3 3 0 119 12a3 3 0 016 0z" />
                            <path stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                    </button>
                </div>

                <!-- BUTTON -->
                <button
                    class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 py-2 rounded-lg font-semibold hover:opacity-90 transition">
                    Reset Password
                </button>

            </form>

            <!-- BACK -->
            <div class="mt-5 text-center">
                <a href="{{ route('admin.login') }}"
                    class="inline-flex items-center gap-1 text-sm text-gray-300 hover:text-white transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2"
                            d="M15 19l-7-7 7-7" />
                    </svg>

                    Kembali ke Login
                </a>
            </div>

        </div>

    </div>

    <!-- SCRIPT -->
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

    <!-- POPUP SUCCESS -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('
            success ') }}',
            confirmButtonColor: '#2563eb',
        });
    </script>
    @endif

    <!-- POPUP ERROR -->
    @if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#dc2626',
        });
    </script>
    @endif

</body>

</html>