<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Acceso - MiniMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 30px; max-width: 400px; width: 100%; }
        .btn-primary { background-color: #2e7d32; border: none; border-radius: 10px; padding: 12px; }
        .btn-primary:hover { background-color: #1b5e20; }
    </style>
</head>
<body>
    <div class="card text-center">
        <h3 class="fw-bold mb-3">Recuperar Clave</h3>
        <p class="text-muted small">Ingresa tu correo y te enviaremos instrucciones.</p>

        @if (session('status'))
            <div class="alert alert-success small">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger small">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label small">Correo Electrónico</label>
                <input type="email" name="correo" class="form-control" placeholder="ejemplo@gmail.com" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold">ENVIAR ENLACE</button>
        </form>
        <div class="mt-3">
            <a href="{{ route('login') }}" class="text-muted small text-decoration-none">Volver al Login</a>
        </div>
    </div>
</body>
</html>