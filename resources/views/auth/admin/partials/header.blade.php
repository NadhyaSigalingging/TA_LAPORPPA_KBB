<header id="topbar"
    class="fixed top-0 left-64 right-0 bg-white/90 backdrop-blur border-b px-6 py-3 flex justify-between items-center z-40 transition-all duration-300">

    <!-- ================= LEFT ================= -->
    <div class="flex items-center gap-4">

        <!-- TOGGLE -->
        <button id="vertical-menu-btn"
            class="text-xl p-2 rounded-lg hover:bg-gray-100 transition">
            ☰
        </button>

        <!-- TITLE -->
        <h1 class="text-lg font-semibold text-gray-700 hidden sm:block">
            @yield('title')
        </h1>


    </div>

    <!-- ================= RIGHT ================= -->
    <div class="flex items-center gap-4">

        <!-- ICON -->
        <button class="relative text-gray-500 hover:text-blue-600 transition">
            <i class="bx bx-bell text-xl"></i>
            <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <button class="text-gray-500 hover:text-blue-600 transition">
            <i class="bx bx-message-dots text-xl"></i>
        </button>

        <!-- PROFILE DROPDOWN -->
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

                <i class="bx bx-chevron-down text-gray-400"></i>

            </button>

            <!-- DROPDOWN -->
            <div id="profileMenu"
                class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg overflow-hidden">

                <a href="#"
                    class="block px-4 py-2 text-sm hover:bg-gray-100">
                    Profil
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</header>