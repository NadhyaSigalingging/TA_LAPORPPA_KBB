<!doctype html>
<html lang="en">

@include('auth.admin.partials.head')

<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">

        <!-- ================= SIDEBAR ================= -->
        <aside id="sidebar"
            class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-blue-900 to-blue-700 text-white flex flex-col transition-all duration-300 z-50 -translate-x-full md:translate-x-0">

            <!-- LOGO -->
            <div class="p-5 text-lg font-bold border-b border-white/10 flex items-center justify-between">
                <span class="logo-text tracking-wide">LAPORPPA-KBB</span>
            </div>

            <!-- MENU -->
            <nav class="p-3 space-y-2 flex-1 text-sm">

                <!-- DASHBOARD -->
                <a href="{{ route('auth.admin.dashboard.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('auth.admin.dashboard.*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }}">
                    <i class="bx bx-home text-lg"></i>
                    <span class="menu-text">Dashboard</span>
                </a>

                <!-- PENGADUAN -->
                <a href="{{ route('auth.admin.pengaduan.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('auth.admin.pengaduan.*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }}">
                    <i class="bx bx-message text-lg"></i>
                    <span class="menu-text">Pengaduan</span>
                </a>

                <!-- MASYARAKAT -->
                <a href="{{ route('auth.admin.masyarakat.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('auth.admin.masyarakat.*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }}">
                    <i class="bx bx-group text-lg"></i>
                    <span class="menu-text">Masyarakat</span>
                </a>

                <!-- KONTEN -->
                <a href="{{ route('auth.admin.content.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('auth.admin.content.*') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }}">
                    <i class="bx bx-file text-lg"></i>
                    <span class="menu-text">Konten</span>
                </a>

                <!-- APPROVAL -->
                <a href="{{ route('auth.admin.approval') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                {{ request()->routeIs('auth.admin.approval') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10' }}">
                    <i class="bx bx-user-check text-lg"></i>
                    <span class="menu-text">Manage Admin</span>
                </a>

            </nav>

            <!-- FOOTER -->
            <div class="p-4 text-xs text-gray-300 border-t border-white/10">
                © 2026 Sistem Pengaduan
            </div>

        </aside>

        <!-- ================= OVERLAY ================= -->
        <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-40 md:hidden"></div>

        <!-- ================= MAIN ================= -->
        <div id="mainContent" class="flex-1 md:ml-64 transition-all duration-300">

            @include('auth.admin.partials.header')

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
            const topbar = document.getElementById("topbar");
            const overlay = document.getElementById("overlay");

            let collapsed = false;

            btn.addEventListener("click", function() {

                // MOBILE
                if (window.innerWidth < 768) {
                    sidebar.classList.toggle("-translate-x-full");
                    overlay.classList.toggle("hidden");
                    return;
                }

                // DESKTOP
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

            // CLOSE MOBILE
            overlay.addEventListener("click", function() {
                sidebar.classList.add("-translate-x-full");
                overlay.classList.add("hidden");
            });

        });
    </script>

    @stack('script')

</body>

</html>