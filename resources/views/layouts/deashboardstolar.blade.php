<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wood Design Stolarska Radionica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            Wood Design Cicka <small class="fw-normal">Stolarska radionica</small>
        </a>

        <div class="collapse navbar-collapse justify-content-end">
            @php $user = auth()->user(); @endphp
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('stolar.dashboard') ? 'active btn btn-dark text-white' : '' }}" href="{{ route('stolar.dashboard') }}">
                        Zahtevi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('stolar.sastanci') ? 'active btn btn-dark text-white' : '' }}" href="{{ route('stolar.sastanci') }}">
                        Termini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('stolar.narudzbine') ? 'active btn btn-dark text-white' : '' }}" href="{{ route('stolar.narudzbine') }}">
                        Narudžbine
                    </a>
                </li>

            </ul>

            <span class="navbar-text text-secondary mx-3">
                {{ $user->ime }} {{ $user->prezime }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm">Odjava</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<footer class="bg-light text-center py-3 mt-5 border-top">
    <p class="mb-0">&copy; {{ date('Y') }} Wood Design Stolarska Radionica</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
