-- Configuración inicial para PostgreSQL
SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

-- Estructura de tabla para `cache`
CREATE TABLE IF NOT EXISTS "cache" (
  "key" varchar(255) PRIMARY KEY,
  "value" text NOT NULL,
  "expiration" int NOT NULL
);

-- Estructura de tabla para `cache_locks`
CREATE TABLE IF NOT EXISTS "cache_locks" (
  "key" varchar(255) PRIMARY KEY,
  "owner" varchar(255) NOT NULL,
  "expiration" int NOT NULL
);

-- Estructura de tabla para `categorias`
CREATE TABLE IF NOT EXISTS "categorias" (
  "id" SERIAL PRIMARY KEY,
  "nombre" varchar(255) NOT NULL,
  "created_at" timestamp NULL,
  "updated_at" timestamp NULL
);

-- Estructura de tabla para `usuarios`
CREATE TABLE IF NOT EXISTS "usuarios" (
  "id" SERIAL PRIMARY KEY,
  "nombre" varchar(255) NOT NULL,
  "email" varchar(255) UNIQUE NOT NULL,
  "password" varchar(255) NOT NULL,
  "rol" varchar(50) DEFAULT 'admin',
  "created_at" timestamp NULL,
  "updated_at" timestamp NULL
);

-- INSERTAR USUARIO (admin@admin.com / admin123)
INSERT INTO "usuarios" ("nombre", "email", "password", "created_at", "updated_at") 
VALUES ('Administrador', 'admin@admin.com', '$2y$12$OioqLs0K0BwsfoJkLLLyMERxAIpSX/InVtK0fDPkDVM.Jk6L4iR7q', NOW(), NOW())
ON CONFLICT DO NOTHING;

-- Estructura de tabla para `productos`
CREATE TABLE IF NOT EXISTS "productos" (
  "id" SERIAL PRIMARY KEY,
  "codigo_barras" varchar(50) DEFAULT NULL,
  "nombre" varchar(255) NOT NULL,
  "precio_compra" decimal(10,2) DEFAULT '0.00',
  "precio_venta" decimal(10,2) DEFAULT '0.00',
  "descripcion" text,
  "stock" int NOT NULL,
  "categoria_id" bigint REFERENCES "categorias"("id") ON DELETE SET NULL,
  "imagen" text,
  "created_at" timestamp NULL,
  "updated_at" timestamp NULL
);

-- Estructura de tabla para `ventas`
CREATE TABLE IF NOT EXISTS "ventas" (
  "id" SERIAL PRIMARY KEY,
  "total" decimal(10,2) NOT NULL,
  "usuario_id" bigint REFERENCES "usuarios"("id"),
  "created_at" timestamp NULL,
  "updated_at" timestamp NULL
);

-- Estructura de tabla para `detalle_ventas`
CREATE TABLE IF NOT EXISTS "detalle_ventas" (
  "id" SERIAL PRIMARY KEY,
  "venta_id" bigint REFERENCES "ventas"("id") ON DELETE CASCADE,
  "producto_id" bigint REFERENCES "productos"("id"),
  "cantidad" int NOT NULL,
  "precio_unitario" decimal(10,2) NOT NULL,
  "subtotal" decimal(10,2) NOT NULL
);

-- Estructura de tabla para `sessions` (VITAL PARA EVITAR ERROR 500)
CREATE TABLE IF NOT EXISTS "sessions" (
  "id" varchar(255) PRIMARY KEY,
  "user_id" bigint DEFAULT NULL,
  "ip_address" varchar(45) DEFAULT NULL,
  "user_agent" text,
  "payload" text NOT NULL,
  "last_activity" int NOT NULL
);

-- Ajustar las secuencias para que los IDs automáticos no fallen
SELECT setval(pg_get_serial_sequence('categorias', 'id'), coalesce(max(id), 1)) FROM categorias;
SELECT setval(pg_get_serial_sequence('usuarios', 'id'), coalesce(max(id), 1)) FROM usuarios;
SELECT setval(pg_get_serial_sequence('productos', 'id'), coalesce(max(id), 1)) FROM productos;
SELECT setval(pg_get_serial_sequence('ventas', 'id'), coalesce(max(id), 1)) FROM ventas;
