<!doctype html>
<html lang="en">

@include('auth.admin.partials.head')

<body>

    <div id="layout-wrapper">

        @include('auth.admin.partials.header')

        <div class="vertical-menu">
            <div data-simplebar class="h-100">

                <div id="sidebar-menu">

                    <ul class="metismenu list-unstyled" id="side-menu">

                        <li class="menu-title">Menu Utama</li>

                        <li>
                            <a href="{{ route('auth.admin.dashboard.index') }}"
                                class="{{ request()->routeIs('auth.admin.dashboard.*') ? 'active' : '' }}"
                                data-title="Dashboard">
                                <i class="bx bx-home-circle"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('auth.admin.pengaduan.index') }}"
                                class="{{ request()->routeIs('auth.admin.pengaduan.*') ? 'active' : '' }}"
                                data-title="Pengaduan">
                                <i class="bx bx-message-square-dots"></i>
                                <span>Pengaduan</span>
                            </a>
                        </li>

                        @if(Auth::user()->level_id == '1')

                            <li>
                                <a href="{{ route('auth.admin.masyarakat.index') }}"
                                    class="{{ request()->routeIs('auth.admin.masyarakat.*') ? 'active' : '' }}"
                                    data-title="Masyarakat">
                                    <i class="bx bx-group"></i>
                                    <span>Masyarakat</span>
                                </a>
                            </li>

                            <li class="menu-title">Administrator</li>

                            <li>
                                <a href="javascript:void(0);" class="has-arrow" data-title="User">
                                    <i class="bx bx-user"></i>
                                    <span>Manajemen User</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('admin/report/day') }}" data-title="Laporan">
                                    <i class="bx bx-bar-chart-alt-2"></i>
                                    <span>Laporan</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('auth.admin.content.index') }}" data-title="Konten">
                                    <i class="bx bx-file"></i>
                                    <span>Konten</span>
                                </a>
                            </li>

                        @endif

                    </ul>

                </div>

            </div>
        </div>

        <div class="main-content">

            <div class="page-content d-flex flex-column">

                <div class="content-wrapper flex-grow-1">
                    @yield('content')
                </div>

                <!-- 🔥 FOOTER FIX TOTAL -->
                <footer class="footer px-4 py-3 d-flex justify-content-between">
                    <div>© {{ date('Y') }} <strong>Laporppa</strong></div>
                    <div>Sistem Pengaduan Masyarakat</div>
                </footer>

            </div>

        </div>

    </div>

    @include('auth.admin.partials.script')

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const toggleBtn = document.getElementById("vertical-menu-btn");

            if (toggleBtn) {
                toggleBtn.addEventListener("click", function () {
                    document.body.classList.toggle("sidebar-collapsed");
                });
            }

        });
    </script>

    @stack('script')

</body>

</html>