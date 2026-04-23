<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'LAPORPPA-KBB')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Layanan pelaporan online kekerasan perempuan dan anak Kabupaten Bandung Barat')">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Barlow:wght@300;400;500;600;700;800;900&family=Barlow+Condensed:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />

    <style>
       
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --pink:         #C94B78;
            --pink-2:       #E8638F;
            --pink-light:   #F4A8C0;
            --pink-pale:    rgba(201,75,120,0.08);
            --pink-pale-2:  rgba(201,75,120,0.14);
            --pink-border:  rgba(201,75,120,0.20);
            --navy:         #1A1140;
            --navy-2:       #231550;
            --text-main:    #1A1140;
            --text-muted:   rgba(26,17,64,0.55);
            --text-soft:    rgba(26,17,64,0.38);
            --white:        #FFFFFF;
            --off-white:    #FEF8FB;
            --card-bg:      rgba(255,255,255,0.80);
            --card-border:  rgba(201,75,120,0.14);
            --shadow-sm:    0 2px 12px rgba(201,75,120,0.08);
            --shadow-md:    0 8px 32px rgba(201,75,120,0.14);
            --shadow-lg:    0 20px 60px rgba(201,75,120,0.18);
            --radius-sm:    10px;
            --radius-md:    16px;
            --radius-lg:    24px;
            --transition:   all 0.25s cubic-bezier(0.22,1,0.36,1);
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 88px;
        }

        body {
            font-family: 'Barlow', sans-serif;
            color: var(--text-main);
            background: var(--off-white);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 15% 10%, #FFE4EE 0%, transparent 60%),
                radial-gradient(ellipse 60% 70% at 85% 5%,  #EDE9FF 0%, transparent 55%),
                radial-gradient(ellipse 70% 50% at 50% 95%, #FFE8F0 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 90% 80%, #E0F0FF 0%, transparent 50%),
                linear-gradient(145deg, #FFF5F8 0%, #F5F0FF 40%, #F0F8FF 70%, #FFF5F8 100%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, rgba(201,75,120,0.10) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.45;
        }

        .page-content {
            position: relative;
            z-index: 1;
            flex: 1;
        }

     
        .section-eyebrow {
            display: inline-flex; align-items: center; gap: 10px;
            margin-bottom: 16px;
        }
        .section-eyebrow-line { width: 28px; height: 2px; background: var(--pink); border-radius: 2px; }
        .section-eyebrow-text {
            font-size: 12px; font-weight: 700; letter-spacing: 3px;
            text-transform: uppercase; color: var(--pink);
        }
        .section-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(32px, 4vw, 52px);
            font-weight: 900; line-height: 1.0;
            text-transform: uppercase; letter-spacing: -0.5px;
            color: var(--text-main); margin-bottom: 16px;
        }
        .section-title .accent { color: var(--pink); }
        .section-subtitle {
            font-size: 16px; font-weight: 400; line-height: 1.80;
            color: var(--text-muted); max-width: 560px; margin-bottom: 48px;
        }

        /* =====================
           NAVBAR
        ===================== */
        nav.lp-nav {
            height: 88px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 60px;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(201,75,120,0.12);
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: var(--transition);
            flex-shrink: 0;
        }
        nav.lp-nav.scrolled {
            height: 72px;
            box-shadow: 0 4px 24px rgba(201,75,120,0.10);
        }
        .lp-logo {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px; font-weight: 900; letter-spacing: 2px;
            text-transform: uppercase; color: var(--text-main); text-decoration: none;
            flex-shrink: 0;
        }
        .lp-logo .logo-accent { color: var(--pink); }
        .lp-logo .logo-muted  { color: rgba(26,17,64,0.28); }

        .lp-nav-links { display: flex; gap: 4px; list-style: none; padding: 0; margin: 0; }
        .lp-nav-links a {
            font-size: 12px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--text-muted); text-decoration: none;
            padding: 8px 12px; border-radius: 8px;
            transition: var(--transition); position: relative;
        }
        .lp-nav-links a:hover { color: var(--pink); background: var(--pink-pale); }
        .lp-nav-links a.active-menu,
        .lp-nav-links a.active { color: var(--pink); }
        .lp-nav-links a.active-menu::after,
        .lp-nav-links a.active::after {
            content: ''; position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%);
            width: 4px; height: 4px; background: var(--pink); border-radius: 50%;
        }

        .nav-divider {
            width: 1px; height: 24px;
            background: rgba(201,75,120,0.20);
            margin: 0 6px; flex-shrink: 0; align-self: center;
        }

        .lp-nav-right { display: flex; align-items: center; gap: 10px; }

        .btn-nav-lapor {
            font-size: 12px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;
            color: #fff; background: var(--pink); border: none; border-radius: 8px;
            padding: 9px 18px; text-decoration: none; transition: var(--transition); cursor: pointer;
            display: inline-flex; align-items: center; gap: 6px;
            box-shadow: 0 4px 16px rgba(201,75,120,0.30);
        }
        .btn-nav-lapor:hover {
            background: #b03466; color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(201,75,120,0.40);
        }
        .btn-nav-lapor i { font-size: 11px; }

        .btn-nav-masuk {
            font-size: 13px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--text-muted); text-decoration: none;
            padding: 9px 18px; border-radius: 8px;
            border: 1px solid var(--pink-border);
            transition: var(--transition);
        }
        .btn-nav-masuk:hover { color: var(--pink); background: var(--pink-pale); border-color: var(--pink); }

        /* ===========================
           NOTIFIKASI BELL & DROPDOWN
           =========================== */
        .notif-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .notif-bell {
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px 8px;
            position: relative;
            color: var(--text-main, #333);
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }

        .notif-bell:hover {
            color: var(--pink, #c94b78);
        }

        .notif-badge {
            position: absolute;
            top: 0px;
            right: 0px;
            background: #e53e3e;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            border-radius: 50%;
            min-width: 17px;
            height: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 3px;
            line-height: 1;
            font-family: 'Barlow', sans-serif;
        }

        .notif-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 360px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(60,20,40,0.13);
            border: 1.5px solid rgba(201,75,120,0.13);
            z-index: 9999;
            overflow: hidden;
            font-family: 'Barlow', sans-serif;
        }

        .notif-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px 10px 18px;
            border-bottom: 1px solid rgba(201,75,120,0.10);
        }

        .notif-title {
            font-weight: 700;
            font-size: 15px;
            color: var(--text-main, #222);
        }

        .notif-mark-all {
            background: none;
            border: none;
            color: var(--pink, #c94b78);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            font-family: 'Barlow', sans-serif;
        }

        .notif-mark-all:hover { text-decoration: underline; }

        .notif-list {
            max-height: 380px;
            overflow-y: auto;
        }

        .notif-empty {
            text-align: center;
            padding: 36px 20px;
            color: #aaa;
        }

        .notif-empty i {
            font-size: 28px;
            margin-bottom: 8px;
            display: block;
            color: #ddd;
        }

        .notif-empty p { margin: 0; font-size: 13px; }

        .notif-item {
            display: block;
            padding: 13px 18px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s;
            position: relative;
        }

        .notif-item:hover {
            background: rgba(201,75,120,0.04);
            text-decoration: none;
        }

        .notif-item.unread { background: rgba(201,75,120,0.06); }

        .notif-item.unread::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 50%;
            transform: translateY(-50%);
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--pink, #c94b78);
        }

        .notif-item-top {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .notif-item-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .notif-item-icon.status-0        { background: #f0f0f0; color: #888; }
        .notif-item-icon.status-process  { background: #ebf8ff; color: #2b6cb0; }
        .notif-item-icon.status-finished { background: #f0fff4; color: #276749; }
        .notif-item-icon.status-rejected { background: #fff5f5; color: #c53030; }
        .notif-item-icon.status-respon   { background: #faf5ff; color: #6b46c1; }

        .notif-item-badge {
            font-size: 10px;
            font-weight: 700;
            border-radius: 20px;
            padding: 2px 8px;
            white-space: nowrap;
        }

        .notif-item-badge.status-0        { background: #f0f0f0; color: #555; }
        .notif-item-badge.status-process  { background: #bee3f8; color: #2b6cb0; }
        .notif-item-badge.status-finished { background: #c6f6d5; color: #276749; }
        .notif-item-badge.status-rejected { background: #fed7d7; color: #c53030; }
        .notif-item-badge.status-respon   { background: #e9d8fd; color: #6b46c1; }

        .notif-item-time {
            font-size: 11px;
            color: #aaa;
            margin-left: auto;
            white-space: nowrap;
        }

        .notif-item-judul {
            font-size: 13px;
            font-weight: 700;
            color: #222;
            margin-bottom: 2px;
            padding-left: 40px;
        }

        .notif-item-pesan {
            font-size: 12px;
            color: #666;
            line-height: 1.45;
            padding-left: 40px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        /* === END NOTIFIKASI === */

        .notif-dot {
            position: absolute; top: 4px; right: 4px;
            width: 8px; height: 8px; background: var(--pink);
            border-radius: 50%; border: 1.5px solid #fff;
        }

        .user-trigger {
            cursor: pointer; display: flex; align-items: center; gap: 8px;
            padding: 5px 12px 5px 5px; border-radius: 50px;
            background: var(--pink-pale); border: 1.5px solid var(--pink-border);
            transition: var(--transition);
        }
        .user-trigger:hover { background: rgba(201,75,120,0.18); }
        .user-trigger .user-name {
            font-size: 13px; font-weight: 700; color: var(--text-main);
            max-width: 110px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }

        .lp-hamburger {
            display: none; flex-direction: column; gap: 5px;
            cursor: pointer; background: none; border: none; padding: 4px;
        }
        .lp-hamburger span {
            display: block; width: 24px; height: 2px; background: var(--text-main);
            border-radius: 2px; transition: var(--transition);
        }
        .lp-hamburger span:last-child { width: 16px; }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 72px; left: 0; right: 0;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--card-border);
            padding: 20px 24px;
            z-index: 999;
            flex-direction: column;
            gap: 4px;
            box-shadow: 0 8px 32px rgba(201,75,120,0.10);
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a {
            font-size: 14px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--text-muted); text-decoration: none;
            padding: 12px 16px; border-radius: 10px; transition: var(--transition);
        }
        .mobile-menu a:hover { color: var(--pink); background: var(--pink-pale); }
        .mobile-divider { height: 1px; background: var(--card-border); margin: 8px 0; }
        .mobile-cta {
            color: var(--pink) !important; background: var(--pink-pale) !important;
            border: 1px solid var(--pink-border); text-align: center; margin-top: 4px;
            border-radius: 10px;
        }
        .mobile-section-label {
            font-size: 10px; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; color: var(--text-soft);
            padding: 4px 16px; margin-top: 4px;
        }

      
        .lp-section {
            position: relative; z-index: 1;
            padding: 96px 60px;
        }
        .lp-section.bg-alt {
            background: rgba(255,255,255,0.55);
            backdrop-filter: blur(4px);
            border-top: 1px solid rgba(201,75,120,0.08);
            border-bottom: 1px solid rgba(201,75,120,0.08);
        }
        .section-inner { max-width: 1200px; margin: 0 auto; }

   
        #beranda.hero-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 60px;
            padding: 80px 60px 100px;
            min-height: calc(100vh - 88px);
            position: relative;
            z-index: 1;
        }
        .hero-left {
            display: flex; flex-direction: column;
            animation: fadeUp 0.9s cubic-bezier(0.22,1,0.36,1) 0.2s both;
        }
        .hero-heading {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(52px, 6vw, 88px);
            font-weight: 900; line-height: 0.92;
            text-transform: uppercase; letter-spacing: -1px;
            color: var(--text-main); margin-bottom: 24px;
        }
        .hero-heading .word-italic {
            font-family: 'DM Serif Display', serif;
            font-style: italic; font-weight: 400;
            color: var(--pink); font-size: 0.78em;
            letter-spacing: 0; display: block; margin-bottom: 4px;
        }
        .hero-desc {
            font-size: 17px; font-weight: 400; line-height: 1.85;
            color: var(--text-muted); max-width: 480px; margin-bottom: 36px;
        }
        .hero-desc strong { color: var(--text-main); font-weight: 700; }

        .hero-stats { display: flex; gap: 32px; margin-bottom: 36px; flex-wrap: wrap; }
        .hero-stat { display: flex; flex-direction: column; }
        .hero-stat-num {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 36px; font-weight: 900; color: var(--pink); line-height: 1;
        }
        .hero-stat-label { font-size: 13px; font-weight: 600; color: var(--text-muted); margin-top: 2px; }

        .hero-cta-row { display: flex; align-items: center; gap: 14px; margin-bottom: 40px; flex-wrap: wrap; }

        .btn-cta-primary {
            font-size: 14px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;
            color: #fff; background: var(--pink); border: none; border-radius: 10px;
            padding: 15px 34px; text-decoration: none; transition: var(--transition); cursor: pointer;
            display: inline-flex; align-items: center; gap: 10px;
            box-shadow: 0 6px 24px rgba(201,75,120,0.35);
        }
        .btn-cta-primary:hover {
            background: #b03466; color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 36px rgba(201,75,120,0.45);
        }
        .btn-cta-secondary {
            font-size: 14px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--pink); background: var(--pink-pale);
            border: 1px solid var(--pink-border); border-radius: 10px;
            padding: 14px 28px; text-decoration: none; transition: var(--transition);
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-cta-secondary:hover { background: var(--pink-pale-2); transform: translateY(-1px); }

        .hero-badges { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 10px 18px;
            background: var(--card-bg); border: 1px solid var(--card-border);
            border-radius: 50px; backdrop-filter: blur(8px); box-shadow: var(--shadow-sm);
        }
        .hero-badge-icon {
            width: 30px; height: 30px;
            background: var(--pink-pale); border: 1px solid var(--pink-border);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: var(--pink); flex-shrink: 0;
        }
        .hero-badge-text { font-size: 13px; font-weight: 700; color: var(--text-main); }
        .hero-badge-sub { font-size: 11px; font-weight: 500; color: var(--text-muted); display: block; margin-top: 1px; }

        .hero-user-greeting {
            display: inline-flex; align-items: center; gap: 12px;
            padding: 10px 20px 10px 10px;
            background: linear-gradient(135deg, rgba(201,75,120,0.10), rgba(201,75,120,0.06));
            border: 1px solid var(--pink-border);
            border-radius: 50px; margin-bottom: 24px;
            backdrop-filter: blur(8px); box-shadow: var(--shadow-sm);
            width: fit-content;
        }
        .hero-user-greeting img {
            width: 36px; height: 36px; border-radius: 50%; object-fit: cover;
            border: 2px solid rgba(201,75,120,0.30);
        }
        .hero-user-greeting-text { display: flex; flex-direction: column; gap: 1px; }
        .hero-user-greeting-hi { font-size: 11px; font-weight: 600; color: var(--text-soft); letter-spacing: 0.5px; }
        .hero-user-greeting-name { font-size: 14px; font-weight: 700; color: var(--text-main); }

        .hero-right {
            position: relative; height: 560px;
            animation: fadeUp 0.9s cubic-bezier(0.22,1,0.36,1) 0.45s both;
        }
        .photo-grid { position: relative; width: 100%; height: 100%; }
        .photo-item-1 {
            position: absolute; top: 0; left: 0;
            width: 58%; aspect-ratio: 4/5;
            border-radius: var(--radius-lg); overflow: hidden;
            box-shadow: var(--shadow-lg); border: 3px solid rgba(255,255,255,0.95);
            animation: photoIn1 1s cubic-bezier(0.22,1,0.36,1) 0.6s both;
        }
        .photo-item-2 {
            position: absolute; top: 0; right: 0;
            width: 40%; aspect-ratio: 3/4;
            border-radius: var(--radius-lg); overflow: hidden;
            box-shadow: var(--shadow-md); border: 3px solid rgba(255,255,255,0.95);
            animation: photoIn2 1s cubic-bezier(0.22,1,0.36,1) 0.75s both;
        }
        .photo-item-3 {
            position: absolute; bottom: 0; left: 20%;
            width: 52%; aspect-ratio: 16/10;
            border-radius: var(--radius-lg); overflow: hidden;
            box-shadow: var(--shadow-md); border: 3px solid rgba(255,255,255,0.95);
            animation: photoIn3 1s cubic-bezier(0.22,1,0.36,1) 0.9s both;
        }
        .photo-item-1 img, .photo-item-2 img, .photo-item-3 img {
            width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.5s ease;
        }
        .photo-item-1:hover img, .photo-item-2:hover img, .photo-item-3:hover img { transform: scale(1.04); }
        .photo-deco-circle {
            position: absolute; top: -20px; right: -20px;
            width: 130px; height: 130px; border-radius: 50%;
            background: linear-gradient(135deg, #F4A8C0, var(--pink)); opacity: 0.20; z-index: 0;
        }
        .photo-deco-rect {
            position: absolute; bottom: 20px; left: -12px;
            width: 64px; height: 64px; border-radius: 14px;
            background: var(--pink); opacity: 0.12; z-index: 0;
        }

     
        #mengapa-melapor .reasons-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .reason-card {
            background: var(--card-bg); border: 1px solid var(--card-border);
            border-radius: var(--radius-md); padding: 36px 28px;
            backdrop-filter: blur(8px); box-shadow: var(--shadow-sm);
            transition: var(--transition); position: relative; overflow: hidden;
        }
        .reason-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, var(--pink), var(--pink-light));
            opacity: 0; transition: var(--transition);
        }
        .reason-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); border-color: var(--pink-border); }
        .reason-card:hover::before { opacity: 1; }
        .reason-icon {
            width: 56px; height: 56px;
            background: var(--pink-pale); border: 1px solid var(--pink-border);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; color: var(--pink); margin-bottom: 20px;
        }
        .reason-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px; font-weight: 900; text-transform: uppercase;
            color: var(--text-main); margin-bottom: 10px; letter-spacing: 0.3px;
        }
        .reason-desc { font-size: 15px; line-height: 1.75; color: var(--text-muted); }

   
        #cara-melapor .steps-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px; align-items: start;
        }
        .steps-list { display: flex; flex-direction: column; gap: 0; }
        .step-item {
            display: flex; gap: 20px;
            padding: 28px 0;
            border-bottom: 1px solid rgba(201,75,120,0.08);
            transition: var(--transition); cursor: default;
        }
        .step-item:first-child { padding-top: 0; }
        .step-item:last-child { border-bottom: none; }
        .step-num {
            width: 44px; height: 44px; flex-shrink: 0;
            background: var(--pink-pale); border: 2px solid var(--pink-border);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px; font-weight: 900; color: var(--pink);
            transition: var(--transition);
        }
        .step-item:hover .step-num { background: var(--pink); color: #fff; border-color: var(--pink); }
        .step-body { display: flex; flex-direction: column; gap: 6px; padding-top: 8px; }
        .step-title { font-size: 17px; font-weight: 700; color: var(--text-main); }
        .step-desc { font-size: 14px; line-height: 1.75; color: var(--text-muted); }

        .steps-panel { position: sticky; top: 108px; }
        .steps-info-card {
            background: var(--navy); border-radius: var(--radius-lg);
            padding: 40px 36px; color: #fff;
            box-shadow: 0 20px 60px rgba(26,17,64,0.20); margin-bottom: 20px;
        }
        .steps-info-card-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 26px; font-weight: 900; text-transform: uppercase;
            color: #fff; margin-bottom: 16px; line-height: 1.1;
        }
        .steps-info-card-title span { color: var(--pink-light); }
        .steps-info-card p { font-size: 15px; line-height: 1.80; color: rgba(255,255,255,0.70); margin-bottom: 24px; }
        .steps-hotline {
            display: flex; align-items: center; gap: 14px;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14);
            border-radius: var(--radius-sm); padding: 16px 20px;
        }
        .steps-hotline-icon {
            width: 42px; height: 42px; background: var(--pink); border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #fff; flex-shrink: 0;
        }
        .steps-hotline-label { font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.50); }
        .steps-hotline-num { font-family: 'Barlow Condensed', sans-serif; font-size: 24px; font-weight: 900; color: #fff; letter-spacing: 1px; }

        .steps-requirement-card {
            background: var(--card-bg); border: 1px solid var(--card-border);
            border-radius: var(--radius-md); padding: 28px;
            backdrop-filter: blur(8px); box-shadow: var(--shadow-sm);
        }
        .steps-req-title { font-size: 14px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-soft); margin-bottom: 16px; }
        .req-list { display: flex; flex-direction: column; gap: 10px; list-style: none; padding: 0; }
        .req-list li { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: var(--text-muted); line-height: 1.6; }
        .req-list li i { color: var(--pink); font-size: 12px; margin-top: 4px; flex-shrink: 0; }

     
        #jenis-kekerasan .violence-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .violence-card {
            background: var(--card-bg); border: 1px solid var(--card-border);
            border-radius: var(--radius-md); padding: 28px 24px;
            text-align: center; transition: var(--transition);
            backdrop-filter: blur(8px); box-shadow: var(--shadow-sm);
        }
        .violence-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); border-color: rgba(201,75,120,0.30); }
        .violence-icon-wrap {
            width: 64px; height: 64px; margin: 0 auto 20px;
            background: var(--pink-pale); border: 1px solid var(--pink-border);
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; color: var(--pink);
        }
        .violence-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px; font-weight: 900; text-transform: uppercase;
            color: var(--text-main); margin-bottom: 10px; letter-spacing: 0.3px;
        }
        .violence-desc { font-size: 13px; line-height: 1.70; color: var(--text-muted); }

        
        #kerahasiaan .privacy-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px; align-items: center;
        }
        .privacy-visual {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-2) 100%);
            border-radius: var(--radius-lg); padding: 48px 40px;
            position: relative; overflow: hidden;
        }
        .privacy-visual::before {
            content: ''; position: absolute; top: -40px; right: -40px;
            width: 200px; height: 200px; border-radius: 50%;
            background: var(--pink); opacity: 0.12;
        }
        .privacy-visual-icon {
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14);
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            font-size: 32px; color: var(--pink-light); margin-bottom: 28px;
        }
        .privacy-visual-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 32px; font-weight: 900; text-transform: uppercase;
            color: #fff; margin-bottom: 12px; line-height: 1.0;
        }
        .privacy-visual-title span { color: var(--pink-light); }
        .privacy-visual p { font-size: 15px; line-height: 1.80; color: rgba(255,255,255,0.65); margin-bottom: 28px; }
        .privacy-badge-row { display: flex; gap: 10px; flex-wrap: wrap; }
        .privacy-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14);
            border-radius: 50px; padding: 8px 16px;
            font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,0.85);
        }
        .privacy-badge i { color: var(--pink-light); font-size: 10px; }

        .privacy-right .section-subtitle { margin-bottom: 32px; }
        .privacy-features { display: flex; flex-direction: column; gap: 20px; }
        .privacy-feature { display: flex; gap: 16px; align-items: flex-start; }
        .pf-icon {
            width: 44px; height: 44px; flex-shrink: 0;
            background: var(--pink-pale); border: 1px solid var(--pink-border);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: var(--pink);
        }
        .pf-body { display: flex; flex-direction: column; gap: 4px; }
        .pf-title { font-size: 16px; font-weight: 700; color: var(--text-main); }
        .pf-desc { font-size: 14px; line-height: 1.70; color: var(--text-muted); }

       
        #mulai-melapor.cta-band {
            background: linear-gradient(135deg, #C94B78 0%, #9B2F5C 100%);
            position: relative; overflow: hidden;
            padding: 80px 60px; z-index: 1;
        }
        #mulai-melapor.cta-band::after {
            content: ''; position: absolute; top: -80px; right: -80px;
            width: 320px; height: 320px; border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .cta-band-inner {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 1fr auto;
            align-items: center; gap: 48px; position: relative; z-index: 1;
        }
        .cta-band-left .section-eyebrow-line { background: rgba(255,255,255,0.50); }
        .cta-band-left .section-eyebrow-text { color: rgba(255,255,255,0.75); }
        .cta-band-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(32px, 4vw, 56px); font-weight: 900; text-transform: uppercase;
            color: #fff; margin-bottom: 12px; line-height: 1.0;
        }
        .cta-band-desc { font-size: 17px; line-height: 1.75; color: rgba(255,255,255,0.75); max-width: 520px; }
        .cta-band-right { display: flex; flex-direction: column; gap: 12px; flex-shrink: 0; }
        .btn-cta-white {
            font-size: 14px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;
            color: var(--pink); background: #fff; border-radius: 10px;
            padding: 15px 32px; text-decoration: none; transition: var(--transition);
            display: inline-flex; align-items: center; gap: 10px; white-space: nowrap;
            box-shadow: 0 6px 24px rgba(0,0,0,0.15);
        }
        .btn-cta-white:hover { transform: translateY(-2px); box-shadow: 0 12px 36px rgba(0,0,0,0.20); color: #b03466; }
        .btn-cta-ghost {
            font-size: 13px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
            color: rgba(255,255,255,0.85);
            background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25);
            border-radius: 10px; padding: 13px 28px; text-decoration: none; transition: var(--transition);
            display: inline-flex; align-items: center; gap: 8px; white-space: nowrap;
        }
        .btn-cta-ghost:hover { background: rgba(255,255,255,0.20); color: #fff; transform: translateY(-1px); }

       
        footer.lp-footer {
            position: relative; z-index: 10;
            background: rgba(255,255,255,0.90);
            border-top: 1px solid rgba(201,75,120,0.12);
            backdrop-filter: blur(14px);
            margin-top: auto;
        }
        .footer-top {
            display: grid;
            grid-template-columns: 1.5fr 1px 1fr 1px 1fr;
            max-width: 1200px; margin: 0 auto;
            min-height: 260px;
        }
        .footer-divider { background: rgba(201,75,120,0.10); align-self: stretch; }
        .footer-col { padding: 52px 40px; }
        .footer-brand { padding: 52px 60px 52px 0; }
        .footer-col-heading {
            font-size: 11px; font-weight: 700; letter-spacing: 3px;
            text-transform: uppercase; color: var(--text-soft);
            margin-bottom: 24px; display: flex; align-items: center; gap: 10px;
        }
        .footer-col-heading::after { content: ''; flex: 1; height: 1px; background: rgba(201,75,120,0.10); }
        .footer-brand-logo {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px; font-weight: 900; letter-spacing: 2px; text-transform: uppercase;
            color: var(--text-main); margin-bottom: 12px;
        }
        .footer-brand-logo .accent { color: var(--pink); }
        .footer-brand-logo .muted { color: rgba(26,17,64,0.28); }
        .footer-brand-desc { font-size: 14px; line-height: 1.75; color: var(--text-muted); margin-bottom: 24px; max-width: 260px; }

        .footer-contact-list { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 16px; }
        .footer-contact-list li { display: flex; align-items: flex-start; gap: 12px; }
        .fc-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--pink-pale); border: 1px solid var(--pink-border);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: var(--pink); flex-shrink: 0; margin-top: 1px;
        }
        .fc-text { display: flex; flex-direction: column; gap: 2px; }
        .fc-label { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-soft); }
        .fc-val { font-size: 14px; font-weight: 500; color: var(--text-main); line-height: 1.6; }
        .fc-val a { color: var(--text-main); text-decoration: none; transition: color 0.2s; }
        .fc-val a:hover { color: var(--pink); }

        .footer-links-list { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 10px; }
        .footer-links-list a {
            font-size: 14px; font-weight: 500; color: var(--text-muted);
            text-decoration: none; transition: var(--transition);
            display: inline-flex; align-items: center; gap: 6px;
        }
        .footer-links-list a i { font-size: 10px; color: var(--pink); }
        .footer-links-list a:hover { color: var(--pink); }

        .footer-social-grid { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
        .footer-social-link {
            width: 42px; height: 42px; border-radius: 10px;
            border: 1px solid rgba(201,75,120,0.18);
            background: rgba(255,255,255,0.80);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted); font-size: 16px; text-decoration: none;
            transition: var(--transition);
        }
        .footer-social-link:hover {
            border-color: var(--pink); background: var(--pink); color: #fff;
            transform: translateY(-3px); box-shadow: 0 6px 20px rgba(201,75,120,0.28);
        }
        .footer-social-link svg { width: 15px; height: 15px; fill: currentColor; display: block; }

        .footer-bottom {
            border-top: 1px solid rgba(201,75,120,0.10);
            padding: 20px 60px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(255,245,248,0.60);
        }
        .footer-copy { font-size: 13px; font-weight: 500; color: var(--text-soft); }
        .footer-copy strong { color: var(--text-muted); }
        .footer-badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: var(--text-soft);
        }
        .footer-badge i { color: var(--pink); font-size: 10px; }

        .ticker-wrap {
            position: fixed; left: 0; right: 0; bottom: 0; z-index: 500;
            overflow: hidden; height: 38px;
            background: linear-gradient(90deg, #C94B78, #9B2F5C, #C94B78);
            background-size: 200% 100%;
            animation: tickerBg 8s linear infinite;
            display: flex; align-items: center; pointer-events: none;
        }
        .ticker-track { display: flex; animation: ticker 36s linear infinite; white-space: nowrap; }
        .ticker-item {
            font-family: 'Barlow Condensed', sans-serif; font-size: 13px; font-weight: 700;
            letter-spacing: 2.5px; text-transform: uppercase; color: rgba(255,255,255,0.90); padding: 0 28px;
        }
        .ticker-sep { color: rgba(255,255,255,0.50); padding: 0 4px; }
        .ticker-spacer { height: 38px; position: relative; z-index: 1; }

        .reveal {
            opacity: 0; transform: translateY(32px);
            transition: opacity 0.8s cubic-bezier(0.22,1,0.36,1), transform 0.8s cubic-bezier(0.22,1,0.36,1);
        }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }
        .reveal-delay-5 { transition-delay: 0.5s; }

        @keyframes fadeUp    { from { opacity:0; transform:translateY(28px); }   to { opacity:1; transform:translateY(0); } }
        @keyframes photoIn1  { from { opacity:0; transform:translateX(-30px) rotate(-2deg); } to { opacity:1; transform:translateX(0) rotate(0); } }
        @keyframes photoIn2  { from { opacity:0; transform:translateY(-20px) rotate(2deg); }  to { opacity:1; transform:translateY(0) rotate(0); } }
        @keyframes photoIn3  { from { opacity:0; transform:translateY(30px); }  to { opacity:1; transform:translateY(0); } }
        @keyframes ticker    { from { transform:translateX(0); }  to { transform:translateX(-50%); } }
        @keyframes tickerBg  { 0% { background-position:0% 0%; }  100% { background-position:200% 0%; } }

        @media (max-width: 1100px) {
            #jenis-kekerasan .violence-grid { grid-template-columns: repeat(2, 1fr); }
            #mengapa-melapor .reasons-grid  { grid-template-columns: repeat(2, 1fr); }
            .footer-top { grid-template-columns: 1fr; }
            .footer-divider { display: none; }
            .footer-brand { padding: 40px 28px; }
            .footer-col   { padding: 32px 28px; border-bottom: 1px solid rgba(201,75,120,0.08); }
        }
        @media (max-width: 960px) {
            nav.lp-nav   { padding: 0 24px; height: 72px; }
            .lp-nav-links, .btn-nav-masuk { display: none; }
            .lp-hamburger { display: flex; }
            html { scroll-padding-top: 72px; }
            #beranda.hero-section { grid-template-columns: 1fr; padding: 40px 24px 80px; gap: 48px; min-height: auto; }
            .hero-right  { height: 400px; order: -1; }
            .lp-section  { padding: 64px 24px; }
            #cara-melapor .steps-layout  { grid-template-columns: 1fr; gap: 40px; }
            .steps-panel { position: relative; top: auto; }
            #kerahasiaan .privacy-layout { grid-template-columns: 1fr; gap: 40px; }
            .cta-band-inner  { grid-template-columns: 1fr; }
            .cta-band-right  { flex-direction: row; flex-wrap: wrap; }
            #mulai-melapor.cta-band { padding: 60px 24px; }
            .footer-bottom   { padding: 16px 24px; flex-direction: column; gap: 8px; text-align: center; }
            .lp-nav-right .btn-nav-lapor { display: none; }
            .notif-dropdown  { width: 310px; right: -40px; }
        }
        @media (max-width: 640px) {
            #jenis-kekerasan .violence-grid { grid-template-columns: 1fr 1fr; }
            #mengapa-melapor .reasons-grid  { grid-template-columns: 1fr; }
            nav.lp-nav   { padding: 0 20px; }
            .ticker-wrap, .ticker-spacer { display: none; }
            .hero-right  { height: 320px; }
            .hero-stats  { gap: 20px; }
            .notif-dropdown  { width: 280px; right: -60px; }
        }
    </style>

    @stack('css')
    @yield('css')
