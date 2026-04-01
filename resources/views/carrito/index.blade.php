<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito - MiniMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .navbar-minimarket { background: linear-gradient(90deg, #1b5e20, #2e7d32); padding: 15px 0; }
        .card { border: none; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .img-carrito { width: 80px; height: 80px; object-fit: contain; border-radius: 10px; }
        .btn-checkout { background-color: #ff9800; border: none; color: white; font-weight: 700; border-radius: 12px; padding: 15px; }
        .btn-checkout:hover { background-color: #e68a00; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-minimarket mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('cliente') }}">
            <i class="fas fa-arrow-left me-2"></i> Volver a la Tienda
        </a>
    </div>
</nav>

<div class="container">
    <h2 class="fw-bold mb-4"><i class="fas fa-shopping-basket text-success me-2"></i> Tu Carrito</h2>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card p-4">
                @if(count($carrito) > 0)
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($carrito as $id => $detalles)
                                    @php 
                                        $subtotal = $detalles['precio'] * $detalles['cantidad']; 
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ str_starts_with($detalles['imagen'], 'http') ? $detalles['imagen'] : asset('img/'.$detalles['imagen']) }}" 
                                                     class="img-carrito me-3" alt="{{ $detalles['nombre'] }}">
                                                <span class="fw-bold">{{ $detalles['nombre'] }}</span>
                                            </div>
                                        </td>
                                        <td>$ {{ number_format($detalles['precio'], 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark p-2 border">{{ $detalles['cantidad'] }}</span>
                                        </td>
                                        <td class="fw-bold text-success">$ {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        <td>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <h4>Tu carrito está vacío</h4>
                        <a href="{{ route('cliente') }}" class="btn btn-success mt-3 rounded-pill">Ir a comprar</a>
                    </div>
                @endif
            </div>
        </div>

        @if(count($carrito) > 0)
        <div class="col-lg-4">
            <div class="card p-4">
                <h5 class="fw-bold mb-4">Resumen de Compra</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Productos ({{ count($carrito) }})</span>
                    <span>$ {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span>Envío</span>
                    <span class="text-success">Gratis</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-5 text-success">$ {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                
                <button class="btn btn-checkout w-100 shadow-sm">
                    FINALIZAR PEDIDO <i class="fas fa-chevron-right ms-2"></i>
                </button>
            </div>
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>