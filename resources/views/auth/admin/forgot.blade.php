<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SWEET ALERT -->
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

        <div class="bg-white/10 backdrop-blur-xl p-8 rounded-2xl w-full max-w-md border border-white/20">

            <h2 class="text-2xl font-bold text-center mb-2">
                Lupa Password
            </h2>

            <p class="text-center text-gray-300 text-sm mb-6">
                Masukkan email untuk menerima link reset
            </p>

            <!-- FORM -->
            <form method="POST" action="{{ route('admin.password.email') }}">
                @csrf

                <input type="email" name="email" required
                    class="w-full mb-4 px-4 py-2 rounded-lg bg-white/20 border border-white/20 text-white 
                    focus:ring-2 focus:ring-blue-400 outline-none"
                    placeholder="Masukkan email">

                <button
                    class="w-full bg-blue-500 hover:bg-blue-600 py-2 rounded-lg font-semibold transition">
                    Kirim Link Reset
                </button>
            </form>

            <!-- BACK TO LOGIN -->
            <div class="mt-5 text-center">
                <a href="{{ route('admin.login') }}"
                    class="inline-flex items-center gap-2 text-sm text-gray-300 hover:text-white transition">

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

    <!-- POPUP SUCCESS -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
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