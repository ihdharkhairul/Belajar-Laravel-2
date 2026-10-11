<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | HikerBest</title>

    <style>
        :root {
            --blue: #3b82c4;
            --blue-dark: #2a65a0;
            --bg: #eef5fb;
            --line: #d5e3f0;
            --text: #1f3a57;
            --muted: #5f7a94;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            padding: 16px 40px;
            background: var(--blue);
            color: #fff;
        }
        .brand { font-size: 20px; font-weight: 600; }
        nav { display: flex; gap: 6px; }
        nav a {
            color: #fff; text-decoration: none; font-size: 14px;
            padding: 8px 16px; border-radius: 6px; opacity: .85;
        }
        nav a:hover { background: rgba(255,255,255,.15); opacity: 1; }
        nav a.active { background: rgba(255,255,255,.25); opacity: 1; }

        main { flex: 1; width: 100%; max-width: 1000px; margin: 0 auto; padding: 30px 20px; }
        footer { padding: 14px; text-align: center; font-size: 13px; color: var(--muted); }

        .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .top h2 { font-size: 24px; }

        .card { background: #fff; border: 1px solid var(--line); border-radius: 10px; padding: 24px; }

        table { width: 100%; border-collapse: collapse; background: #fff; border: 1px solid var(--line); }
        th, td { padding: 12px 14px; text-align: left; font-size: 14px; border-bottom: 1px solid var(--line); }
        th { background: #f4f9fd; color: var(--muted); font-weight: 600; }
        tr:last-child td { border-bottom: none; }

        .btn {
            display: inline-block; padding: 8px 16px; font-size: 14px; color: #fff;
            background: var(--blue); border: none; border-radius: 6px;
            text-decoration: none; cursor: pointer;
        }
        .btn:hover { background: var(--blue-dark); }
        .btn-warning { background: #e0a030; }
        .btn-warning:hover { background: #c78a1f; }
        .btn-danger { background: #d9534f; }
        .btn-danger:hover { background: #bb3f3b; }
        .btn-light { background: #fff; color: var(--text); border: 1px solid var(--line); }
        .btn-light:hover { background: #f4f9fd; }
        .aksi { display: flex; gap: 6px; }
        .aksi form { display: inline; }

        .field { margin-bottom: 18px; }
        .field label { display: block; font-size: 14px; color: var(--muted); margin-bottom: 5px; }
        .field input, .field select, .field textarea {
            width: 100%; padding: 10px 12px; font-size: 15px; font-family: inherit;
            color: var(--text); background: #fff; border: 1px solid var(--line);
            border-radius: 6px; outline: none;
        }
        .field input:focus, .field select:focus, .field textarea:focus { border-color: var(--blue); }
        .error-text { display: block; margin-top: 4px; font-size: 13px; color: #d9534f; }

        .alert { padding: 12px 16px; margin-bottom: 20px; font-size: 14px; border-radius: 6px; border: 1px solid; }
        .alert-success { background: #e3f6ec; border-color: #8fd3ae; color: #1f6b43; }
        .alert-error { background: #fdeaea; border-color: #f0a3a3; color: #9b2c2c; }

        .badge { padding: 3px 11px; font-size: 12px; border-radius: 999px; border: 1px solid; white-space: nowrap; }
        .badge-menunggu, .badge-sedang { color: #8a6d00; border-color: #e6c84a; background: #fff6d6; }
        .badge-dikonfirmasi, .badge-mudah { color: #1f6b43; border-color: #8fd3ae; background: #e3f6ec; }
        .badge-dibatalkan, .badge-sulit { color: #a82424; border-color: #ec8a8a; background: #ffe3e3; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 18px; }
        .gunung-card { background: #fff; border: 1px solid var(--line); border-radius: 10px; padding: 20px; }
        .gunung-card h3 { font-size: 19px; margin-bottom: 4px; }
        .gunung-card .lokasi { font-size: 13px; color: var(--muted); margin-bottom: 12px; }
        .gunung-card p { font-size: 14px; color: var(--muted); margin-top: 5px; }
        .gunung-card p b { color: var(--text); }
        .gunung-card .card-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; }
        .gunung-card .aksi { margin-top: 16px; }

        .empty { text-align: center; color: var(--muted); padding: 30px; }

        @media (max-width: 600px) {
            header { padding: 14px 20px; }
        }
    </style>
</head>
<body>

    <header>
        <div class="brand">HikerBest</div>
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