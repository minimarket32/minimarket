<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - MiniMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --primary-green: #2e7d32;
            --dark-green: #1b5e20;
            --light-bg: #f8fafc;
            --error-red: #dc3545;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.1);
            max-width: 550px;
            width: 100%;
            padding: 40px;
        }

        .brand-logo {
            width: 280px;
            height: auto;
            margin-bottom: 15px;
            object-fit: contain;
        }

        h2 {
            font-weight: 700;
            color: #333;
            font-size: 1.6rem;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 4px;
        }

        .form-control {
            background-color: #f1f3f5;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
            border: 1px solid var(--primary-green);
            outline: none;
        }

        /* Ajustes para el grupo de entrada con el ojo */
        .input-group-text {
            background-color: #f1f3f5;
            border: 1px solid transparent;
            border-radius: 0 12px 12px 0;
            cursor: pointer;
        }

        .input-group .form-control {
            border-radius: 12px 0 0 12px;
        }

        .match-message {
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 5px;
            display: none;
        }

        .is-invalid-custom {
            border: 1px solid var(--error-red) !important;
        }

        .btn-registro {
            background-color: var(--primary-green);
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            border: none;
            margin-top: 15px;
            transition: all 0.3s;
            text-transform: uppercase;
            width: 100%;
        }

        .btn-registro:hover {
            background-color: var(--dark-green);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

<div class="register-card">
    <div class="text-center">
        <img src="{{ asset('img/minimarklogin.png') }}" alt="MiniMarket Logo" class="brand-logo">
        <h2>Crea tu cuenta</h2>
        <p class="subtitle small">Regístrate para empezar a comprar en MiniMarket</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2 mb-3 shadow-sm" style="border-radius: 12px; font-size: 0.85rem;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('registro.store') }}" id="registerForm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: Alejandra Pérez" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" placeholder="nombre@ejemplo.com" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" placeholder="3024578456" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    <span class="input-group-text shadow-none toggle-password" data-target="password">
                        <i class="fas fa-eye text-muted"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Confirmar contraseña</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
                    <span class="input-group-text shadow-none toggle-password" data-target="password_confirmation">
                        <i class="fas fa-eye text-muted"></i>
                    </span>
                </div>
            </div>
        </div>

        <div id="passwordMatchMessage" class="match-message mb-3 text-center"></div>

        <button type="submit" class="btn btn-registro" id="submitBtn">
            Crear Cuenta <i class="fas fa-user-plus ms-2"></i>
        </button>

        <div class="text-center mt-4">
            <p class="small text-muted mb-1">¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Inicia sesión</a>
            </p>
            <a href="{{ route('minimarket') }}" class="text-muted small text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Volver al inicio
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const message = document.getElementById('passwordMatchMessage');
        const submitBtn = document.getElementById('submitBtn');
        const toggles = document.querySelectorAll('.toggle-password');

        // 1. FUNCIONALIDAD MOSTRAR CARACTERES CON EL OJO
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });

        // 2. VALIDACIÓN EN TIEMPO REAL
        function validatePasswords() {
            const val1 = password.value;
            const val2 = confirmPassword.value;

            if (val2.length === 0) {
                message.style.display = 'none';
                confirmPassword.classList.remove('is-invalid-custom');
                return;
            }

            message.style.display = 'block';

            if (val1 === val2) {
                message.textContent = "✓ Las contraseñas coinciden";
                message.style.color = "#2e7d32";
                confirmPassword.classList.remove('is-invalid-custom');
                submitBtn.disabled = false;
            } else {
                message.textContent = "✕ Las contraseñas no coinciden";
                message.style.color = "#dc3545";
                confirmPassword.classList.add('is-invalid-custom');
            }
        }

        password.addEventListener('input', validatePasswords);
        confirmPassword.addEventListener('input', validatePasswords);
    });
</script>

</body>
</html>