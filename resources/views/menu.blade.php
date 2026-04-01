<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Minimarket</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    background:#f1f8f4;
    font-family:'Segoe UI', sans-serif;
}

.header{
    background:linear-gradient(90deg,#1b5e20,#2e7d32,#43a047);
    padding:30px;
    text-align:center;
    color:white;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.header h1{
    margin:0;
    font-size:40px;
    letter-spacing:3px;
}

.header p{
    margin-top:5px;
    font-size:16px;
    opacity:0.9;
}

/* CONTENEDOR */
.menu-container{
    width:950px;
    margin:60px auto;
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:30px;
}

/* TARJETAS */
.menu-item{
    background:white;
    padding:30px 20px;
    text-align:center;
    border-radius:12px;
    box-shadow:0 6px 15px rgba(0,0,0,0.1);
    transition:0.3s;
    cursor:pointer;
}

.menu-item:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 25px rgba(0,0,0,0.18);
    background:#e8f5e9;
}

.menu-item i{
    font-size:55px;
    margin-bottom:15px;
    color:#2e7d32;
}

.menu-item span{
    display:block;
    font-size:18px;
    font-weight:600;
    color:#1b5e20;
}

footer{
    text-align:center;
    margin:40px 0;
    color:#2e7d32;
    font-weight:500;
}

</style>
</head>

<body>

<div class="header">
    <h1>🌿 MINIMARKET EL AHORRO</h1>
  

<div class="menu-container">

    <div class="menu-item">
        <i class="fas fa-cash-registro"></i>
        <span>Ventas</span>
    </div>

    <div class="menu-item">
        <i class="fas fa-box-open"></i>
        <span>Productos</span>
    </div>

    <div class="menu-item">
        <i class="fas fa-warehouse"></i>
        <span>Inventario</span>
    </div>

    <div class="menu-item">
        <i class="fas fa-users"></i>
        <span>Clientes</span>
    </div>

    <div class="menu-item">
        <i class="fas fa-truck"></i>
        <span>Proveedores</span>
    </div>

    <div class="menu-item">
        <i class="fas fa-chart-line"></i>
        <span>Reportes</span>
    </div>

    <div class="menu-item">
        <i class="fas fa-wallet"></i>
        <span>Caja</span>
    </div>

    <div class="menu-item">
        <i class="fas fa-user-shield"></i>
        <span>Usuarios</span>
    </div>

</div>


</body>
</html>