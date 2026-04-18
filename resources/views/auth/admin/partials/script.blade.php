<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        /* ================= SIDEBAR TOGGLE ================= */
        const sidebarBtn = document.getElementById("vertical-menu-btn");

        if (sidebarBtn) {
            sidebarBtn.addEventListener("click", function () {
                document.body.classList.toggle("sidebar-collapsed");
            });
        }


        /* ================= FULLSCREEN ================= */
        const fullscreenBtn = document.getElementById("fullscreen-btn");

        if (fullscreenBtn) {
            fullscreenBtn.addEventListener("click", function () {

                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    document.exitFullscreen();
                }

            });
        }


        /* ================= DARK MODE ================= */
        const themeBtn = document.getElementById('theme-toggle');

        if (themeBtn) {

            // toggle mode
            themeBtn.addEventListener('click', function () {

                document.body.classList.toggle('dark-mode');

                const isDark = document.body.classList.contains('dark-mode');

                // simpan ke localStorage
                localStorage.setItem('theme', isDark ? 'dark' : 'light');

                // ganti icon
                themeBtn.innerHTML = isDark
                    ? '<i class="bx bx-sun"></i>'
                    : '<i class="bx bx-moon"></i>';
            });

            // load state awal
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
                themeBtn.innerHTML = '<i class="bx bx-sun"></i>';
            }

        }


        /* ================= DATATABLE ================= */
        if (window.jQuery && $.fn.DataTable) {

            $('.datatable').each(function () {

                if ($.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable().destroy();
                }

                $(this).DataTable({
                    destroy: true,
                    responsive: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25],
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
            console.warn("DataTable / jQuery belum ke-load");
        }

    });
</script>

{{-- WAJIB --}}
@stack('script')