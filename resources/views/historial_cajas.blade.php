@extends('admin')

@section('titulo', 'Historial de Cierres de Caja')

@section('contenido')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">Fecha Apertura</th>
                        <th class="py-3">Fecha Cierre</th>
                        <th class="py-3">Monto Inicial</th>
                        <th class="py-3">Ventas</th>
                        <th class="py-3">Total en Caja</th>
                        <th class="py-3 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historial as $h)
                    <tr>
                        <td class="small">{{ \Carbon\Carbon::parse($h->fecha_apertura)->format('d/m/Y H:i') }}</td>
                        <td class="small">
                            {{ $h->fecha_cierre ? \Carbon\Carbon::parse($h->fecha_cierre)->format('d/m/Y H:i') : '---' }}
                        </td>
                        <td>$ {{ number_format($h->monto_apertura, 2) }}</td>
                        <td class="text-success fw-bold">$ {{ number_format($h->total_ventas, 2) }}</td>
                        <td class="text-primary fw-bold">$ {{ number_format($h->monto_cierre, 2) }}</td>
                        <td class="text-center">
                            @if($h->estado == 'abierta')
                                <span class="badge bg-success rounded-pill px-3">ABIERTA</span>
                            @else
                                <span class="badge bg-secondary rounded-pill px-3">CERRADA</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open d-block mb-2 fa-2x"></i>
                            No hay registros de sesiones anteriores.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection