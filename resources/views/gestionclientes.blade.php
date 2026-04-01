@extends('admin')

@section('contenido')
<div class="container-fluid py-4">
    <header class="admin-header d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-3 shadow-sm">
        <div>
            <h3 class="fw-bold mb-0 text-dark">Gestión de Clientes</h3>
            <p class="text-muted small mb-0">Control centralizado de usuarios registrados</p>
        </div>
        
        <div class="dropdown">
            <button class="btn btn-light border rounded-pill dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-shield me-2 text-success"></i> {{ session('usuario_nombre', 'Administrador') }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2">
                <li><a class="dropdown-item" href="{{ route('perfil.edit') }}"><i class="fas fa-user-cog me-2"></i> Mi Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0 text-success"><i class="fas fa-users me-2"></i> Listado de Clientes</h4>
            <button class="btn btn-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente">
                <i class="fas fa-plus-circle me-2"></i> Registrar Nuevo
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-3 py-3 text-muted small">NOMBRE</th>
                        <th class="border-0 py-3 text-muted small">CORREO</th>
                        <th class="border-0 py-3 text-muted small">TELÉFONO</th>
                        <th class="border-0 text-center py-3 text-muted small">ESTADO</th>
                        <th class="border-0 text-center py-3 text-muted small">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td class="fw-bold px-3">{{ $cliente->nombre }}</td>
                            <td class="text-secondary">{{ $cliente->correo }}</td>
                            <td class="text-secondary">{{ $cliente->telefono ?? 'N/A' }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill {{ $cliente->estado == 'Activo' ? 'bg-success-subtle text-success border border-success' : 'bg-danger-subtle text-danger border border-danger' }} px-3 py-2">
                                    {{ $cliente->estado }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm rounded-pill bg-white px-2 py-1">
                                    <button class="btn btn-link text-primary p-1 me-2" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $cliente->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-1" onclick="return confirm('¿Eliminar cliente?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEditar{{ $cliente->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header bg-primary text-white rounded-top-4">
                                        <h5 class="modal-title fw-bold">Editar Cliente</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small">NOMBRE</label>
                                                <input type="text" name="nombre" class="form-control border-0 bg-light p-3" value="{{ $cliente->nombre }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small">CORREO</label>
                                                <input type="email" name="correo" class="form-control border-0 bg-light p-3" value="{{ $cliente->correo }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold small">ESTADO</label>
                                                <select name="estado" class="form-select border-0 bg-light p-3">
                                                    <option value="Activo" {{ $cliente->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                                    <option value="Inactivo" {{ $cliente->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No se encontraron clientes activos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-success text-white rounded-top-4">
                <h5 class="modal-title fw-bold">Nuevo Cliente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">NOMBRE COMPLETO</label>
                        <input type="text" name="nombre" class="form-control border-0 bg-light p-3" placeholder="Ej. Juan Pérez" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">CORREO ELECTRÓNICO</label>
                        <input type="email" name="correo" class="form-control border-0 bg-light p-3" placeholder="correo@ejemplo.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">TELÉFONO</label>
                        <input type="text" name="telefono" class="form-control border-0 bg-light p-3" placeholder="300 123 4567" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">CONTRASEÑA TEMPORAL</label>
                        <input type="password" name="password" class="form-control border-0 bg-light p-3" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-success rounded-pill w-100 p-3 fw-bold">Crear Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-success-subtle { background-color: #d1fae5; }
    .bg-danger-subtle { background-color: #fee2e2; }
    .btn-link:hover { transform: scale(1.1); transition: 0.2s; }
    .form-control:focus { background-color: #fff !important; border: 1px solid #198754 !important; box-shadow: none; }
</style>
@endsection