</head>
<body>

@yield('navbar')

<div class="page-content">
    <x-alert />
    @yield('content')
</div>

@yield('footer-slot')

@yield('ticker')

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const nav = document.getElementById('mainNav');
    if (nav) {
        window.addEventListener('scroll', () => nav.classList.toggle('scrolled', window.scrollY > 40));
    }

    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length) {
        const ro = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('revealed'); ro.unobserve(e.target); }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        reveals.forEach(el => ro.observe(el));
    }

    document.querySelectorAll('a[href*="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href  = this.getAttribute('href');
            const hash  = href.substring(href.indexOf('#'));
            const target = document.querySelector(hash);
            if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
        });
    });

    setTimeout(function () {
        document.querySelectorAll('.alert').forEach(function (el) {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);

    const hamburger  = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', () => mobileMenu.classList.toggle('open'));
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.remove('open'));
        });
        document.addEventListener('click', (e) => {
            if (nav && !nav.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('open');
            }
        });
    }

    const sections  = document.querySelectorAll('section[id]');
    const navLinks  = document.querySelectorAll('.lp-nav-links a, .nav-link');
    if (sections.length && navLinks.length) {
        const so = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navLinks.forEach(l => l.classList.remove('active-menu', 'active'));
                    const match = document.querySelector(
                        `.lp-nav-links a[href*="#${entry.target.id}"], .nav-link[href*="#${entry.target.id}"]`
                    );
                    if (match) match.classList.add('active-menu');
                }
            });
        }, { threshold: 0.35 });
        sections.forEach(s => so.observe(s));
    }
});
</script>

@stack('script')
</body>
</html>