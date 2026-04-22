<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Register | Sistem Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</head>

<body class="min-h-screen relative text-white">

    <!-- BACKGROUND -->
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/bg-login.jpeg') }}"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative z-10 min-h-screen flex">

        <!-- LEFT -->
        <div class="relative z-10 min-h-screen flex">

            <div class="hidden lg:flex w-1/2 flex-col justify-center px-16 space-y-6">

                <h1 class="text-5xl font-bold">
                    Sistem Manajeman LAPORPPA-KBB
                </h1>

                <p class="text-gray-200 text-lg">
                    Kelola laporan secara cepat, transparan, dan profesional.
                </p>

                <!-- FITUR -->
                <div class="flex gap-4 mt-6">

                    <div class="bg-white/10 backdrop-blur-xl p-5 rounded-xl w-44 border border-white/10">
                        <svg class="w-6 h-6 mb-2 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 11h14v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8z" />
                        </svg>
                        <p class="font-semibold">Aman</p>
                        <p class="text-sm text-gray-300">Data terlindungi</p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-xl p-5 rounded-xl w-44 border border-white/10">
                        <svg class="w-6 h-6 mb-2 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <p class="font-semibold">Cepat</p>
                        <p class="text-sm text-gray-300">Respon real-time</p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-xl p-5 rounded-xl w-44 border border-white/10">
                        <svg class="w-6 h-6 mb-2 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h18M9 21V10m6 11V10M4 10l1-6h14l1 6" />
                        </svg>
                        <p class="font-semibold">Transparan</p>
                        <p class="text-sm text-gray-300">Monitoring jelas</p>
                    </div>

                </div>

            </div>

            <div class="w-full lg:w-1/2 flex items-center justify-center px-6">

                <div class="w-full max-w-md">

                    <div class="bg-white/10 backdrop-blur-2xl p-8 rounded-2xl shadow-2xl border border-white/20 animate-[fadeUp_0.8s]">

                        <h2 class="text-2xl font-bold text-center mb-2">
                            Register Admin
                        </h2>

                        <p class="text-center text-gray-300 text-sm mb-6">
                            Buat akun admin baru
                        </p>

                        <!-- ERROR -->
                        @if ($errors->any())
                        <div class="bg-red-500/20 border border-red-400 text-red-200 p-3 rounded mb-4 text-sm">
                            {{ $errors->first() }}
                        </div>
                        @endif

                        <!-- SUCCESS -->
                        @if(session('success'))
                        <div class="bg-green-500/20 border border-green-400 text-green-200 p-3 rounded mb-4 text-sm">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('admin.register.save') }}" class="space-y-4" id="registerForm">
                            @csrf

                            <!-- NAMA -->
                            <input name="name" placeholder="Nama Lengkap"
                                class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/20 focus:ring-2 focus:ring-blue-400">

                            <!-- USERNAME -->
                            <input name="username" placeholder="Username"
                                class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/20 focus:ring-2 focus:ring-blue-400">

                            <!-- EMAIL -->
                            <input type="email" name="email" placeholder="Email"
                                class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/20 focus:ring-2 focus:ring-blue-400">

                            <!-- PASSWORD -->
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    placeholder="Password"
                                    class="w-full px-4 py-2 pr-10 rounded-lg bg-white/20 border border-white/20 focus:ring-2 focus:ring-blue-400">

                                <button type="button" onclick="togglePassword('password')"
                                    class="absolute right-3 top-2.5 text-gray-300 hover:text-white transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2"
                                            d="M15 12A3 3 0 119 12a3 3 0 016 0z" />
                                        <path stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>

                                </button>
                            </div>

                            <!-- KONFIRMASI -->
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Konfirmasi Password"
                                    class="w-full px-4 py-2 pr-10 rounded-lg bg-white/20 border border-white/20 focus:ring-2 focus:ring-blue-400">

                                <button type="button" onclick="togglePassword('password_confirmation')"
                                    class="absolute right-3 top-2.5 text-gray-300 hover:text-white transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-width="2"
                                            d="M15 12A3 3 0 119 12a3 3 0 016 0z" />
                                        <path stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>

                                </button>
                            </div>

                            <!-- VALIDASI -->
                            <div class="text-xs space-y-1">
                                <p id="lengthCheck" class="text-gray-300">• Minimal 6 karakter</p>
                                <p id="matchCheck" class="text-gray-300">• Password harus sama</p>
                            </div>

                            <!-- BUTTON -->
                            <button type="submit" id="btnRegister"
                                class="w-full py-2 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg font-semibold hover:scale-[1.02]">
                                Daftar
                            </button>

                        </form>

                        <p class="text-center text-sm text-gray-300 mt-4">
                            Sudah punya akun?
                            <a href="{{ route('admin.login') }}" class="text-blue-400 hover:underline">
                                Login
                            </a>
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <script>
            function togglePassword(id) {
                const input = document.getElementById(id);
                input.type = input.type === 'password' ? 'text' : 'password';
            }

            // realtime validation
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');

            const lengthCheck = document.getElementById('lengthCheck');
            const matchCheck = document.getElementById('matchCheck');

            function validatePassword() {

                // panjang
                if (password.value.length >= 6) {
                    lengthCheck.classList.replace('text-gray-300', 'text-green-400');
                } else {
                    lengthCheck.classList.replace('text-green-400', 'text-gray-300');
                }

                // match
                if (password.value !== "" && password.value === confirmPassword.value) {
                    matchCheck.classList.replace('text-gray-300', 'text-green-400');
                } else {
                    matchCheck.classList.replace('text-green-400', 'text-gray-300');
                }
            }

            password.addEventListener('keyup', validatePassword);
            confirmPassword.addEventListener('keyup', validatePassword);

            // loading button
            document.getElementById('registerForm').addEventListener('submit', function() {
                const btn = document.getElementById('btnRegister');
                btn.innerHTML = 'Loading...';
                btn.disabled = true;
            });
        </script>

</body>

</html>