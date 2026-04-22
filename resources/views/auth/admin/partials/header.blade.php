<header id="topbar"
    class="fixed top-0 left-64 right-0 bg-white/90 backdrop-blur border-b px-6 py-3 flex justify-between items-center z-40 transition-all duration-300">

    <!-- LEFT -->
    <div class="flex items-center gap-4">

        <button id="vertical-menu-btn"
            class="p-2 rounded-lg hover:bg-gray-100 transition">

            <!-- MENU ICON -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>

        </button>

        <h1 class="text-lg font-semibold text-gray-700 hidden sm:block">
            @yield('title')
        </h1>

    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        <!-- NOTIF -->
        <button class="relative text-gray-500 hover:text-blue-600 transition">

            <!-- BELL ICON -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3c0 .386-.149.735-.405 1.005L4 17h5m6 0a3 3 0 11-6 0h6z" />
            </svg>

            <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- MESSAGE -->
        <button class="text-gray-500 hover:text-blue-600 transition">

            <!-- CHAT ICON -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.8-3.6A7.96 7.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>

        </button>

        <!-- PROFILE -->
        <div class="relative">

            <button id="profileBtn"
                class="flex items-center gap-3 hover:bg-gray-100 px-2 py-1 rounded-lg transition">

                <img src="{{ url('avatar/' . Auth::user()->photo) }}"
                    class="w-9 h-9 rounded-full object-cover border">

                <div class="text-left hidden sm:block">
                    <p class="text-sm font-semibold">
                        {{ Auth::user()->username }}
                    </p>
                    <p class="text-xs text-gray-400">
                        Administrator
                    </p>
                </div>

                <!-- ARROW ICON -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>

            </button>

            <!-- DROPDOWN -->
            <div id="profileMenu"
                class="hidden absolute right-0 mt-3 w-52 bg-white border rounded-xl shadow-lg overflow-hidden">

                <!-- PROFILE -->
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-100 transition">

                    <!-- USER ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    Profil
                </a>

                <!-- LOGOUT -->
                <button onclick="confirmLogout()"
                    class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-500 hover:bg-gray-100 transition">

                    <!-- LOGOUT ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V3" />
                    </svg>

                    Logout
                </button>

            </div>

        </div>

    </div>

</header>

<!-- LOGOUT FORM -->
<form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const btn = document.getElementById('profileBtn');
    const menu = document.getElementById('profileMenu');

    // toggle
    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    // click outside
    document.addEventListener('click', function(e) {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    // logout confirm
    function confirmLogout() {
        Swal.fire({
            title: 'Logout?',
            text: "Anda akan keluar dari sistem",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Logout'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
</script>