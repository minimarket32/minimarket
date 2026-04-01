@extends('admin')

@section('titulo','Gestión de Caja')

@section('contenido')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0"><i class="fas fa-cash-register text-primary me-2"></i> Control de Caja Diaria</h3>
        <a href="{{ route('caja.historial') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-history me-1"></i> Ver Historial
        </a>
    </div>

    {{-- Alertas de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                
                @if($sesion)
                    {{-- VISTA CUANDO LA CAJA ESTÁ ABIERTA --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted">Resumen de hoy: <strong>{{ \Carbon\Carbon::parse($sesion->fecha_apertura)->format('d/m/Y H:i') }}</strong></span>
                        <span class="badge bg-success p-2 px-3 rounded-pill">Caja Abierta</span>
                    </div>

                    <div class="row text-center">
                        <div class="col-md-4 border-end">
                            <small class="text-muted d-block small fw-bold text-uppercase">Apertura</small>
                            <h4 class="fw-bold text-dark">$ {{ number_format($apertura) }}</h4>
                        </div>
                        <div class="col-md-4 border-end">
                            <small class="text-muted d-block small fw-bold text-uppercase text-success">Ventas (Ingresos)</small>
                            <h4 class="fw-bold text-success">$ {{ number_format($ingresos) }}</h4>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block small fw-bold text-uppercase text-danger">Egresos (Gastos)</small>
                            <h4 class="fw-bold text-danger">$ {{ number_format($egresos) }}</h4>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small fw-bold">SALDO TOTAL EN CAJA</span>
                            <h2 class="fw-bold text-primary mb-0">$ {{ number_format($saldo_final) }}</h2>
                        </div>
                        
                        <div class="d-flex gap-2">
                            {{-- BOTÓN QUE ABRE EL MODAL DE EGRESOS --}}
                            <button type="button" class="btn btn-danger btn-lg fw-bold rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalEgreso">
                                <i class="fas fa-minus-circle me-2"></i> Gasto
                            </button>

                            <form action="{{ route('caja.cierre') }}" method="POST" onsubmit="return confirm('¿Está seguro de cerrar la caja hoy?')">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-lg fw-bold rounded-pill px-4 shadow-sm">
                                    <i class="fas fa-lock me-2"></i> Cerrar Caja
                                </button>
                            </form>
                        </div>
                    </div>

                @else
                    {{-- VISTA CUANDO LA CAJA ESTÁ CERRADA --}}
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-store-slash fa-4x text-muted opacity-50"></i>
                        </div>
                        <h4 class="fw-bold">La caja se encuentra cerrada</h4>
                        <p class="text-muted">Ingrese el monto inicial para abrir el turno.</p>
                        
                        <form action="{{ route('caja.abrir') }}" method="POST" class="mt-4 mx-auto" style="max-width: 350px;">
                            @csrf
                            <div class="input-group input-group-lg mb-3 shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-success fw-bold">$</span>
                                <input type="number" name="monto_apertura" class="form-control border-start-0" 
                                       placeholder="Monto de apertura" required min="0" step="0.01" autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow">
                                <i class="fas fa-door-open me-2"></i> ABRIR CAJA AHORA
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 p-4 bg-light">
                <h5 class="fw-bold mb-3 small text-uppercase">Ayuda y Cálculos</h5>
                <p class="small text-muted text-start">
                    <i class="fas fa-info-circle me-1 text-primary"></i> <strong>Cálculo:</strong> Saldo Final = (Apertura + Ventas) - Egresos.
                </p>
                <p class="small text-muted text-start">
                    <i class="fas fa-exclamation-triangle me-1 text-warning"></i> Recuerde registrar como <strong>Gasto</strong> cualquier salida de dinero para fletes, servicios o pagos a proveedores.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- MODAL PARA REGISTRAR EGRESOS --}}
<div class="modal fade" id="modalEgreso" tabindex="-1" aria-labelledby="modalEgresoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="modalEgresoLabel"><i class="fas fa-minus-circle me-2"></i>Registrar Salida de Dinero</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('egresos.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold small text-muted text-uppercase">Monto del Gasto</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light fw-bold text-danger border-end-0">$</span>
                            <input type="number" name="monto" class="form-control border-start-0 fw-bold" placeholder="0" required min="1" step="0.01">
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold small text-muted text-uppercase">¿En qué se gastó el dinero?</label>
                        <textarea name="descripcion" class="form-control" rows="3" placeholder="Ej: Pago a proveedor de gaseosas, compra de artículos de aseo..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">Guardar Egreso</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection