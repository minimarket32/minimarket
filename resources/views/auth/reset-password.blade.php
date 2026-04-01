<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña - MiniMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root { --primary-green: #2e7d32; --dark-green: #1b5e20; --light-bg: #f8fafc; }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; }
        .reset-card { background: white; border-radius: 24px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); max-width: 450px; width: 100%; padding: 40px; }
        .brand-logo { width: 220px; margin-bottom: 20px; }
        .form-control { background-color: #f1f3f5; border-radius: 12px; padding: 12px; border: 1px solid transparent; }
        .form-control:focus { background-color: #fff; border-color: var(--primary-green); box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1); }
        .btn-update { background-color: var(--primary-green); color: white; border-radius: 12px; padding: 14px; font-weight: 700; border: none; transition: all 0.3s; width: 100%; text-transform: uppercase; }
        .btn-update:hover { background-color: var(--dark-green); transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="reset-card">
    <div class="text-center">
        <img src="{{ asset('img/minimarklogin.png') }}" alt="MiniMarket" class="brand-logo">
        <h2 class="h4 fw-bold">Nueva Contraseña</h2>
        <p class="text-muted small mb-4">Crea una clave segura para volver a entrar.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2 mb-3 small" style="border-radius: 12px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Confirmar Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" placeholder="Ingresa tu correo nuevamente" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Nueva Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-muted">Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-update">
            Actualizar Contraseña <i class="fas fa-key ms-2"></i>
        </button>
    </form>
</div>

</body>
</html>