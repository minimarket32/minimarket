-- Configuración inicial para PostgreSQL
SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

-- --------------------------------------------------------
-- Estructura de tabla para `cache`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS "cache" (
  "key" varchar(255) PRIMARY KEY,
  "value" text NOT NULL,
  "expiration" int NOT NULL
);

-- --------------------------------------------------------
-- Estructura de tabla para `cache_locks`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS "cache_locks" (
  "key" varchar(255) PRIMARY KEY,
  "owner" varchar(255) NOT NULL,
  "expiration" int NOT NULL
);

-- --------------------------------------------------------
-- Estructura de tabla para `categorias`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS "categorias" (
  "id" SERIAL PRIMARY KEY,
  "nombre" varchar(255) NOT NULL,
  "created_at" timestamp NULL,
  "updated_at" timestamp NULL
);

INSERT INTO "categorias" ("id", "nombre", "created_at", "updated_at") VALUES
(1, 'Aseo', '2026-03-20 00:12:15', '2026-03-20 00:12:15'),
(2, 'Granos', '2026-03-20 00:12:15', '2026-03-20 00:12:15'),
(3, 'Frutas', '2026-03-20 00:12:15', '2026-03-20 00:12:15'),
(4, 'Bebidas', '2026-03-20 00:12:15', '2026-03-20 00:12:15'),
(5, 'Lácteos', '2026-03-20 00:12:15', '2026-03-20 00:12:15'),
(6, 'Carnes', '2026-03-20 00:12:15', '2026-03-20 00:12:15'),
(7, 'Enlatados', '2026-03-20 00:12:15', '2026-03-20 00:12:15'),
(8, 'Snacks', '2026-03-20 00:12:15', '2026-03-20 00:12:15'),
(9, 'Ofertas', '2026-03-20 00:12:15', '2026-03-20 00:12:15');

-- --------------------------------------------------------
-- Estructura de tabla para `productos`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS "productos" (
  "id" SERIAL PRIMARY KEY,
  "codigo_barras" varchar(50) DEFAULT NULL,
  "nombre" varchar(255) NOT NULL,
  "precio_compra" decimal(10,2) DEFAULT '0.00',
  "precio_venta" decimal(10,2) DEFAULT '0.00',
  "descripcion" text,
  "stock" int NOT NULL,
  "categoria_id" bigint DEFAULT NULL,
  "imagen" text,
  "created_at" timestamp NULL,
  "updated_at" timestamp NULL
);

INSERT INTO "productos" ("id", "codigo_barras", "nombre", "precio_compra", "precio_venta", "descripcion", "stock", "categoria_id", "imagen", "created_at", "updated_at") VALUES
(1, NULL, 'Arroz Roa', 2000.00, 2400.00, 'Producto de alta calidad', 10, 2, 'https://url-imagen...', '2026-03-26 05:56:54', '2026-03-28 05:34:19'),
(2, NULL, 'Arroz Diana', 2200.00, 2640.00, 'Producto de alta calidad', 25, 2, 'https://url-imagen...', '2026-03-26 05:56:54', '2026-03-28 05:33:52');

-- --------------------------------------------------------
-- Estructura de tabla para `egresos`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS "egresos" (
  "id" SERIAL PRIMARY KEY,
  "monto" decimal(10,2) NOT NULL,
  "descripcion" varchar(255) NOT NULL,
  "created_at" timestamp DEFAULT CURRENT_TIMESTAMP,
  "updated_at" timestamp DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO "egresos" ("id", "monto", "descripcion", "created_at", "updated_at") VALUES
(1, 3600.00, 'Pago arroz', '2026-03-27 18:27:21', '2026-03-27 18:27:21'),
(3, 5000.00, 'Gasto aseo', '2026-03-28 00:35:26', '2026-03-28 00:35:26');

-- --------------------------------------------------------
-- Estructura de tabla para `logs`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS "logs" (
  "id" SERIAL PRIMARY KEY,
  "usuario_id" int DEFAULT NULL,
  "accion" varchar(100) DEFAULT NULL,
  "descripcion" text,
  "ip_origen" varchar(45) DEFAULT NULL,
  "fecha_registro" timestamp DEFAULT CURRENT_TIMESTAMP,
  "created_at" timestamp NULL
);

-- (Puedes añadir aquí el resto de tus INSERTS de logs si son necesarios)

-- Ajustar las secuencias (Importante en Postgres para que los próximos IDs funcionen)
SELECT setval(pg_get_serial_sequence('categorias', 'id'), coalesce(max(id), 1)) FROM categorias;
SELECT setval(pg_get_serial_sequence('productos', 'id'), coalesce(max(id), 1)) FROM productos;
SELECT setval(pg_get_serial_sequence('egresos', 'id'), coalesce(max(id), 1)) FROM egresos;
SELECT setval(pg_get_serial_sequence('logs', 'id'), coalesce(max(id), 1)) FROM logs;