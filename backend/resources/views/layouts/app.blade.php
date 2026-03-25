<!DOCTYPE html>
<html lang="{{ session('idioma', 'es') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Turismo Bolivia')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --azul: #1F4E79; --azul2: #2E74B5; }
        .navbar-brand { font-weight: 700; color: #fff !important; }
        .navbar { background-color: var(--azul) !important; }
        .btn-primary { background-color: var(--azul); border-color: var(--azul); }
        .card-img-top { height: 200px; object-fit: cover; }
        footer { background-color: var(--azul); color: #fff; padding: 2rem 0; margin-top: 3rem; }
    </style>
    @yield('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-map-fill"></i> Turismo Bolivia
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        {{ app()->getLocale() == 'es' ? 'Inicio' : 'Home' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('destinos.listado') }}">
                        {{ app()->getLocale() == 'es' ? 'Destinos' : 'Destinations' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('temporadas.index') }}">
                        {{ app()->getLocale() == 'es' ? 'Temporadas' : 'Seasons' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('eventos.index') }}">
                        {{ app()->getLocale() == 'es' ? 'Eventos' : 'Events' }}
                    </a>
                </li>
            </ul>
            {{-- Buscador --}}
            <form class="d-flex me-3" action="{{ route('buscar') }}" method="GET">
                <input class="form-control me-2" type="search" name="q"
                       placeholder="{{ app()->getLocale() == 'es' ? 'Buscar destino...' : 'Search destination...' }}">
                <button class="btn btn-outline-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            {{-- Selector de idioma --}}
            <div class="d-flex gap-2">
                <a href="{{ route('idioma.cambiar', 'es') }}"
                   class="btn btn-sm {{ session('idioma','es') == 'es' ? 'btn-light' : 'btn-outline-light' }}">
                   ES
                </a>
                <a href="{{ route('idioma.cambiar', 'en') }}"
                   class="btn btn-sm {{ session('idioma','es') == 'en' ? 'btn-light' : 'btn-outline-light' }}">
                   EN
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- ALERTAS --}}
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

{{-- CONTENIDO --}}
@yield('contenido')

{{-- FOOTER --}}
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="bi bi-map-fill"></i> Turismo Bolivia</h5>
                <p class="text-white-50">Sistema centralizado de informacion turistica de Bolivia.</p>
            </div>
            <div class="col-md-4">
                <h6>{{ app()->getLocale() == 'es' ? 'Navegacion' : 'Navigation' }}</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('destinos.listado') }}" class="text-white-50">
                        {{ app()->getLocale() == 'es' ? 'Destinos' : 'Destinations' }}</a></li>
                    <li><a href="{{ route('temporadas.index') }}" class="text-white-50">
                        {{ app()->getLocale() == 'es' ? 'Temporadas' : 'Seasons' }}</a></li>
                    <li><a href="{{ route('eventos.index') }}" class="text-white-50">
                        {{ app()->getLocale() == 'es' ? 'Eventos' : 'Events' }}</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>{{ app()->getLocale() == 'es' ? 'Administracion' : 'Administration' }}</h6>
                <a href="{{ route('login') }}" class="text-white-50">
                    {{ app()->getLocale() == 'es' ? 'Panel Administrativo' : 'Admin Panel' }}
                </a>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center text-white-50 mb-0">
            &copy; {{ date('Y') }} Turismo Bolivia — Universidad Adventista de Bolivia
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>