@extends('admin')

@section('titulo','Reportes de Gestión')

@section('contenido')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0"><i class="fas fa-chart-bar text-primary me-2"></i> Panel de Reportes</h3>
        <span class="text-muted">Periodo: {{ \Carbon\Carbon::parse($desde)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($hasta)->format('d/m/Y') }}</span>
    </div>

    {{-- FILTRO DE FECHAS --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('reportes') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted text-uppercase">Desde</label>
                    <input type="date" name="desde" class="form-control" value="{{ $desde }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted text-uppercase">Hasta</label>
                    <input type="date" name="hasta" class="form-control" value="{{ $hasta }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">
                        <i class="fas fa-sync-alt me-1"></i> Actualizar Reporte
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TARJETAS DE RESULTADOS --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-success border-4">
                <small class="text-muted fw-bold text-uppercase">Ventas Totales (+)</small>
                <h2 class="fw-bold text-success mb-0">$ {{ number_format($totalVentas) }}</h2>
                <p class="small text-muted mb-0">{{ $conteoVentas }} transacciones</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-danger border-4">
                <small class="text-muted fw-bold text-uppercase">Egresos / Gastos (-)</small>
                <h2 class="fw-bold text-danger mb-0">$ {{ number_format($totalEgresos) }}</h2>
                <p class="small text-muted mb-0">Salidas de caja manuales</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary text-white">
                <small class="fw-bold text-uppercase opacity-75">Balance Neto (Ganancia)</small>
                <h2 class="fw-bold mb-0">$ {{ number_format($balance) }}</h2>
                <p class="small mb-0 opacity-75">Dinero real en el periodo</p>
            </div>
        </div>
    </div>

    {{-- SECCIÓN DE ACCIONES RÁPIDAS --}}
    <h5 class="fw-bold mb-3 text-muted text-uppercase small">Accesos Rápidos</h5>
    <div class="row g-3">
        <div class="col-md-4">
            <a href="#" class="btn btn-white shadow-sm border-0 rounded-4 p-3 w-100 text-start d-flex align-items-center">
                <div class="bg-light p-3 rounded-3 me-3 text-primary">
                    <i class="fas fa-calendar-day fa-lg"></i>
                </div>
                <div>
                    <span class="d-block fw-bold text-dark">Ventas Diarias</span>
                    <small class="text-muted">Ver detalle de hoy</small>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-white shadow-sm border-0 rounded-4 p-3 w-100 text-start d-flex align-items-center">
                <div class="bg-light p-3 rounded-3 me-3 text-info">
                    <i class="fas fa-calendar-alt fa-lg"></i>
                </div>
                <div>
                    <span class="d-block fw-bold text-dark">Ventas Mensuales</span>
                    <small class="text-muted">Resumen del mes actual</small>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-white shadow-sm border-0 rounded-4 p-3 w-100 text-start d-flex align-items-center">
                <div class="bg-light p-3 rounded-3 me-3 text-warning">
                    <i class="fas fa-star fa-lg"></i>
                </div>
                <div>
                    <span class="d-block fw-bold text-dark">Top Productos</span>
                    <small class="text-muted">Lo más vendido</small>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    .btn-white { background: white; transition: transform 0.2s; }
    .btn-white:hover { transform: translateY(-5px); background: #f8f9fa; }
</style>
@endsection