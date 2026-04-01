<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MiniMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --primary-green: #2e7d32;
            --dark-green: #1b5e20;
            --light-bg: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            width: 95%;
            min-height: 600px;
        }

        .login-form-side {
            padding: 50px;
        }

        .brand-logo {
            width: 320px;
            height: auto;
            margin-bottom: 20px;
            object-fit: contain;
        }

        h2 {
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            letter-spacing: -0.5px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #555;
        }

        .form-control {
            background-color: #f1f3f5;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 14px 15px;
        }

        .form-control:focus {
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
            border: 1px solid var(--primary-green);
        }

        .input-group-text {
            background-color: #f1f3f5;
            border: 1px solid transparent;
            border-radius: 0 12px 12px 0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .input-group .form-control {
            border-radius: 12px 0 0 12px;
        }

        .btn-ingresar {
            background-color: var(--primary-green);
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            border: none;
            margin-top: 10px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-ingresar:hover {
            background-color: var(--dark-green);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.2);
        }

        .login-image-side {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-left: 1px solid #f0f0f0;
        }

        .login-image-side img {
            max-width: 85%;
            height: auto;
        }

        @media (max-width: 768px) {
            .login-image-side { display: none; }
            .login-form-side { padding: 40px 30px; }
            .brand-logo { width: 260px; }
        }
    </style>
</head>
<body>

<div class="login-container container-fluid p-0">
    <div class="row g-0 h-100">
        <div class="col-md-6 login-form-side d-flex flex-column justify-content-center">
            <div class="text-center">
                <img src="{{ asset('img/minimarklogin.png') }}" alt="MiniMarket Logo" class="brand-logo">
                <h2>INICIAR SESIÓN</h2>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 mb-4" style="border-radius: 12px; font-size: 0.85rem;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.procesar') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label ms-1">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="usuario@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label ms-1">Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwordField" class="form-control" placeholder="••••••••" required>
                        <span class="input-group-text shadow-none" id="togglePassword">
                            <i class="fas fa-eye text-muted" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>
                
                {{-- Ajustado al lado izquierdo (text-start) y con margen --}}
                <div class="mb-4 text-start ms-1">
                    <a href="{{ route('password.request') }}" class="text-success small fw-bold text-decoration-none">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <button type="submit" class="btn btn-ingresar w-100">
                    Ingresar <i class="fas fa-sign-in-alt ms-2"></i>
                </button>

                <div class="text-center mt-4">
                    <p class="small text-muted mb-1">¿No tienes una cuenta? <a href="{{ route('registro') }}" class="text-success fw-bold text-decoration-none">Regístrate</a></p>
                    <a href="{{ route('minimarket') }}" class="text-muted small text-decoration-none"><i class="fas fa-home me-1"></i> Volver al inicio</a>
                </div>
            </form>
        </div>

        <div class="col-md-6 login-image-side">
            <img src="{{ asset('img/loginimage.png') }}" alt="MiniMarket Ilustración">
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordField');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>

</body>
</html>