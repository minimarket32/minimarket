<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador - MiniMarket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #1b5e20;
            --hover-green: #2e7d32;
            --light-bg: #f4f6f9;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
        }

        .wrapper { display: flex; }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: var(--primary-green);
            color: white;
            position: fixed;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header img { width: 40px; border-radius: 8px; }
        .sidebar-header h2 { font-size: 1.1rem; margin: 0; font-weight: 700; }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover { background: var(--hover-green); color: white; padding-left: 25px; }

        .content { margin-left: 250px; padding: 30px; width: calc(100% - 250px); }

        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }

        .card-admin {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .welcome-banner {
            background: linear-gradient(135deg, #1b5e20 0%, #388e3c 100%);
            color: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-banner h2 { font-weight: 700; margin-bottom: 5px; }
        .welcome-banner p { opacity: 0.9; margin-bottom: 0; }
        
        .stat-card-mini {
            background: white;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid #edf2f7;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .info-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border-left: 5px solid var(--primary-green);
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .modal-content { border-radius: 25px; border: none; overflow: hidden; }
        .nav-pills .nav-link { color: var(--primary-green); font-weight: 600; border-radius: 12px; margin: 0 5px; }
        .nav-pills .nav-link.active { background-color: var(--primary-green) !important; color: white; }
        .form-control-custom { background-color: #f1f5f9; border: none; border-radius: 12px; padding: 12px; font-size: 0.9rem; }
    </style>
</head>

<body>

<div class="wrapper">
    <div class="sidebar shadow">
        <div class="sidebar-header">
            <a href="{{ route('minimarket') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
            </a>
            <h2>ADMIN</h2>
        </div>

        <nav class="mt-3">
            <a href="{{ route('admin') }}"><i class="fas fa-chart-pie me-2"></i> Dashboard</a>
            <a href="{{ route('ventas') }}"><i class="fas fa-shopping-cart me-2"></i> Ventas</a>
            <a href="{{ route('productos.index') }}"><i class="fas fa-boxes me-2"></i> Productos</a>
            <a href="{{ route('inventario') }}"><i class="fas fa-warehouse me-2"></i> Inventario</a>
            <a href="{{ route('clientes.index') }}"><i class="fas fa-users me-2"></i> Clientes</a>
            <a href="{{ route('logs.index') }}"><i class="fas fa-history me-2"></i> Logs del Sistema</a>
            <a href="{{ route('reportes') }}"><i class="fas fa-file-alt me-2"></i> Reportes</a>
            <a href="{{ route('caja') }}"><i class="fas fa-cash-register me-2"></i> Caja</a>
            <a href="{{ route('caja.historial') }}" 
               style="{{ request()->routeIs('caja.historial') ? 'background: var(--hover-green); color: white; padding-left: 25px;' : '' }}">
                <i class="fas fa-clock-rotate-left me-2"></i> Historial de Caja
            </a>
        </nav>
    </div>

    <div class="content">
        <div class="topbar">
            <h3 class="fw-bold text-dark">@yield('titulo', 'Resumen General')</h3>

            <div class="dropdown">
                <button class="btn btn-white dropdown-toggle shadow-sm px-4 py-2" data-bs-toggle="dropdown" style="border-radius: 30px; border: 1px solid #eee;">
                     <i class="fas fa-user-shield text-success me-2"></i> {{ session('usuario_nombre') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="border-radius: 15px;">
                    <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#modalConfigAdmin"><i class="fas fa-user-edit me-2 text-primary"></i>Configuración</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger fw-bold py-2">
                                <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        @if(request()->routeIs('admin')) 
            <div class="welcome-banner shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2>¡Hola de nuevo, {{ session('usuario_nombre') }}! 👋</h2>
                        <p>Resumen de tu MiniMarket para hoy, {{ \Carbon\Carbon::now()->format('d/m/Y') }}.</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <i class="fas fa-store-alt fa-4x" style="opacity: 0.2;"></i>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card-mini">
                        <div class="stat-icon bg-success text-white"><i class="fas fa-shopping-basket"></i></div>
                        <div>
                            <small class="text-muted d-block fw-bold">Ventas Hoy</small>
                            <span class="fw-bold h5 mb-0">${{ number_format($ventasHoy, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card-mini">
                        <div class="stat-icon bg-primary text-white"><i class="fas fa-box"></i></div>
                        <div>
                            <small class="text-muted d-block fw-bold">Productos</small>
                            <span class="fw-bold h5 mb-0">{{ $totalProductos }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card-mini">
                        <div class="stat-icon bg-warning text-white"><i class="fas fa-users"></i></div>
                        <div>
                            <small class="text-muted d-block fw-bold">Clientes</small>
                            <span class="fw-bold h5 mb-0">{{ $totalClientes }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card-mini">
                        <div class="stat-icon bg-info text-white"><i class="fas fa-cash-register"></i></div>
                        <div>
                            <small class="text-muted d-block fw-bold">Caja Abierta</small>
                            <span class="fw-bold h5 mb-0">{{ $cajaAbierta ? 'Sí' : 'No' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mb-4 g-3">
            <div class="col-md-4">
                <div class="info-box">
                    <small class="text-muted d-block fw-bold text-uppercase text-truncate">Estado Servidor</small>
                    <span class="badge bg-success-subtle text-success border border-success px-3 mt-1">OPERATIVO</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box" style="border-left-color: #ff9800;">
                    <small class="text-muted d-block fw-bold text-uppercase text-truncate">Notificaciones</small>
                    <span class="text-dark fw-bold mt-1 d-block small"><i class="fas fa-check-circle text-warning me-1"></i> SMTP Activo</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box" style="border-left-color: #0288d1;">
                    <small class="text-muted d-block fw-bold text-uppercase text-truncate">Base de Datos</small>
                    <span class="text-dark fw-bold mt-1 d-block small"><i class="fas fa-database text-info me-1"></i> MySQL Activa</span>
                </div>
            </div>
        </div>

        <div class="card-admin">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @yield('contenido')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>