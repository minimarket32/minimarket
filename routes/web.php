<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PerfilController, AdminController, LoginController, VentasController,
    ProductosController, InventarioController, ClientesController,
    ReportesController, CajaController, RegistroController,
    MinimarketController, LogController, CarritoController,GestionClienteController
};

// --- 1. RUTAS PÚBLICAS ---
Route::get('/', [MinimarketController::class, 'publico'])->name('minimarket');
Route::get('/minimarket', [MinimarketController::class, 'publico']);

// Login / Logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.procesar');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registro
Route::get('/registro', [RegistroController::class, 'index'])->name('registro');
Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');

// Password Reset
Route::get('/olvide-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/olvide-password', [LoginController::class, 'sendResetLink'])->name('password.email');
Route::get('/restablecer-contrasena/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/restablecer-contrasena', [LoginController::class, 'updatePassword'])->name('password.update');

// --- 2. RUTAS PROTEGIDAS (ADMIN / STAFF) ---
// Nota: Se recomienda usar un middleware de autenticación personalizado si no usas Breeze/Jetstream
Route::middleware(['web'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Logs del Sistema
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::post('/logs/clear', [LogController::class, 'clear'])->name('logs.clear');

    // Ventas (Punto de Venta)
    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas');
    Route::post('/ventas/guardar', [VentasController::class, 'store'])->name('ventas.store');
    // Esta es la ruta que llama tu JS: fetch(`/buscar-producto?term=...`)
    Route::get('/buscar-producto', [VentasController::class, 'buscarProducto'])->name('ventas.buscar');

    // Caja
    Route::get('/caja', [CajaController::class, 'index'])->name('caja');
    Route::post('/caja/cierre', [CajaController::class, 'cierre'])->name('caja.cierre');
    Route::post('/caja/abrir', [CajaController::class, 'abrir'])->name('caja.abrir');
    Route::get('/historial-cajas', [CajaController::class, 'historial'])->name('caja.historial');
    Route::post('/egresos/guardar', [CajaController::class, 'guardarEgreso'])->name('egresos.store');
    
    // Productos e Inventario
    Route::resource('productos', ProductosController::class)->except(['edit', 'update']);
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario');
    Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');
    Route::put('/inventario/{id}', [InventarioController::class, 'update'])->name('inventario.update');

    // Clientes y Reportes
    Route::resource('clientes', ClientesController::class);
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes');
    Route::get('/cliente-panel', [ClientesController::class, 'panelCliente'])->name('cliente');


// Rutas de Gestión para el Administrador
Route::get('/clientes', [GestionClienteController::class, 'index'])->name('clientes.index');
Route::post('/clientes', [GestionClienteController::class, 'store'])->name('clientes.store');
Route::put('/clientes/{id}', [GestionClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id}', [GestionClienteController::class, 'destroy'])->name('clientes.destroy');

// Ruta del Panel para el Usuario final (Cliente)
Route::get('/clientes-panel', [GestionClienteController::class, 'panelCliente'])->name('clientes.panel');

    // Carrito (Para vista pública o preventas)
    Route::get('/carrito', [CarritoController::class, 'verCarrito'])->name('carrito.ver');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');

    // Perfil de Usuario
    Route::prefix('perfil')->group(function () {
        Route::get('/', [PerfilController::class, 'edit'])->name('perfil.edit');
        Route::post('/update', [PerfilController::class, 'update'])->name('perfil.update');
        Route::post('/settings', [PerfilController::class, 'updateSettings'])->name('perfil.settings');
        Route::post('/delete', [PerfilController::class, 'deleteAccount'])->name('perfil.delete');
    });
});