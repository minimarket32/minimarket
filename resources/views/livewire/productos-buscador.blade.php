<div>
    {{-- ALERTAS --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:15px; background-color: #d1e7dd; color: #0f5132;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- BARRA DE FILTROS --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:20px;">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label small fw-bold text-muted">Buscar Producto</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                        <input wire:model.live="search" type="text" class="form-control border-0 bg-light shadow-none" placeholder="Nombre o código de barras">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted">Categoría</label>
                    <select wire:model.live="categoria" class="form-select border-0 bg-light shadow-none">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLA DE PRODUCTOS --}}
    <div class="card border-0 shadow-sm" style="border-radius:20px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">Imagen</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                    <tr wire:key="prod-{{ $producto->id }}">
                        <td class="ps-4">
                            @php
                                // Si 'imagen' en la DB tiene contenido, lo usamos. Si no, usamos el avatar.
                                $urlImagen = (!empty($producto->imagen)) 
                                    ? $producto->imagen 
                                    : 'https://ui-avatars.com/api/?name='.urlencode($producto->nombre).'&background=EBF4FF&color=7F9CF5&bold=true';
                            @endphp
                            <img src="{{ $urlImagen }}" 
                                 class="rounded shadow-sm" 
                                 style="width:50px; height:50px; object-fit: cover; border: 1px solid #f0f0f0;"
                                 onerror="this.src='https://via.placeholder.com/50?text=Error'">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $producto->nombre }}</div>
                            <small class="text-muted">COD: {{ $producto->codigo_barras ?? 'S/N' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info-subtle text-info border border-info rounded-pill px-3">
                                {{ $producto->categoria->nombre ?? 'General' }}
                            </span>
                        </td>
                        <td class="fw-bold text-success">$ {{ number_format($producto->precio_venta, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $producto->stock <= 5 ? 'bg-danger-subtle text-danger' : 'bg-light text-dark' }} border">
                                {{ $producto->stock }} unid.
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button wire:click="editar({{ $producto->id }})" class="btn btn-sm text-warning border-0 p-2">
                                    <i class="fas fa-edit fa-lg"></i>
                                </button>
                                <button onclick="confirm('¿Eliminar producto?') || event.stopImmediatePropagation()" wire:click="eliminar({{ $producto->id }})" class="btn btn-sm text-danger border-0 p-2">
                                    <i class="fas fa-trash fa-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted">No se encontraron productos</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL PARA CREAR/EDITAR --}}
    <div wire:ignore.self class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 20px;">
                <div class="modal-header bg-success text-white border-0" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-box-open me-2"></i> {{ $modo_editar ? 'Editar Producto' : 'Nuevo Producto' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" wire:click="resetCampos"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Código de Barras</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-barcode"></i></span>
                                <input type="text" wire:model.live="codigo_barras" class="form-control border-0 bg-light shadow-none" placeholder="Escanee o escriba el código">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Nombre del Producto</label>
                            <input type="text" wire:model="nombre" class="form-control border-0 bg-light shadow-none">
                            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted">Precio Compra</label>
                            <input type="number" wire:model.live="precio_compra" class="form-control border-0 bg-light shadow-none">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted">Precio Venta (+20%)</label>
                            <input type="number" wire:model="precio_venta" class="form-control border-0 bg-light shadow-none" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-muted">Stock</label>
                            <input type="number" wire:model="stock" class="form-control border-0 bg-light shadow-none">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Categoría</label>
                            <select wire:model="categoria_id" class="form-select border-0 bg-light shadow-none">
                                <option value="">Seleccione...</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">URL de la Imagen</label>
                            <input type="text" wire:model="imagen" class="form-control border-0 bg-light shadow-none" placeholder="https://ejemplo.com/foto.jpg">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" wire:click="resetCampos">Cerrar</button>
                    <button type="button" wire:click="guardar" class="btn btn-success rounded-pill px-5 fw-bold shadow">
                        {{ $modo_editar ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- EVENTOS JAVASCRIPT --}}
    <script>
        window.addEventListener('cerrarModalProducto', event => {
            const modalElement = document.getElementById('modalProducto');
            const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
            modal.hide();
        });
        window.addEventListener('abrirModalProducto', event => {
            const modal = new bootstrap.Modal(document.getElementById('modalProducto'));
            modal.show();
        });
    </script>
</div>