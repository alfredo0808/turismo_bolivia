@extends('layouts.admin')
@section('titulo', 'Dashboard')

@section('contenido')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="text-muted small mb-1">Total Destinos</div>
            <div class="fs-2 fw-bold" style="color:#1F4E79">{{ $stats['destinos'] }}</div>
            <i class="bi bi-geo-alt-fill text-muted"></i>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-color:#1D9E75">
            <div class="text-muted small mb-1">Total Temporadas</div>
            <div class="fs-2 fw-bold" style="color:#1D9E75">{{ $stats['temporadas'] }}</div>
            <i class="bi bi-calendar3 text-muted"></i>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-color:#E65100">
            <div class="text-muted small mb-1">Total Eventos</div>
            <div class="fs-2 fw-bold" style="color:#E65100">{{ $stats['eventos'] }}</div>
            <i class="bi bi-star-fill text-muted"></i>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="border-color:#6A1B9A">
            <div class="text-muted small mb-1">Consultas Hoy</div>
            <div class="fs-2 fw-bold" style="color:#6A1B9A">{{ $stats['consultas'] }}</div>
            <i class="bi bi-eye-fill text-muted"></i>
        </div>
    </div>
</div>

{{-- Accesos rapidos --}}
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header fw-bold" style="background:#1F4E79; color:#fff">
                Acciones rapidas
            </div>
            <div class="card-body d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.destinos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Nuevo Destino
                </a>
                <a href="{{ route('admin.temporadas.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Nueva Temporada
                </a>
                <a href="{{ route('admin.eventos.create') }}" class="btn btn-warning">
                    <i class="bi bi-plus-circle me-1"></i> Nuevo Evento
                </a>
                <a href="{{ route('admin.usuarios.create') }}" class="btn btn-secondary">
                    <i class="bi bi-plus-circle me-1"></i> Nuevo Usuario
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Consultas recientes --}}
<div class="card border-0 shadow-sm">
    <div class="card-header fw-bold" style="background:#1F4E79; color:#fff">
        Consultas recientes
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Destino</th>
                    <th>Tipo</th>
                    <th>Idioma</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recientes as $consulta)
                <tr>
                    <td>{{ $consulta->destino->nombre ?? '—' }}</td>
                    <td><span class="badge bg-secondary">{{ $consulta->tipo_consulta }}</span></td>
                    <td><span class="badge" style="background:#1F4E79">{{ strtoupper($consulta->idioma) }}</span></td>
                    <td>{{ $consulta->fecha }}</td>
                    <td>{{ $consulta->hora }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">
                        No hay consultas registradas aun
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection