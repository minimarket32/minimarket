<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniMarket - Tu tienda online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --primary-green: #2e7d32;
            --dark-green: #1b5e20;
            --accent-orange: #ff9800;
            --light-bg: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
        }

        .navbar-minimarket {
            background: linear-gradient(90deg, #1b5e20, #2e7d32);
            padding: 10px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo-nav {
            height: 50px; 
            filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.2));
        }

        .search-input {
            border-radius: 20px 0 0 20px;
            border: none;
            padding: 10px 20px;
        }

        .search-btn {
            border-radius: 0 20px 20px 0;
            background-color: white;
            border: none;
            color: var(--primary-green);
            padding: 0 20px;
            font-weight: 600;
        }

        .sidebar {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            position: sticky;
            top: 20px;
        }

        .category-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #444;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 5px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .category-link i {
            margin-right: 12px;
            color: var(--primary-green);
            width: 20px;
            text-align: center;
        }

        .category-link:hover, .category-link.active {
            background: #e8f5e9;
            color: var(--dark-green);
            padding-left: 20px;
        }

        .product-card {
            border: none;
            border-radius: 20px;
            background: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .img-container {
            padding: 20px;
            background: #fdfdfd;
            height: 180px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .btn-agregar {
            background-color: var(--accent-orange);
            border: none;
            border-radius: 12px;
            padding: 10px;
            font-weight: 700;
            color: white;
            transition: 0.3s;
        }

        .btn-agregar:hover {
            background-color: #e68a00;
            box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
        }

        .badge-descuento {
            background: #ff5252;
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 700;
            z-index: 2;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-minimarket mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('minimarket') }}">
            <img src="{{ asset('img/minimarklogin.png') }}" class="logo-nav" alt="Logo">
        </a>

        <div class="d-flex flex-grow-1 justify-content-center px-4 d-none d-md-flex">
            <form action="{{ route('minimarket') }}" method="GET" class="input-group" style="max-width: 600px;">
                <input type="text" name="buscar" class="form-control search-input" placeholder="¿Qué necesitas hoy?" value="{{ request('buscar') }}">
                <button class="btn search-btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="d-flex align-items-center">
            <a href="#" class="text-white me-4 text-decoration-none position-relative">
                <i class="fas fa-shopping-basket fa-lg"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">0</span>
            </a>
            
            <div class="dropdown">
                <button class="btn btn-light rounded-pill px-4 fw-bold dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-2"></i> Mi Cuenta
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="border-radius: 15px;">
                    <li><a class="dropdown-item py-2" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2 text-success"></i> Iniciar sesión</a></li>
                    <li><a class="dropdown-item py-2" href="{{ route('registro') }}"><i class="fas fa-user-plus me-2 text-primary"></i> Crear cuenta</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="sidebar">
                <h5 class="fw-bold mb-4 px-2 text-success"><i class="fas fa-th-large me-2"></i> Categorías</h5>
                
                <a href="{{ route('minimarket') }}" class="category-link {{ !request('categoria') ? 'active' : '' }}">
                    <i class="fas fa-border-all"></i> Todas
                </a>

                @foreach($categoriasMenu as $cat)
                    <a href="{{ route('minimarket', ['categoria' => $cat->id]) }}" 
                       class="category-link {{ request('categoria') == $cat->id ? 'active' : '' }}">
                        <i class="fas fa-chevron-right small me-2"></i> {{ $cat->nombre }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($productos as $producto)
                    @php
                        // LÓGICA DE IMAGEN: Si tiene URL se usa, si no, generamos iniciales
                        $imgFinal = (!empty($producto->imagen) && str_contains($producto->imagen, 'http')) 
                                    ? $producto->imagen 
                                    : 'https://ui-avatars.com/api/?name='.urlencode($producto->nombre).'&background=EBF4FF&color=2e7d32&bold=true';
                        
                        // CÁLCULO DE PRECIO (Cambiado de ->precio a ->precio_venta)
                        $descuento = $producto->descuento ?? 0;
                        $precioFinal = $producto->precio_venta * (1 - $descuento/100);
                    @endphp

                    <div class="col-md-6 col-xl-4">
                        <div class="card product-card shadow-sm p-3">
                            @if($descuento > 0)
                                <span class="badge badge-descuento position-absolute top-0 end-0 m-3 text-white">
                                    -{{ $descuento }}%
                                </span>
                            @endif

                            <div class="img-container">
                                <img src="{{ $imgFinal }}" 
                                     class="product-img" 
                                     alt="{{ $producto->nombre }}" 
                                     onerror="this.src='https://via.placeholder.com/150?text=Producto'">
                            </div>

                            <div class="card-body px-0 pb-0 d-flex flex-column">
                                <p class="text-muted small mb-1">Stock: {{ $producto->stock }} und.</p>
                                <h6 class="fw-bold text-dark mb-2" style="height: 40px; overflow: hidden;">{{ $producto->nombre }}</h6>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <span class="fs-5 fw-bold text-success me-2">$ {{ number_format($precioFinal, 0, ',', '.') }}</span>
                                    @if($descuento > 0)
                                        <span class="text-muted text-decoration-line-through small">$ {{ number_format($producto->precio_venta, 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                <button class="btn btn-agregar w-100 mt-auto shadow-sm" onclick="location.href='{{ route('login') }}'">
                                    <i class="fas fa-cart-plus me-2"></i> Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted fw-bold">No hay productos disponibles</h4>
                        <a href="{{ route('minimarket') }}" class="btn btn-success rounded-pill px-4">Ver catálogo</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>