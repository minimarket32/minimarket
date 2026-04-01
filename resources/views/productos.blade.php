@extends('admin')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-success mb-0">Gestión de Inventario</h4>
        <p class="text-muted small">Panel de control de productos y existencias</p>
    </div>
    
    {{-- Botón de Nuevo Producto --}}
    <button class="btn btn-success rounded-pill px-4 py-2 shadow-sm fw-bold" 
            data-bs-toggle="modal" 
            data-bs-target="#modalProducto"
            onclick="Livewire.dispatch('resetCampos')">
        <i class="fas fa-plus-circle me-1"></i> Nuevo Producto
    </button>
</div>

{{-- Mensajes de Éxito --}}
@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius:15px;">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

{{-- Componente Principal (El modal ahora vive aquí dentro) --}}
<livewire:productos-buscador />

{{-- SCRIPTS DE CONTROL DE MODAL --}}
<script>
    window.addEventListener('abrirModalProducto', event => {
        const modalElement = document.getElementById('modalProducto');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    });

    window.addEventListener('cerrarModalProducto', event => {
        const modalElement = document.getElementById('modalProducto');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) modal.hide();

        setTimeout(() => {
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) backdrop.remove();
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }, 100);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('modalProducto');
        if(modalElement) {
            modalElement.addEventListener('hidden.bs.modal', function () {
                Livewire.dispatch('resetCampos');
            });
        }
    });
</script>

<style>
    .btn-success { transition: transform 0.2s; }
    .btn-success:hover { transform: scale(1.02); }
</style>
@endsection