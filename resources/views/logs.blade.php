@extends('admin')

@section('titulo', 'Auditoría de Logs')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold text-dark">
        <i class="fas fa-database me-2 text-success"></i>Registros de Actividad (Base de Datos)
    </h5>
    
    <form action="{{ route('logs.clear') }}" method="POST" onsubmit="return confirm('¿Está seguro de vaciar todos los registros de la base de datos?')">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm">
            <i class="fas fa-trash-alt me-1"></i> Limpiar Tabla
        </button>
    </form>
</div>

<div class="bg-dark p-3 rounded-4 shadow-sm" style="height: 600px; overflow-y: auto; border: 1px solid #333;">
    <div class="font-monospace" style="font-size: 0.85rem; line-height: 1.5;">
        @if(isset($logs) && count($logs) > 0)
            @foreach($logs as $log)
                <div class="mb-2 pb-1 border-bottom border-secondary border-opacity-25">
                    {{-- Fecha --}}
                    <span class="text-secondary opacity-75">[{{ $log->fecha_registro }}]</span>
                    
                    {{-- Acción --}}
                    <span class="text-info fw-bold">[{{ strtoupper($log->accion) }}]</span>
                    
                    {{-- Descripción con lógica de color --}}
                    <span class="@if(str_contains(strtoupper($log->accion), 'FALLIDO') || str_contains(strtoupper($log->descripcion), 'ERROR')) text-danger fw-bold @else text-success @endif">
                        >>> {{ $log->descripcion }}
                    </span>

                    {{-- IP Origen --}}
                    <span class="text-muted small opacity-50 float-end">IP: {{ $log->ip_origen }}</span>
                </div>
            @endforeach
        @else
            <div class="text-center py-5">
                <i class="fas fa-ghost fa-3x text-secondary opacity-25 mb-3"></i>
                <p class="text-secondary">No hay eventos registrados en la base de datos.</p>
            </div>
        @endif
    </div>
</div>

<div class="mt-3 text-muted small">
    <i class="fas fa-info-circle me-1"></i> Fuente de datos: Tabla <code>logs</code> en base de datos <code>minimarket</code>.
</div>
@endsection