@extends('layouts.app')
@section('titulo', app()->getLocale() == 'es' ? 'Inicio' : 'Home')

@section('contenido')

{{-- HERO --}}
<div style="background: linear-gradient(135deg, #1F4E79, #2E74B5); color:#fff; padding: 80px 0;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">
            {{ app()->getLocale() == 'es' ? 'Descubre Bolivia' : 'Discover Bolivia' }}
        </h1>
        <p class="lead mb-4">
            {{ app()->getLocale() == 'es'
                ? 'Encuentra los mejores destinos, temporadas optimas y eventos culturales'
                : 'Find the best destinations, optimal seasons and cultural events' }}
        </p>
        <form action="{{ route('buscar') }}" method="GET" class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group input-group-lg">
                    <input type="text" name="q" class="form-control"
                           placeholder="{{ app()->getLocale() == 'es' ? 'Buscar destino...' : 'Search destination...' }}">
                    <button class="btn btn-warning fw-bold" type="submit">
                        <i class="bi bi-search"></i>
                        {{ app()->getLocale() == 'es' ? 'Buscar' : 'Search' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container py-5">

    {{-- CATEGORIAS --}}
    <h2 class="mb-4 fw-bold" style="color:#1F4E79">
        {{ app()->getLocale() == 'es' ? 'Explora por categoria' : 'Explore by category' }}
    </h2>
    <div class="row g-3 mb-5">
        @foreach($categorias as $cat)
        <div class="col-6 col-md-2">
            <a href="{{ route('destinos.listado', ['categoria_id' => $cat->id]) }}"
               class="text-decoration-none">
                <div class="card text-center h-100 border-0 shadow-sm">
                    <div class="card-body py-3">
                        <i class="bi bi-geo-alt-fill fs-2" style="color:#1F4E79"></i>
                        <p class="mb-0 mt-2 fw-500 small">{{ $cat->nombre }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- DESTINOS DESTACADOS --}}
    <h2 class="mb-4 fw-bold" style="color:#1F4E79">
        {{ app()->getLocale() == 'es' ? 'Destinos destacados' : 'Featured destinations' }}
    </h2>
    <div class="row g-4">
        @forelse($destacados as $destino)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                @if($destino->imagen_portada)
                    <img src="{{ asset('storage/'.$destino->imagen_portada) }}"
                         class="card-img-top" alt="{{ $destino->nombre }}">
                @else
                    <div class="card-img-top d-flex align-items-center justify-content-center"
                         style="background:#E3F2FD; height:200px;">
                        <i class="bi bi-image text-muted fs-1"></i>
                    </div>
                @endif
                <div class="card-body">
                    <span class="badge mb-2" style="background:#1F4E79">
                        {{ $destino->categoria->nombre }}
                    </span>
                    <h5 class="card-title fw-bold">{{ $destino->nombre }}</h5>
                    <p class="text-muted small">
                        <i class="bi bi-geo-alt"></i> {{ $destino->departamento }}
                    </p>
                    <p class="card-text small">
                        {{ Str::limit($destino->descripcion, 100) }}
                    </p>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('destinos.detalle', $destino->id) }}"
                       class="btn btn-primary w-100">
                        {{ app()->getLocale() == 'es' ? 'Ver mas' : 'See more' }}
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                {{ app()->getLocale() == 'es'
                    ? 'No hay destinos destacados aun. Agrega algunos desde el panel admin.'
                    : 'No featured destinations yet. Add some from the admin panel.' }}
            </div>
        </div>
        @endforelse
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('destinos.listado') }}" class="btn btn-outline-primary btn-lg">
            {{ app()->getLocale() == 'es' ? 'Ver todos los destinos' : 'View all destinations' }}
        </a>
    </div>

</div>
@endsection