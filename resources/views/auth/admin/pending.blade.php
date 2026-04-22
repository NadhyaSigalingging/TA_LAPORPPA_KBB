<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Menunggu Persetujuan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative text-white">

    <!-- BACKGROUND -->
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/bg-login.jpeg') }}"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center">

        <div class="bg-white/10 backdrop-blur-xl p-8 rounded-2xl w-full max-w-md border border-white/20 text-center">

            <!-- ICON -->
            <div class="mb-4 flex justify-center">
                <svg class="w-16 h-16 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3" />
                    <circle cx="12" cy="12" r="10" />
                </svg>
            </div>

            <!-- TITLE -->
            <h2 class="text-2xl font-bold mb-2">
                Menunggu Persetujuan
            </h2>

            <p class="text-gray-300 text-sm mb-6">
                Akun Anda sedang dalam proses verifikasi oleh admin.
                <br>Silakan tunggu hingga disetujui.
            </p>

            <!-- BUTTON -->
            <a href="{{ route('admin.login') }}"
                class="inline-block bg-blue-500 hover:bg-blue-600 px-6 py-2 rounded-lg font-semibold transition">
                Kembali ke Login
            </a>

        </div>

    </div>

</body>

</html>