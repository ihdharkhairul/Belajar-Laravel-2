<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | HikerBest</title>

    <style>
        :root {
            --glass: rgba(255, 255, 255, 0.10);
            --glass-strong: rgba(255, 255, 255, 0.16);
            --line: rgba(255, 255, 255, 0.22);
            --text: #f3f6f4;
            --muted: rgba(243, 246, 244, 0.68);
            --accent: #3ddc97;
            --accent-dark: #29b97b;
            --danger: #ff6b6b;
            --warn: #ffc857;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text);
            background: #0f1f1a;
            line-height: 1.5;
        }

        /* ---------- Video background ---------- */
        .bg-video {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }
        .bg-overlay {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: linear-gradient(180deg, rgba(8, 20, 16, .55), rgba(8, 20, 16, .70));
        }

        /* ---------- Navbar melayang ---------- */
        header {
            position: sticky;
            top: 14px;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            width: calc(100% - 40px);
            max-width: 1000px;
            margin: 14px auto 0;
            padding: 10px 14px 10px 22px;
            background: var(--glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--line);
            border-radius: 999px;
        }
        .brand { font-size: 18px; font-weight: 700; letter-spacing: .3px; }
        .brand span { color: var(--accent); }
        nav { display: flex; gap: 4px; }
        nav a {
            color: var(--muted);
            text-decoration: none;
            font-size: 14px;
            padding: 8px 18px;
            border-radius: 999px;
            transition: .2s;
        }
        nav a:hover { color: #fff; background: var(--glass); }
        nav a.active { color: #0b1a14; background: var(--accent); font-weight: 600; }

        main { flex: 1; width: 100%; max-width: 1000px; margin: 0 auto; padding: 36px 20px; }
        footer { padding: 18px; text-align: center; font-size: 12px; color: var(--muted); }

        /* ---------- Judul halaman ---------- */
        .top { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 24px; }
        .top h2 { font-size: 28px; font-weight: 600; }

        /* ---------- Kotak kaca ---------- */
        .card, .gunung-card, table {
            background: var(--glass);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid var(--line);
            border-radius: 18px;
        }
        .card { padding: 28px; }

        /* ---------- Tabel ---------- */
        table { width: 100%; border-collapse: separate; border-spacing: 0; overflow: hidden; }
        th {
            text-align: left; font-size: 12px; font-weight: 600; letter-spacing: 1px;
            text-transform: uppercase; color: var(--muted);
            padding: 14px 16px; background: var(--glass-strong); border-bottom: 1px solid var(--line);
        }
        td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--line); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        td small { color: var(--muted); }

        /* ---------- Tombol ---------- */
        .btn {
            display: inline-block; padding: 9px 20px; font-size: 14px; font-weight: 600;
            font-family: inherit; color: #0b1a14; background: var(--accent);
            border: 1px solid var(--accent); border-radius: 999px;
            text-decoration: none; cursor: pointer; transition: .2s;
        }
        .btn:hover { background: var(--accent-dark); border-color: var(--accent-dark); }
        .btn-warning { background: transparent; color: var(--warn); border-color: var(--warn); }
        .btn-warning:hover { background: var(--warn); color: #0b1a14; border-color: var(--warn); }
        .btn-danger { background: transparent; color: var(--danger); border-color: var(--danger); }
        .btn-danger:hover { background: var(--danger); color: #fff; border-color: var(--danger); }
        .btn-light { background: transparent; color: var(--text); border-color: var(--line); }
        .btn-light:hover { background: var(--glass-strong); border-color: var(--line); }
        .aksi { display: flex; gap: 8px; }
        .aksi form { display: inline; }

        /* ---------- Form ---------- */
        .field { margin-bottom: 20px; }
        .field label { display: block; font-size: 13px; color: var(--muted); margin-bottom: 6px; }
        .field input, .field select, .field textarea {
            width: 100%; padding: 11px 14px; font-size: 15px; font-family: inherit;
            color: var(--text); background: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--line); border-radius: 12px; outline: none; transition: .2s;
        }
        .field input::placeholder, .field textarea::placeholder { color: rgba(255, 255, 255, .35); }
        .field input:focus, .field select:focus, .field textarea:focus {
            border-color: var(--accent); background: rgba(255, 255, 255, 0.12);
        }
        .field select option { background: #12261f; color: #fff; }
        .field input[type="date"] { color-scheme: dark; }
        .error-text { display: block; margin-top: 5px; font-size: 13px; color: var(--danger); }

        /* ---------- Alert ---------- */
        .alert {
            padding: 12px 18px; margin-bottom: 22px; font-size: 14px; border-radius: 14px;
            border: 1px solid; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
        }
        .alert-success { background: rgba(61, 220, 151, .15); border-color: rgba(61, 220, 151, .5); color: #b8f5da; }
        .alert-error { background: rgba(255, 107, 107, .15); border-color: rgba(255, 107, 107, .5); color: #ffc9c9; }

        /* ---------- Badge ---------- */
        .badge {
            display: inline-block; padding: 3px 12px; font-size: 12px; font-weight: 600;
            border-radius: 999px; border: 1px solid; white-space: nowrap;
        }
        .badge-menunggu, .badge-sedang { color: var(--warn); border-color: rgba(255, 200, 87, .6); background: rgba(255, 200, 87, .12); }
        .badge-dikonfirmasi, .badge-mudah { color: var(--accent); border-color: rgba(61, 220, 151, .6); background: rgba(61, 220, 151, .12); }
        .badge-dibatalkan, .badge-sulit { color: var(--danger); border-color: rgba(255, 107, 107, .6); background: rgba(255, 107, 107, .12); }

        /* ---------- Kartu gunung ---------- */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 20px; }
        .gunung-card { padding: 22px; transition: .2s; }
        .gunung-card:hover { transform: translateY(-3px); background: var(--glass-strong); }
        .gunung-card h3 { font-size: 20px; font-weight: 600; }
        .gunung-card .lokasi { font-size: 13px; color: var(--muted); margin: 2px 0 14px; }
        .gunung-card p { font-size: 14px; color: var(--muted); margin-top: 5px; }
        .gunung-card p b { color: var(--text); font-weight: 600; }
        .gunung-card .card-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; }
        .gunung-card .aksi { margin-top: 18px; padding-top: 14px; border-top: 1px solid var(--line); }

        .empty { text-align: center; color: var(--muted); padding: 40px 0; grid-column: 1 / -1; }
        td.empty { grid-column: auto; }

        /* ---------- Foto kartu ---------- */
        .gunung-card .foto {
            width: 100%; height: 170px; object-fit: cover;
            border-radius: 12px; margin-bottom: 14px; display: block;
        }
        .gunung-card .foto-kosong {
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; color: var(--muted);
            background: rgba(255, 255, 255, .06); border: 1px dashed var(--line);
        }

        /* ---------- Aura (blob cahaya melayang) ---------- */
        .aura {
            position: fixed; border-radius: 50%; filter: blur(90px);
            opacity: .35; z-index: -1; pointer-events: none;
            animation: float 12s ease-in-out infinite;
        }
        .aura-1 { width: 420px; height: 420px; background: #3ddc97; top: -120px; left: -100px; }
        .aura-2 { width: 380px; height: 380px; background: #4aa8ff; bottom: -120px; right: -80px; animation-duration: 16s; animation-delay: -5s; }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%      { transform: translate(40px, -30px) scale(1.12); }
        }

        /* ---------- Glow ---------- */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(61, 220, 151, .45); }
            50%      { box-shadow: 0 0 0 10px rgba(61, 220, 151, 0); }
        }
        .btn:not(.btn-warning):not(.btn-danger):not(.btn-light) { animation: pulse-glow 2.4s infinite; }
        nav a.active { box-shadow: 0 0 18px rgba(61, 220, 151, .5); }

        .gunung-card:hover {
            box-shadow: 0 0 30px rgba(61, 220, 151, .30);
            border-color: rgba(61, 220, 151, .55);
        }
        .card, table { transition: box-shadow .3s; }
        .card:hover { box-shadow: 0 0 30px rgba(61, 220, 151, .18); }

        /* ---------- Muncul pelan saat halaman dibuka ---------- */
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        main > * { animation: fade-up .5s ease backwards; }
        .grid > * { animation: fade-up .5s ease backwards; }
        .grid > *:nth-child(2) { animation-delay: .08s; }
        .grid > *:nth-child(3) { animation-delay: .16s; }
        .grid > *:nth-child(4) { animation-delay: .24s; }
        .grid > *:nth-child(5) { animation-delay: .32s; }

        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition: none !important; }
        }

        @media (max-width: 640px) {
            header { border-radius: 24px; padding: 12px 16px; top: 8px; }
            main { padding: 28px 14px; }
            .top h2 { font-size: 22px; }
            table { display: block; overflow-x: auto; }
        }
    </style>
</head>
<body>

    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/bg.mp4') }}" type="video/mp4">
    </video>
    <div class="bg-overlay"></div>
    <div class="aura aura-1"></div>
    <div class="aura aura-2"></div>

    <header>
        <div class="brand">Hiker<span>Best</span></div>
        <nav>
            <a href="{{ route('gunung.index') }}" class="{{ request()->routeIs('gunung.*') ? 'active' : '' }}">Gunung</a>
            <a href="{{ route('peralatan.index') }}" class="{{ request()->routeIs('peralatan.*') ? 'active' : '' }}">Peralatan</a>
            <a href="{{ route('booking.index') }}" class="{{ request()->routeIs('booking.*') ? 'active' : '' }}">Booking</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; 2026 HikerBest
    </footer>

</body>
</html>