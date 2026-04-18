<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">

     @yield('css')
     
    <!-- JQUERY -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <style>
        /* ================= WARNA ================= */
        :root {
            --primary: #0B3C91;
            --secondary: #1E5ED7;
            --bg: #F4F7FB;
        }

        /* ================= BODY ================= */
        body {
            background: var(--bg);
            overflow-x: hidden;
            /* ✅ FIX */
        }

        /* ================= HEADER ================= */
        #page-topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: white;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-header {
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        /* ================= LOGO ================= */
        .app-logo {
            font-size: 20px;
            font-weight: bold;
            background: linear-gradient(90deg, #0B3C91, #1E5ED7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ================= SIDEBAR ================= */
        .vertical-menu {
            position: fixed;
            top: 70px;
            left: 0;
            width: 240px;
            height: calc(100vh - 70px);
            background: linear-gradient(180deg, #0B3C91, #062A63);

            z-index: 999;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        /* ================= MENU ================= */
        #sidebar-menu ul li a {
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 10px;
            margin: 6px 12px;
            padding: 12px;
            color: #e2e8f0 !important;
        }

        #sidebar-menu ul li a:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        #sidebar-menu ul li a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        /* ================= CONTENT ================= */
        .main-content {
            margin-left: 240px;
            margin-top: 70px;

            min-height: calc(100vh - 70px);

            display: flex;
            flex-direction: column;

            transition: 0.3s;
        }

        /* ================= PAGE ================= */
        .page-content {
            padding: 25px;

            display: flex;
            flex-direction: column;

            flex: 1;
        }

        /* ================= WRAPPER ================= */
        .content-wrapper {
            flex: 1;
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        /* ================= FOOTER ================= */
        .footer {
            margin-top: auto;
        }

        /* ================= COLLAPSE ================= */
        .sidebar-collapsed .vertical-menu {
            width: 70px;
        }

        .sidebar-collapsed .main-content {
            margin-left: 70px;
        }

        /* HIDE TEXT */
        .sidebar-collapsed #sidebar-menu ul li a span {
            display: none;
        }

        /* ICON CENTER */
        .sidebar-collapsed #sidebar-menu ul li a {
            justify-content: center;
        }

        /* TOOLTIP */
        .sidebar-collapsed #sidebar-menu ul li a:hover::after {
            content: attr(data-title);
            position: absolute;
            left: 75px;
            background: #111827;
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
        }

        /* ================= DARK MODE ================= */
        body.dark-mode {
            background: #0f172a;
        }

        body.dark-mode .content-wrapper {
            background: #1e293b;
            color: white;
        }

        body.dark-mode .vertical-menu {
            background: linear-gradient(180deg, #020617, #0f172a);
        }
    </style>

</head>