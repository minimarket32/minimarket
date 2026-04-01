<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #2e7d32;
            padding: 30px text-align: center;
            color: white;
        }
        .content {
            padding: 40px;
            text-align: center;
            color: #444;
        }
        .button {
            display: inline-block;
            background-color: #2e7d32;
            color: #ffffff !important;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            margin-top: 25px;
            box-shadow: 0 4px 6px rgba(46, 125, 50, 0.2);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 24px;">MiniMarket</h1>
            <p style="margin: 5px 0 0 0; opacity: 0.9;">Seguridad de Cuenta</p>
        </div>

        <div class="content">
            <h2 style="color: #333;">Hola, {{ $usuario->nombre }}</h2>
            <p>Recibimos una solicitud para restablecer la contraseña de tu cuenta asociada a este correo electrónico.</p>
            <p>Para continuar con el proceso, haz clic en el botón de abajo:</p>
            
            <a href="{{ $url }}" class="button">Restablecer mi contraseña</a>

            <p style="margin-top: 35px; font-size: 13px; color: #777;">
                Este enlace expirará en 60 minutos por motivos de seguridad.<br>
                Si tú no realizaste esta solicitud, puedes ignorar este mensaje de forma segura.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} MiniMarket - Sistema de Gestión Integral.</p>
            <p>Por favor, no respondas a este correo automático.</p>
        </div>
    </div>
</body>
</html>