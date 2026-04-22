<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Login | Sistem Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 🔥 TAMBAHAN: SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="min-h-screen relative text-white">

    <!-- BACKGROUND -->
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/bg-login.jpeg') }}"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative z-10 min-h-screen flex">

        <!-- LEFT (TIDAK DIHAPUS) -->
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

        <!-- RIGHT -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6">

            <div class="w-full max-w-md">

                <div class="bg-white/10 backdrop-blur-2xl p-8 rounded-2xl shadow-2xl border border-white/20">

                    <!-- ICON -->
                    <div class="flex justify-center mb-6">
                        <div class="w-16 h-16 rounded-full bg-blue-500/20 flex items-center justify-center">

                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 11h14v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8z" />
                            </svg>

                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-center mb-2">
                        Selamat Datang Admin
                    </h2>

                    <p class="text-center text-gray-300 text-sm mb-6">
                        Silakan login untuk melanjutkan
                    </p>

                    <!-- FORM -->
                    <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
                        @csrf

                        <!-- USERNAME -->
                        <div class="relative">
                            <input type="text" name="username" value="{{ old('username') }}"
                                class="w-full px-4 py-2 pl-10 rounded-lg bg-white/20 border border-white/20 
                                focus:ring-2 focus:ring-blue-400 outline-none text-white"
                                placeholder="Username">

                            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-300"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.121 17.804A7.963 7.963 0 0112 15c2.21 0 4.21.896 5.879 2.343M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <!-- PASSWORD -->
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2 pl-10 pr-10 rounded-lg bg-white/20 border border-white/20 
                                focus:ring-2 focus:ring-blue-400 outline-none text-white"
                                placeholder="Password">

                            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-300"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 11h14v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8z" />
                            </svg>

                            <button type="button" onclick="togglePassword()"
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

                        <!-- 🔥 TAMBAHAN WARNING -->
                        @if(session('error'))
                        <p class="text-red-400 text-sm text-center">
                            {{ session('error') }}
                        </p>
                        @endif

                        <!-- LINK -->
                        <div class="flex justify-between items-center text-sm mt-2">

                            <a href="{{ route('admin.password.request') }}"
                                class="flex items-center gap-1 text-blue-400 hover:text-blue-300 transition">
                                Lupa Password?
                            </a>

                            <a href="{{ route('admin.register') }}"
                                class="flex items-center gap-1 text-gray-300 hover:text-white transition">
                                 + Daftar
                            </a>

                        </div>

                        <!-- BUTTON -->
                        <button type="submit"
                            class="w-full py-2 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg font-semibold hover:opacity-90 transition">
                            Masuk
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

    <!-- 🔥 POPUP ERROR -->
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc2626',
        });
    </script>
    @endif

</body>

</html>