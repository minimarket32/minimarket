@extends('admin')

@section('titulo','Inventario')

@section('contenido')

<h4 class="mb-4">Inventario General</h4>

<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark text-center">
        <tr>
            <th>Producto</th>
            <th>Stock</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @forelse($productos as $producto)
            <tr class="text-center">
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    @if($producto->stock > 0)
                        <span class="badge bg-success">
                            Disponible
                        </span>
                    @else
                        <span class="badge bg-danger">
                            Agotado
                        </span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">
                    No hay productos en inventario
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection