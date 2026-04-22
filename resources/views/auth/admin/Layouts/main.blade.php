<!doctype html>
<html lang="en">

@include('auth.admin.partials.head')

<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">

        <!-- ================= SIDEBAR ================= -->
        <aside id="sidebar"
            class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-blue-900 to-blue-700 text-white flex flex-col transition-all duration-300 z-50">

            <!-- LOGO -->
            <div class="p-5 text-lg font-bold border-b border-white/10">
                <span class="logo-text">LAPORPPA-KBB</span>
            </div>

            <!-- MENU -->
            <nav class="p-3 space-y-2 flex-1">

                <a href="{{ route('auth.admin.dashboard.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10
                {{ request()->routeIs('auth.admin.dashboard.*') ? 'bg-white/20' : '' }}">
                    <i class="bx bx-home text-lg"></i>
                    <span class="menu-text">Dashboard</span>
                </a>

                <a href="{{ route('auth.admin.pengaduan.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10">
                    <i class="bx bx-message text-lg"></i>
                    <span class="menu-text">Pengaduan</span>
                </a>

                <a href="{{ route('auth.admin.masyarakat.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10">
                    <i class="bx bx-group text-lg"></i>
                    <span class="menu-text">Masyarakat</span>
                </a>

                <a href="{{ route('auth.admin.content.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10">
                    <i class="bx bx-file text-lg"></i>
                    <span class="menu-text">Konten</span>
                </a>

            </nav>

        </aside>

        <!-- ================= OVERLAY (MOBILE) ================= -->
        <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-40"></div>

        <!-- ================= MAIN ================= -->
        <div id="mainContent" class="flex-1 ml-64 transition-all duration-300">

            @include('auth.admin.partials.header') {{-- WAJIB ADA id="topbar" di header --}}

            <main class="mt-16 p-6">
                @yield('content')
            </main>

        </div>

    </div>

    <!-- ================= SCRIPT ================= -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const btn = document.getElementById("vertical-menu-btn");
            const sidebar = document.getElementById("sidebar");
            const main = document.getElementById("mainContent");
            const topbar = document.getElementById("topbar"); // dari header
            const overlay = document.getElementById("overlay");

            let collapsed = false;

            btn.addEventListener("click", function() {

                // ================= MOBILE =================
                if (window.innerWidth < 768) {
                    sidebar.classList.toggle("-translate-x-full");
                    overlay.classList.toggle("hidden");
                    return;
                }

                // ================= DESKTOP =================
                collapsed = !collapsed;

                if (collapsed) {
                    sidebar.classList.replace("w-64", "w-20");
                    main.classList.replace("ml-64", "ml-20");
                    topbar.classList.replace("left-64", "left-20");

                    document.querySelectorAll(".menu-text").forEach(el => el.classList.add("hidden"));
                    document.querySelector(".logo-text").classList.add("hidden");

                } else {
                    sidebar.classList.replace("w-20", "w-64");
                    main.classList.replace("ml-20", "ml-64");
                    topbar.classList.replace("left-20", "left-64");

                    document.querySelectorAll(".menu-text").forEach(el => el.classList.remove("hidden"));
                    document.querySelector(".logo-text").classList.remove("hidden");
                }

            });

            // ================= CLOSE MOBILE =================
            overlay.addEventListener("click", function() {
                sidebar.classList.add("-translate-x-full");
                overlay.classList.add("hidden");
            });

        });
    </script>

    @stack('script')

</body>

</html>