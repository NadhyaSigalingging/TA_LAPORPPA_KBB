<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        /* ================= SIDEBAR TOGGLE (TAILWIND FIX) ================= */
        const sidebarBtn = document.getElementById("vertical-menu-btn");
        const sidebar = document.getElementById("sidebar");
        const main = document.getElementById("mainContent");
        const topbar = document.getElementById("topbar");

        if (sidebarBtn && sidebar && main && topbar) {

            sidebarBtn.addEventListener("click", function() {

                // toggle width
                sidebar.classList.toggle("w-20");
                sidebar.classList.toggle("w-64");

                // main adjust
                main.classList.toggle("ml-20");
                main.classList.toggle("ml-64");

                // header adjust
                topbar.classList.toggle("left-20");
                topbar.classList.toggle("left-64");

                // hide text
                document.querySelectorAll(".menu-text").forEach(el => {
                    el.classList.toggle("hidden");
                });

                const logo = document.querySelector(".logo-text");
                if (logo) logo.classList.toggle("hidden");

            });

        }


        /* ================= FULLSCREEN ================= */
        const fullscreenBtn = document.getElementById("fullscreen-btn");

        if (fullscreenBtn) {
            fullscreenBtn.addEventListener("click", function() {

                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    document.exitFullscreen();
                }

            });
        }


        /* ================= DARK MODE (TAILWIND STYLE) ================= */
        const themeBtn = document.getElementById('theme-toggle');

        if (themeBtn) {

            themeBtn.addEventListener('click', function() {

                document.documentElement.classList.toggle('dark');

                const isDark = document.documentElement.classList.contains('dark');

                localStorage.setItem('theme', isDark ? 'dark' : 'light');

                themeBtn.innerHTML = isDark ?
                    '<i class="bx bx-sun"></i>' :
                    '<i class="bx bx-moon"></i>';
            });

            // LOAD THEME
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
                themeBtn.innerHTML = '<i class="bx bx-sun"></i>';
            }

        }


        /* ================= DATATABLE FIX ================= */
        if (window.jQuery && $.fn.DataTable) {

            $('.datatable').each(function() {

                // destroy dulu kalau sudah ada
                if ($.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable().destroy();
                }

                $(this).DataTable({
                    destroy: true,
                    responsive: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25],
                    autoWidth: false,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        zeroRecords: "Data tidak ditemukan",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        paginate: {
                            next: "→",
                            previous: "←"
                        }
                    }
                });

            });

        } else {
            console.warn("❌ DataTable / jQuery belum ke-load");
        }


        /* ================= PROFILE DROPDOWN ================= */
        const profileBtn = document.getElementById("profileBtn");
        const profileMenu = document.getElementById("profileMenu");

        if (profileBtn && profileMenu) {

            profileBtn.addEventListener("click", function(e) {
                e.stopPropagation();
                profileMenu.classList.toggle("hidden");
            });

            document.addEventListener("click", function() {
                profileMenu.classList.add("hidden");
            });

        }

    });
</script>

{{-- WAJIB --}}
@stack('script')