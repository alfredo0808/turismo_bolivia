<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel Admin') — Turismo Bolivia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --azul: #1F4E79; }
        body { background: #f4f6f9; }
        .sidebar { min-height: 100vh; background: var(--azul); width: 250px; position: fixed; top: 0; left: 0; padding-top: 20px; }
        .sidebar a { color: rgba(255,255,255,.75); display: block; padding: 10px 20px; text-decoration: none; }
        .sidebar a:hover, .sidebar a.active { color: #fff; background: rgba(255,255,255,.1); }
        .sidebar .brand { color: #fff; font-weight: 700; font-size: 1.1rem; padding: 10px 20px 20px; border-bottom: 1px solid rgba(255,255,255,.2); margin-bottom: 10px; }
        .main-content { margin-left: 250px; padding: 20px; }
        .topbar { background: #fff; padding: 12px 20px; border-bottom: 1px solid #dee2e6; margin: -20px -20px 20px; display: flex; justify-content: space-between; align-items: center; }
        .stat-card { background: #fff; border-radius: 10px; padding: 20px; border-left: 4px solid var(--azul); }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="brand">
        <i class="bi bi-map-fill"></i> Turismo Bolivia
    </div>
    <a href="{{ route('admin.panel') }}" class="{{ request()->routeIs('admin.panel') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>
    <a href="{{ route('admin.destinos.index') }}" class="{{ request()->routeIs('admin.destinos.*') ? 'active' : '' }}">
        <i class="bi bi-geo-alt-fill me-2"></i> Destinos
    </a>
    <a href="{{ route('admin.temporadas.index') }}" class="{{ request()->routeIs('admin.temporadas.*') ? 'active' : '' }}">
        <i class="bi bi-calendar3 me-2"></i> Temporadas
    </a>
    <a href="{{ route('admin.eventos.index') }}" class="{{ request()->routeIs('admin.eventos.*') ? 'active' : '' }}">
        <i class="bi bi-star-fill me-2"></i> Eventos
    </a>
    <a href="{{ route('admin.usuarios.index') }}" class="{{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
        <i class="bi bi-people-fill me-2"></i> Usuarios
    </a>
    <hr style="border-color:rgba(255,255,255,.2)">
    <a href="{{ route('home') }}" target="_blank">
        <i class="bi bi-eye me-2"></i> Ver sitio web
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="background:none;border:none;width:100%;text-align:left;color:rgba(255,255,255,.75);padding:10px 20px;cursor:pointer;">
            <i class="bi bi-box-arrow-left me-2"></i> Cerrar sesion
        </button>
    </form>
</div>

{{-- CONTENIDO PRINCIPAL --}}
<div class="main-content">
    <div class="topbar">
        <h5 class="mb-0">@yield('titulo', 'Dashboard')</h5>
        <span class="text-muted">
            <i class="bi bi-person-circle me-1"></i>
            {{ Auth::user()->nombre ?? 'Administrador' }}
        </span>
    </div>

    {{-- Alertas --}}
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

    @yield('contenido')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>