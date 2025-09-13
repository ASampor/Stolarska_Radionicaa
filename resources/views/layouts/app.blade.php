<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wood Design Cicka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            Wood Design Cicka <small class="fw-normal">Stolarska radionica</small>
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active btn btn-dark text-white' : '' }}" href="{{ route('home') }}">
                         Početna
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('register.form') ? 'active btn btn-dark text-white' : '' }}" href="{{ route('register.form') }}">
                        Registracija
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login.form') ? 'active btn btn-dark text-white' : '' }}" href="{{ route('login.form') }}">
                        Prijava
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    @yield('content')
</div>

<footer class="bg-light text-center py-3 mt-5 border-top">
    <p class="mb-0">&copy; {{ date('Y') }} Wood Design Cicka</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
