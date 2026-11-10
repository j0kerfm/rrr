<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Кинотеатр' }} — Синема</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --cine-bg: #0e0f13;
            --cine-panel: #171921;
            --cine-line: #262a36;
            --cine-accent: #f5a623;
            --cine-accent-soft: rgba(245,166,35,.12);
            --cine-text: #e9eaf0;
            --cine-muted: #8b90a0;
        }
        body {
            background: var(--cine-bg);
            color: var(--cine-text);
            font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
        }
        h1,h2,h3,h4,h5,.page-title { letter-spacing: -.02em; font-weight: 700; }
        .page-title::before {
            content: "";
            display: inline-block;
            width: 6px; height: 1.1em;
            background: var(--cine-accent);
            border-radius: 3px;
            margin-right: .6rem;
            vertical-align: -.15em;
        }
        a { text-decoration: none; }

        /* Навбар */
        .cine-nav {
            background: rgba(14,15,19,.85) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--cine-line);
        }
        .cine-nav .navbar-brand {
            font-weight: 800; letter-spacing: .5px;
            color: var(--cine-accent) !important;
        }
        .cine-nav .nav-link { color: var(--cine-muted) !important; border-radius: 999px; padding: .4rem .9rem !important; }
        .cine-nav .nav-link:hover { color: var(--cine-text) !important; background: var(--cine-panel); }

        /* Кнопки-пилюли */
        .btn { border-radius: 999px; font-weight: 600; padding: .45rem 1.1rem; }
        .btn-primary { background: var(--cine-accent); border-color: var(--cine-accent); color: #12131a; }
        .btn-primary:hover { background: #ffb944; border-color: #ffb944; color: #12131a; }
        .btn-outline-warning { color: var(--cine-accent); border-color: var(--cine-accent); }
        .btn-outline-warning:hover { background: var(--cine-accent-soft); color: var(--cine-accent); }
        .btn-outline-danger { border-radius: 999px; }
        .btn-outline-secondary { color: var(--cine-muted); border-color: var(--cine-line); }
        .btn-outline-secondary:hover { background: var(--cine-panel); color: var(--cine-text); border-color: var(--cine-line); }
        .btn-sm { padding: .3rem .8rem; font-size: .8rem; }

        /* Карточки */
        .card {
            background: var(--cine-panel);
            border: 1px solid var(--cine-line);
            border-radius: 14px;
            box-shadow: none;
        }
        .card-footer { background: transparent; border-top: 1px solid var(--cine-line); }
        .card-header { background: transparent; border-bottom: 1px solid var(--cine-line); }

        /* Поля */
        .form-control, .form-select {
            background: var(--cine-bg);
            border: 1px solid var(--cine-line);
            color: var(--cine-text);
            border-radius: 10px;
        }
        .form-control:focus, .form-select:focus {
            background: var(--cine-bg);
            color: var(--cine-text);
            border-color: var(--cine-accent);
            box-shadow: 0 0 0 .2rem var(--cine-accent-soft);
        }
        .form-control::placeholder { color: #5a5f70; }
        .form-label { color: var(--cine-muted); font-size: .82rem; text-transform: uppercase; letter-spacing: .05em; font-weight: 600; }
        .form-text { color: #5a5f70; }

        /* Таблицы как «списки» */
        .cine-table { margin: 0; }
        .cine-table thead { display: none; }
        .cine-table > tbody > tr {
            background: var(--cine-panel);
            border: 1px solid var(--cine-line);
            border-radius: 12px;
            display: table-row;
        }
        .cine-table > tbody > tr + tr td { border-top: 1px solid var(--cine-line); }
        .cine-table > tbody > tr:hover { background: #1d2029; }
        .cine-table td { border: none; padding: .9rem 1rem; vertical-align: middle; }
        .cine-table td:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
        .cine-table td:last-child { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
        .cine-table code { color: var(--cine-muted); background: var(--cine-bg); padding: .15rem .4rem; border-radius: 6px; }

        .badge-soft {
            background: var(--cine-accent-soft);
            color: var(--cine-accent);
            border-radius: 999px;
            padding: .25rem .7rem;
            font-weight: 600;
            font-size: .75rem;
        }
        .badge-soft-gray {
            background: #232733;
            color: var(--cine-muted);
            border-radius: 999px;
            padding: .25rem .7rem;
            font-size: .75rem;
        }

        .alert { border-radius: 12px; border: 1px solid var(--cine-line); background: var(--cine-panel); color: var(--cine-text); }
        .alert-success { border-left: 4px solid #2ecc71; }
        .alert-danger { border-left: 4px solid #e74c3c; }
        .alert-info { border-left: 4px solid var(--cine-accent); }

        .pagination { --bs-pagination-bg: var(--cine-panel); --bs-pagination-border-color: var(--cine-line); --bs-pagination-color: var(--cine-text); --bs-pagination-hover-bg: #1d2029; --bs-pagination-active-bg: var(--cine-accent); --bs-pagination-active-border-color: var(--cine-accent); --bs-pagination-active-color: #12131a; }

        footer { border-top: 1px solid var(--cine-line); color: var(--cine-muted); font-size: .82rem; background: transparent; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg cine-nav sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi-play-btn-fill me-1"></i> СИНЕМА
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><i class="bi-grid me-1"></i> Афиша</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}"><i class="bi-bookmark me-1"></i> Мои билеты</a>
                        </li>
                    @endauth
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('panel') }}"><i class="bi-sliders me-1"></i> Админка</a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav gap-1">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Войти</a></li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm ms-2 align-self-center" href="{{ route('register') }}">Регистрация</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi-person-circle me-1"></i> {{ auth()->user()->email }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow" style="background:var(--cine-panel); border-color:var(--cine-line);">
                                <a class="dropdown-item" href="{{ route('profile') }}"><i class="bi-person me-1"></i> Профиль</a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="bi-box-arrow-right me-1"></i> Выйти</button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1 container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center py-3 mt-auto">
        © 2026 Синема. Все права защищены.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>