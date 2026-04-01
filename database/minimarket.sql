-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2026 at 06:23 PM
-- Server version: 8.4.3
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minimarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caja`
--

CREATE TABLE `caja` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
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

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` bigint UNSIGNED NOT NULL,
  `venta_id` bigint UNSIGNED NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 5, 1, 0.00),
(2, 1, 1, 2, 2400.00),
(3, 2, 29, 1, 1800.00),
(4, 2, 3, 1, 0.00),
(5, 3, 1, 1, 2400.00),
(6, 3, 29, 1, 1800.00),
(7, 4, 29, 1, 1800.00),
(8, 4, 1, 2, 2400.00),
(9, 5, 1, 1, 2400.00),
(10, 6, 1, 2, 2400.00),
(11, 7, 1, 1, 2400.00),
(12, 8, 1, 1, 2400.00),
(13, 9, 1, 1, 2400.00),
(14, 13, 29, 1, 1800.00),
(15, 14, 29, 1, 1800.00),
(16, 15, 29, 1, 1800.00),
(17, 16, 29, 1, 1800.00),
(18, 17, 31, 1, 1320.00),
(19, 17, 29, 2, 1800.00),
(20, 18, 31, 1, 1320.00),
(21, 18, 29, 1, 1800.00),
(22, 18, 32, 1, 1680.00);

-- --------------------------------------------------------

--
-- Table structure for table `egresos`
--

CREATE TABLE `egresos` (
  `id` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `egresos`
--

INSERT INTO `egresos` (`id`, `monto`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 3600.00, 'Pago arroz', '2026-03-27 18:27:21', '2026-03-27 18:27:21'),
(2, 3600.00, 'arroz', '2026-03-27 23:37:39', '2026-03-27 23:37:39'),
(3, 5000.00, 'Gasto aseo', '2026-03-28 00:35:26', '2026-03-28 00:35:26'),
(4, 5000.00, 'Aseo', '2026-03-28 02:42:36', '2026-03-28 02:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `accion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ip_origen` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `usuario_id`, `accion`, `descripcion`, `ip_origen`, `fecha_registro`, `created_at`) VALUES
(1, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 17:40:27', NULL),
(2, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 17:48:00', NULL),
(3, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de clave.', '127.0.0.1', '2026-03-10 18:12:25', NULL),
(4, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:22:11', NULL),
(5, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:24:15', NULL),
(6, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:26:43', NULL),
(7, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:28:08', NULL),
(8, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:29:39', NULL),
(9, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:30:29', NULL),
(10, 12, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 18:30:57', NULL),
(11, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:31:03', NULL),
(12, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:35:46', NULL),
(13, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:42:47', NULL),
(14, 12, 'Solicitud Recuperación', 'El usuario pidió enlace de restablecimiento.', '127.0.0.1', '2026-03-10 18:44:18', NULL),
(15, 12, 'Cambio de Clave', 'El usuario restableció su contraseña con éxito.', '127.0.0.1', '2026-03-10 18:46:20', NULL),
(16, 12, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 18:46:33', NULL),
(17, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 18:46:44', NULL),
(18, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 18:54:10', NULL),
(19, 12, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 18:57:49', NULL),
(20, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 18:58:02', NULL),
(21, 1, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 18:59:47', NULL),
(22, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 18:59:59', NULL),
(23, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 19:35:45', '2026-03-11 00:35:45'),
(24, 12, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 19:58:48', '2026-03-11 00:58:48'),
(25, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 19:59:03', '2026-03-11 00:59:03'),
(26, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 19:59:39', '2026-03-11 00:59:39'),
(27, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:00:54', '2026-03-11 01:00:54'),
(28, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:00:55', '2026-03-11 01:00:55'),
(29, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:09:57', '2026-03-11 01:09:57'),
(30, 1, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 20:13:48', '2026-03-11 01:13:48'),
(31, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:13:56', '2026-03-11 01:13:56'),
(32, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:14:34', '2026-03-11 01:14:34'),
(33, 12, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 20:15:09', '2026-03-11 01:15:09'),
(34, 12, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:15:19', '2026-03-11 01:15:19'),
(35, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:16:31', '2026-03-11 01:16:31'),
(36, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:38:42', '2026-03-11 01:38:42'),
(37, 13, 'Registro', 'Nuevo cliente registrado: funalo@gmail.com', '127.0.0.1', '2026-03-10 20:43:32', NULL),
(38, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:44:04', '2026-03-11 01:44:04'),
(39, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 20:55:40', '2026-03-11 01:55:40'),
(40, 14, 'Registro', 'Nuevo cliente registrado: karenferia185@gmail.com', '127.0.0.1', '2026-03-10 23:26:52', NULL),
(41, 14, 'Solicitud Recuperación', 'El usuario pidió restablecer clave.', '127.0.0.1', '2026-03-10 23:27:15', '2026-03-11 04:27:15'),
(42, 14, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 23:29:05', '2026-03-11 04:29:05'),
(43, 14, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 23:29:13', '2026-03-11 04:29:13'),
(44, 14, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-10 23:29:22', '2026-03-11 04:29:22'),
(45, 14, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-10 23:30:14', '2026-03-11 04:30:14'),
(46, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-14 00:22:29', '2026-03-14 05:22:29'),
(47, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 20:20:21', '2026-03-20 01:20:21'),
(48, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 20:23:06', '2026-03-20 01:23:06'),
(49, 3, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-19 20:50:53', '2026-03-20 01:50:53'),
(50, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 20:51:04', '2026-03-20 01:51:04'),
(51, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:21:20', '2026-03-20 04:21:20'),
(52, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:26:31', '2026-03-20 04:26:31'),
(53, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:26:33', '2026-03-20 04:26:33'),
(54, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:27:00', '2026-03-20 04:27:00'),
(55, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:29:08', '2026-03-20 04:29:08'),
(56, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:29:11', '2026-03-20 04:29:11'),
(57, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:34:08', '2026-03-20 04:34:08'),
(58, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:44:59', '2026-03-20 04:44:59'),
(59, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-19 23:45:05', '2026-03-20 04:45:05'),
(60, 1, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-19 23:45:20', '2026-03-20 04:45:20'),
(61, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:45:30', '2026-03-20 04:45:30'),
(62, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:45:31', '2026-03-20 04:45:31'),
(63, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-19 23:45:35', '2026-03-20 04:45:35'),
(64, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:51:38', '2026-03-20 04:51:38'),
(65, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-19 23:52:38', '2026-03-20 04:52:38'),
(66, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-19 23:54:59', '2026-03-20 04:54:59'),
(67, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:12:52', '2026-03-20 05:12:52'),
(68, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:12:53', '2026-03-20 05:12:53'),
(69, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:19:49', '2026-03-20 05:19:49'),
(70, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:19:51', '2026-03-20 05:19:51'),
(71, 1, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-20 00:21:27', '2026-03-20 05:21:27'),
(72, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:21:39', '2026-03-20 05:21:39'),
(73, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:26:09', '2026-03-20 05:26:09'),
(74, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:26:11', '2026-03-20 05:26:11'),
(75, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:28:58', '2026-03-20 05:28:58'),
(76, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:29:00', '2026-03-20 05:29:00'),
(77, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:32:14', '2026-03-20 05:32:14'),
(78, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:32:16', '2026-03-20 05:32:16'),
(79, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:35:19', '2026-03-20 05:35:19'),
(80, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:35:20', '2026-03-20 05:35:20'),
(81, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 00:42:50', '2026-03-20 05:42:50'),
(82, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:43:03', '2026-03-20 05:43:03'),
(83, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 00:43:17', '2026-03-20 05:43:17'),
(84, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:53:35', '2026-03-20 05:53:35'),
(85, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 00:54:51', '2026-03-20 05:54:51'),
(86, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:54:58', '2026-03-20 05:54:58'),
(87, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:55:00', '2026-03-20 05:55:00'),
(88, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 00:55:04', '2026-03-20 05:55:04'),
(89, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:55:13', '2026-03-20 05:55:13'),
(90, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 00:55:15', '2026-03-20 05:55:15'),
(91, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 01:02:05', '2026-03-20 06:02:05'),
(92, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 01:03:27', '2026-03-20 06:03:27'),
(93, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 01:03:29', '2026-03-20 06:03:29'),
(94, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 01:37:43', '2026-03-20 06:37:43'),
(95, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 01:39:06', '2026-03-20 06:39:06'),
(96, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 01:45:36', '2026-03-20 06:45:36'),
(97, 15, 'Registro', 'Nuevo cliente registrado: alejandracas3217@gmail.com', '127.0.0.1', '2026-03-20 01:46:43', NULL),
(98, 15, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 01:46:55', '2026-03-20 06:46:55'),
(99, 15, 'Solicitud Recuperación', 'El usuario pidió restablecer clave.', '127.0.0.1', '2026-03-20 01:47:03', '2026-03-20 06:47:03'),
(100, 3, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-20 01:48:18', '2026-03-20 06:48:18'),
(101, 3, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-20 01:48:24', '2026-03-20 06:48:24'),
(102, 3, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-20 01:48:30', '2026-03-20 06:48:30'),
(103, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 01:49:23', '2026-03-20 06:49:23'),
(104, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-20 01:51:45', '2026-03-20 06:51:45'),
(105, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-20 01:52:00', '2026-03-20 06:52:00'),
(106, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-25 21:55:53', '2026-03-26 02:55:53'),
(107, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-25 22:01:43', '2026-03-26 03:01:43'),
(108, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-25 22:25:45', '2026-03-26 03:25:45'),
(109, 16, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-25 23:34:30', '2026-03-26 04:34:30'),
(110, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-25 23:45:25', '2026-03-26 04:45:25'),
(111, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-26 00:57:53', '2026-03-26 05:57:53'),
(112, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-26 00:57:57', '2026-03-26 05:57:57'),
(113, 16, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-26 01:04:31', '2026-03-26 06:04:31'),
(114, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-26 01:32:27', '2026-03-26 06:32:27'),
(115, 17, 'Registro', 'Nuevo cliente registrado: aleja3217@gmail.com', '127.0.0.1', '2026-03-27 04:41:47', NULL),
(116, 17, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 04:42:14', '2026-03-27 09:42:14'),
(117, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 05:14:45', '2026-03-27 10:14:45'),
(118, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 06:00:18', '2026-03-27 11:00:18'),
(119, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 06:00:23', '2026-03-27 11:00:23'),
(120, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 06:01:50', '2026-03-27 11:01:50'),
(121, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 06:30:19', '2026-03-27 11:30:19'),
(122, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 06:30:27', '2026-03-27 11:30:27'),
(123, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 06:31:41', '2026-03-27 11:31:41'),
(124, 16, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 06:35:39', '2026-03-27 11:35:39'),
(125, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 06:48:39', '2026-03-27 11:48:39'),
(126, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 06:56:11', '2026-03-27 11:56:11'),
(127, 1, 'Intento Fallido', 'Contraseña incorrecta.', '127.0.0.1', '2026-03-27 06:56:24', '2026-03-27 11:56:24'),
(128, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 06:56:33', '2026-03-27 11:56:33'),
(129, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 06:57:00', '2026-03-27 11:57:00'),
(130, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 16:12:31', '2026-03-27 21:12:31'),
(131, 16, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 16:15:46', '2026-03-27 21:15:46'),
(132, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 16:16:24', '2026-03-27 21:16:24'),
(133, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 16:42:43', '2026-03-27 21:42:43'),
(134, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 16:42:44', '2026-03-27 21:42:44'),
(135, 3, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 16:42:50', '2026-03-27 21:42:50'),
(136, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 16:43:03', '2026-03-27 21:43:03'),
(137, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 17:56:29', '2026-03-27 22:56:29'),
(138, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 17:56:40', '2026-03-27 22:56:40'),
(139, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 18:06:18', '2026-03-27 23:06:18'),
(140, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 18:06:19', '2026-03-27 23:06:19'),
(141, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-27 20:08:16', '2026-03-28 01:08:16'),
(142, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '192.168.101.3', '2026-03-27 21:41:14', '2026-03-28 02:41:14'),
(143, 1, 'Cierre de Sesión', 'El usuario salió del sistema.', '192.168.101.3', '2026-03-27 21:43:27', '2026-03-28 02:43:27'),
(144, 3, 'Inicio de Sesión', 'El usuario entró al sistema.', '192.168.101.3', '2026-03-27 21:43:58', '2026-03-28 02:43:58'),
(145, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-27 23:29:55', '2026-03-28 04:29:55'),
(146, 18, 'Registro', 'Nuevo cliente registrado: ale@minimarket.com', '10.167.88.165', '2026-03-28 00:48:40', NULL),
(147, 19, 'Registro', 'Nuevo cliente registrado: luli@gmail.com', '127.0.0.1', '2026-03-28 00:49:30', NULL),
(148, 20, 'Registro', 'Nuevo cliente registrado: luli2@gmail.com', '127.0.0.1', '2026-03-28 00:53:56', NULL),
(149, 21, 'Registro', 'Nuevo cliente registrado: karens2@gmail.com', '127.0.0.1', '2026-03-28 00:56:45', NULL),
(150, 22, 'Registro', 'Nuevo cliente registrado: karols2@gmail.com', '127.0.0.1', '2026-03-28 00:57:50', NULL),
(151, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-28 00:58:19', '2026-03-28 05:58:19'),
(152, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-28 00:58:20', '2026-03-28 05:58:20'),
(153, 1, 'Inicio de Sesión', 'El usuario entró al sistema.', '10.167.88.165', '2026-03-28 01:00:11', '2026-03-28 06:00:11'),
(154, 16, 'Cierre de Sesión', 'El usuario salió del sistema.', '127.0.0.1', '2026-03-28 01:09:16', '2026-03-28 06:09:16'),
(155, 16, 'Inicio de Sesión', 'El usuario entró al sistema.', '127.0.0.1', '2026-03-28 01:09:31', '2026-03-28 06:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_21_214554_create_clientes_table', 1),
(5, '2026_02_21_214555_create_caja_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo_barras` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_compra` decimal(10,2) DEFAULT '0.00',
  `precio_venta` decimal(10,2) DEFAULT '0.00',
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `stock` int NOT NULL,
  `categoria_id` bigint UNSIGNED DEFAULT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `codigo_barras`, `nombre`, `precio_compra`, `precio_venta`, `descripcion`, `stock`, `categoria_id`, `imagen`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Arroz Roa', 2000.00, 2400.00, 'Producto de alta calidad', 10, 2, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcTTFyM9YRURT3abNa6lQADx7jjGwLe9juz4OuMzhQMM_iPMBdQB7tY__kKTIpdWxd7s5v5nok4VQGEqV_g3pKoqh9Ud6R5m-CJc8yWYbz2XCQtMrTh4nV9j', '2026-03-26 05:56:54', '2026-03-28 05:34:19'),
(2, NULL, 'Arroz Diana', 2200.00, 2640.00, 'Producto de alta calidad', 25, 2, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSwPMUK1mnWe0W8vCgfF3AxLgJpmqPE3nQKPnK8em7oVIU9Er_0krc9qozNMqtYj9MaWXj1J_ezEiXxzETuMyv6jyWvy7uW', '2026-03-26 05:56:54', '2026-03-28 05:33:52'),
(3, NULL, 'Frijol Diana', 8000.00, 9600.00, 'Producto de alta calidad', 67, 2, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSOWclRo5cSqsmH22E6JxEdlzfiAcPxlBJPz5hXFGaGnN-gystmmu0BZxBC7lnYULt2J4922f7nLykMtKk_kmjkQUcTQq0LS6f0A3YabT6jUx1rySF--Wnc8g', '2026-03-26 05:56:54', '2026-03-28 05:32:04'),
(4, NULL, 'Jabon Carey', 15000.00, 18000.00, 'Producto de alta calidad', 11, 2, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSXpeERQwAnQ7ZLQOlFoAAiWK2zBX_bOSnCqtbLTeSjc35kLHjXfcgGHYalcZtCG4Iz8fI0xcFE77969iDQKKntKXKOIdExHjOHyChqYqms1vwA8-2JSr1K', '2026-03-26 05:56:54', '2026-03-28 05:37:20'),
(5, NULL, 'Lentejas Diana', 2500.00, 3000.00, 'Producto de alta calidad', 67, 2, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcTK1iB2hDlzGmzdAnmEh7wp584CvlA7VKssLgpUbjYXPDMYR9jLVrurvdjqsPNxvY4ajrV5ROGO2lkfakuC6w1u1vhNKPAq-tViml_fgieYVkOuVFFgQl92AQ', '2026-03-26 05:56:54', '2026-03-28 05:32:28'),
(6, NULL, 'Jabon rey', 2800.00, 3360.00, 'Producto de alta calidad', 30, 1, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTjNhJp-leFpiQ_xE-mo_Q4q2UFP4vEFKO5T-EDii7LlWYFxGEJWdptAJw-NPK6xJ5pIsmUsrpVkG0R9hClDDmg1yCIm7jK', '2026-03-26 05:56:54', '2026-03-28 05:37:06'),
(7, NULL, 'Colgate', 4000.00, 4800.00, 'Producto de alta calidad', 12, 1, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcQi_9BnpsG2a-RHiLg10avboHSt_mkGO8j5dLbwDcA5eaC9Yxi2CCFXoMK7Y3oPkuOu2lUs8hSX2hiWxi3qVZOSPr3efd-g_0BSg8XKWy5HuL6pLdkinqBN', '2026-03-26 05:56:54', '2026-03-28 05:37:48'),
(8, NULL, 'Suavitel', 1500.00, 1800.00, 'Producto de alta calidad', 11, 1, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcRAs0LrkMK4eNZDmQSKgz_6GjPMkT0GEa7OFMbeSQGx8HONt4SPREqX_U0qPMus3xVxoHn2aETOw04BXsQ3LWMbgk7OCtvfvx6K-A9dL2E0PuCKfCgZpAGchw', '2026-03-26 05:56:54', '2026-03-28 05:38:07'),
(9, NULL, 'Jabón Protex', 3000.00, 3600.00, 'Producto de alta calidad', 11, 1, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcTwpyAWjUhSwcWccd78Djt9_nvZvOuoQ0iqehXdxckDcZ8Nkajj7pUrJljmcGPEV4o6xog9AKA_oyD6dGYGuZ7ffPxcgtkv', '2026-03-26 05:56:54', '2026-03-28 05:38:23'),
(10, NULL, 'Detergente Fab', 3000.00, 3600.00, 'Producto de alta calidad', 37, 1, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQ0L9WZN__c38TAMSSkYImKWrPZZsA4NJLLRFLcryKAaA7SmxSQueHiK1N5zJYaz-WiDpcLOvkwzMRVEzl1HvPb0UcX63nmodhsc3dUznds', '2026-03-26 05:56:54', '2026-03-28 05:38:45'),
(11, NULL, 'Lavaloza King', 3500.00, 4200.00, 'Producto de alta calidad', 24, 1, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcSiC7NzOv9B5WOxNMXcHwmvMquLL7Cf9lf86eE07Dyzt2hHv-82UabjX9zttCCI603nHDPQDVSj2hdxingi4NcJl7W6WONkcNuHK5SDDy6w3k0Vm844nmIn', '2026-03-26 05:56:54', '2026-03-28 05:43:42'),
(12, NULL, 'Pavo en Carne Molida', 15000.00, 18000.00, 'Producto de alta calidad', 20, 6, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcT4blSi_EggVypu_uZMS0VHxbtN-ICe1Au4djEwbgLv7nN9LAfVtXAbJA1OwhdJs0SmEBdwKId5owWnUsto5ENfzEHjaBIZP1pMRWlT6vNox0Bxd1M45aSx8g', '2026-03-26 05:56:54', '2026-03-28 05:43:33'),
(13, NULL, 'Lomo', 12000.00, 14400.00, 'Producto de alta calidad', 35, 6, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcR4bgLyq4zHvwzxfvvnrfzyZo8aKY4sSeAKLj-fxoDcpHKM-PExCyKnOFBD5Z0Zp623yv2_sliTKbns3mgEduLENkcSYHaqYaKprplIXSql', '2026-03-26 05:56:54', '2026-03-28 05:43:19'),
(14, NULL, 'Chuleta Cerdo', 13000.00, 15600.00, 'Producto de alta calidad', 7, 6, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcTfgGFS6Y5UFf2mrJ_1r4J_khc3hUi6k0Zz8Hl5CTZEwZPEfemD9CG3ajuRavM775viAU-Dvd7wlD7OxahPSbAmL848tJUCa519s5YAvv0', '2026-03-26 05:56:54', '2026-03-28 05:42:59'),
(15, NULL, 'Carne Res', 12000.00, 14400.00, 'Producto de alta calidad', 72, 6, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTu2gFvrnfdSY51AkKSZTYd766Z4yrDC45AMu81O7Iu6nHSSDe5OKNhiAJPGqk7oN1OJugPDmbjIk3c76wRVqZ39LKqnyMuOtqn4JYSggepm2TlKNDNcsSARg', '2026-03-26 05:56:54', '2026-03-28 05:42:43'),
(16, NULL, 'Pechuga de Pollo', 6000.00, 7200.00, 'Producto de alta calidad', 20, 6, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQNB7eM1Gc1NpvRganRNJv1kgSML6wiKRVfWePSoEZtLYupjoPv7sQaVmdg9EIzkYvt8Qu8rJvfGTSk3MfdsBZgfTO-VmDr4aWlXftxHkGPgdCq5yxMsgSB', '2026-03-26 05:56:54', '2026-03-28 05:42:28'),
(17, NULL, 'Quesito Colanta', 8000.00, 9600.00, 'Producto de alta calidad', 94, 5, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQW4D-9aChWyt2BnWNea1QNVzanptbMJO9C0clMq0MXYi9aXyqA62BEvqF3gJjX9iCXR0tPD3XH2fyWl5y_hDQsjfqAmzjJ6wwFDkNx6s0XV6_rXJIbkea8yw', '2026-03-26 05:56:54', '2026-03-28 05:42:11'),
(18, NULL, 'Leche Alquería Grande', 6500.00, 7800.00, 'Producto de alta calidad', 100, 5, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcSCHimtzlxt_Bp6W5abXidDivA0wYLWBzh_hTc4V2vLOWAHvstfQAIju_yg3fIw8R6fP-L4PW-AbPgme57d2Mmrqdx_KUkq39lyIortEVPfAh5ygCFWr1MI', '2026-03-26 05:56:54', '2026-03-28 05:41:47'),
(19, NULL, 'Quesito Colanta Campesino', 9000.00, 10800.00, 'Producto de alta calidad', 91, 5, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSRu6wgo-ZPdVH0o8HjpCmQjMtTbqjveJmm4J8p-1D1I2Rw0FqKAXARMQ2JZlrDn1h6OqNk0CwEtEjPPlF8jM1JeR0RSgaP5GncYy38gJM9CUno0U9ad50T', '2026-03-26 05:56:54', '2026-03-28 05:41:30'),
(20, NULL, 'Leche Colanta', 3500.00, 4200.00, 'Producto de alta calidad', 15, 5, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSWhWWF17cquufIl3Zx3OnOMGN6YJIX_Kzl1LyKaqY9B7CqF0thJzho8esBWYBRZ5_USqcGG744ZhsVRIpL1bB5FvqFQ95cF7QKNunOzZUna5gApyDkbMUDCA', '2026-03-26 05:56:54', '2026-03-28 05:41:08'),
(21, NULL, 'Pony Malta 1.5', 4000.00, 4800.00, 'Producto de alta calidad', 57, 4, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcRRSQMyHN-KkWa5Hcw-5gnRAo0p-HfALRT4DGhJhqWH1us6fXY04p-Pm4WN31q38kV7tPwBY2xt4NA52gvKAOgjKpj8iRVscg', '2026-03-26 05:56:54', '2026-03-28 05:40:49'),
(22, NULL, 'Postobón Manzana', 8000.00, 9600.00, 'Producto de alta calidad', 7, 4, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcTJwkV0IeFzHZE9l-W0mtQ6MzYQTLL2sc8leqQBAX69P9y-2IJYEjz1LMp-DDT6rBmeJCOn49rxr9ro_9fIkFct-PC2dfl5aRazROHrWQddAIxmeblIpiyvGg', '2026-03-26 05:56:54', '2026-03-28 05:40:28'),
(23, NULL, 'Manzana mini', 2500.00, 3000.00, 'Producto de alta calidad', 30, 4, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSw_VCXEAKJs3cPTXaw_mHhPIOuYTk--NA4TYwmprKpvqJgoZREGRKyVffM1zgAwExVUw4xpUHjojbezRRdC9KD4x0z0nH-QTt8C0cOciZN3XAgMWpA2yB6LNg', '2026-03-26 05:56:54', '2026-03-28 05:40:09'),
(24, NULL, 'Coca Cola', 6000.00, 7200.00, 'Producto de alta calidad', 13, 4, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQf798R3yK7ICO4z3yBuO8D2tATr6Z5QeE1TuafiWbMfUizyjwmgxorxIjq34waXiL1KSzI1fwZR5DiYyy5HxvRT5Kd3v0QiR5Zyd3kumrgEWYha5CK-0Y0', '2026-03-26 05:56:54', '2026-03-28 05:39:42'),
(25, NULL, 'Frutiño', 840.00, 1008.00, 'Producto de alta calidad', 29, 4, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcStBNnzfmkqBMMCfEuKWwHFbrrp-qSFqasWj2gOKUj64fDf7z0w81N_ARvkVPA4tm8Fco3ehWX-ka1naX1enNefkMGbtdJFn23Od8cwwDaRQY-cR5gWCWJO', '2026-03-26 05:56:54', '2026-03-28 05:39:27'),
(26, NULL, 'Lulo', 4000.00, 4800.00, 'Fruta de Calidad', 15, 3, 'https://nativoalimentos.co/rails/active_storage/blobs/proxy/eyJfcmFpbHMiOnsiZGF0YSI6MTQ4NTUyMiwicHVyIjoiYmxvYl9pZCJ9fQ==--efa8eca38724e8890573b3bc2d8ab36a9072428d/lulo-domicilio-medellin.png?locale=es', '2026-03-26 05:58:40', '2026-03-27 11:56:49'),
(27, NULL, 'Maracuya', 4000.00, 4800.00, NULL, 15, 3, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcTv4OFuHrCQK44AuSfBPMFXloB89mbSMJFUpiIBGdjn2NwgXNe74CjGBdNsHRDD4li3Hlyo9LFg77dTUotdIALNDz7k5CHKG_eTKe4q79oYPE8_J7YECxx6', '2026-03-26 06:03:39', '2026-03-27 11:32:16'),
(28, NULL, 'Arequipe', 14000.00, 16800.00, 'Producto de Calidad', 12, 8, 'https://megaredil.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsiZGF0YSI6MjI5NjYsInB1ciI6ImJsb2JfaWQifX0=--088b867bd4e945b62b7709104836ddfd1ee3f7ef/eyJfcmFpbHMiOnsiZGF0YSI6eyJmb3JtYXQiOiJwbmciLCJyZXNpemVfdG9fZml0IjpbODAwLDgwMF19LCJwdXIiOiJ2YXJpYXRpb24ifX0=--cef66509c9cdc75663c0eefd9421db1d2ea4fead/7702001082131.png?locale=es', NULL, '2026-03-27 11:23:37'),
(29, '7702006207683', 'shampoo sedal', 1500.00, 1800.00, NULL, 4, 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJbFaujQiHkoZzsMeYplDCgGgtciMYWSIq2A&s', '2026-03-27 11:13:45', '2026-03-28 06:08:37'),
(30, NULL, 'Sal kilo', 2750.00, 3300.00, NULL, 5, 2, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQaOcNMuOZvB_kRiqxKrBwn5dvL9EflCQKyd4nUmUgGZtRWsh4G4uSwZWSEFN8OKVsV9gJBEu22x1mfOWDonCROGKt9DYPRUQdtdizqFwG8wvJStVSPsFFB', '2026-03-27 21:15:29', '2026-03-27 21:15:29'),
(31, '7702006204057', 'Gel Ego', 1100.00, 1320.00, NULL, 14, 1, 'https://distrimarketsas.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsiZGF0YSI6MTczMzM0MSwicHVyIjoiYmxvYl9pZCJ9fQ==--4673519eaae3b4056eff7cb826b9ff647685ccd6/eyJfcmFpbHMiOnsiZGF0YSI6eyJmb3JtYXQiOiJwbmciLCJyZXNpemVfdG9fZml0IjpbODAwLDgwMF19LCJwdXIiOiJ2YXJpYXRpb24ifX0=--cef66509c9cdc75663c0eefd9421db1d2ea4fead/nueva-imagen%20-%202024-06-11T114111.437.png?locale=es', '2026-03-28 05:01:47', '2026-03-28 06:08:37'),
(32, '7702011125354', 'Kick Mani', 1400.00, 1680.00, NULL, 39, 8, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKzoOv0DObiD5skgpij979proi6pKCJ99iDQ&s', '2026-03-28 06:06:21', '2026-03-28 06:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Table structure for table `sesiones_caja`
--

CREATE TABLE `sesiones_caja` (
  `id` bigint UNSIGNED NOT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `monto_apertura` decimal(10,2) NOT NULL,
  `monto_cierre` decimal(10,2) DEFAULT NULL,
  `total_ventas` decimal(10,2) DEFAULT '0.00',
  `fecha_apertura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_cierre` timestamp NULL DEFAULT NULL,
  `estado` enum('abierta','cerrada') DEFAULT 'abierta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sesiones_caja`
--

INSERT INTO `sesiones_caja` (`id`, `usuario_id`, `monto_apertura`, `monto_cierre`, `total_ventas`, `fecha_apertura`, `fecha_cierre`, `estado`) VALUES
(1, 1, 100000.00, 102400.00, 2400.00, '2026-03-27 22:46:28', '2026-03-27 23:27:33', 'cerrada'),
(2, 1, 100000.00, 100600.00, 4200.00, '2026-03-27 23:35:05', '2026-03-27 23:38:28', 'cerrada'),
(3, 1, 10000.00, 6800.00, 1800.00, '2026-03-28 00:34:43', '2026-03-28 00:35:31', 'cerrada'),
(4, 1, 10000.00, 11800.00, 1800.00, '2026-03-28 00:51:57', '2026-03-28 01:00:42', 'cerrada'),
(5, 1, 100000.00, 100000.00, 0.00, '2026-03-28 01:04:37', '2026-03-28 01:05:43', 'cerrada'),
(6, 1, 100000.00, 98600.00, 3600.00, '2026-03-28 02:42:00', '2026-03-28 04:58:59', 'cerrada'),
(7, 1, 200000.00, 204920.00, 4920.00, '2026-03-28 04:59:07', '2026-03-28 05:20:50', 'cerrada'),
(8, 1, 200000.00, NULL, 0.00, '2026-03-28 06:07:41', NULL, 'abierta');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dgg3Q3KlU7FAUCIE3X1qXvVKbMf8lXm8eGbbtcaE', NULL, '10.167.88.165', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiSzAxQTJvdzhjQ0F1c1N3Sks0VEkyb3V3TXI5ZkVERUp1cmU1WUVITyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMC4xNjcuODguMjAyOjgwMDAvYWRtaW4iO3M6NToicm91dGUiO3M6NToiYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEwOiJ1c3VhcmlvX2lkIjtpOjE7czoxNDoidXN1YXJpb19ub21icmUiO3M6MTY6Ik1haXJhIENhc3Rhw7FlZGEiO3M6MTQ6InVzdWFyaW9fY29ycmVvIjtzOjE1OiJtYWlyYUBnbWFpbC5jb20iO3M6MTE6InVzdWFyaW9fcm9sIjtzOjU6ImFkbWluIjt9', 1774659611),
('dwgyLOoI4p7WxKmolmdNvIFYJjzJ4hzHSeJUWznk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiSVI3dDR4eFRPU1lWaGxzdEpibzdyckMxVnJCZXZOc3JSU0FPQU1UdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYWphIjtzOjU6InJvdXRlIjtzOjQ6ImNhamEiO31zOjEwOiJ1c3VhcmlvX2lkIjtpOjE2O3M6MTQ6InVzdWFyaW9fbm9tYnJlIjtzOjE2OiJBZG1pbiBNaW5pTWFya2V0IjtzOjE0OiJ1c3VhcmlvX2NvcnJlbyI7czoyMDoiYWRtaW5AbWluaW1hcmtldC5jb20iO3M6MTE6InVzdWFyaW9fcm9sIjtzOjU6ImFkbWluIjt9', 1774660273),
('SAoYWPHnZ4QfrTHMAU1oKNRrHT8lep6qcAoClYoI', NULL, '10.167.88.222', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/413.1.887139264 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXlJMEw2aUR3aWFUSnhENU1DaGg5ZktPbGJ6UDZzVDFaUDdINE16cSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMC4xNjcuODguMjAyOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774659632),
('uN2svO8PLCtIOf2vaMqUkNekr6xks5uNATjivwKb', NULL, '10.167.88.180', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_2_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/413.1.887139264 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNU82eVlUdUlRZ2lmRENzblFYcUNOOVJ5dE5Qa1FvZ1lqMUkwYVZVdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMC4xNjcuODguMjAyOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774659634);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `intentos_fallidos` int DEFAULT '0',
  `rol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  `estado` enum('Activo','Bloqueado','Eliminado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `telefono`, `correo`, `password`, `intentos_fallidos`, `rol`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Maira Castañeda', '3021588646', 'maira@gmail.com', '$2y$12$Yq2LitNj/iQhAJ7pGrInVOt/8g13.6JJg8Y4d0S9cllsTV9P6VqZ2', 0, 'admin', 'Activo', '2026-03-01 23:55:20', '2026-03-01 23:55:20'),
(2, 'alejandra', '325455869', 'aleja123@gmail.com', '$2y$12$tIQ/XhRNLSkRzazJ9rvaSuaEnmVmw2OIW/UomZhziRjrDyvBf4EAq', 0, 'cliente', 'Activo', '2026-03-02 00:10:03', '2026-03-02 00:10:03'),
(3, 'daniel', '3115248565', 'daniel@gmail.com', '$2y$12$ezbKbVpLjsXXHohj5ffiheH3IsuW8/FT/QxdaSJBmpsC/M0Hwrh2S', 0, 'cliente', 'Activo', '2026-03-02 01:57:30', '2026-03-02 01:57:30'),
(5, 'Administrador', '3000000000', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9h9q8a6b1f8z5Kf9E9QJQK', 0, 'admin', 'Activo', '2026-03-01 21:37:36', '2026-03-01 21:37:36'),
(6, 'karol perilla', '3115456215', 'karol@gmail.com', '$2y$12$b/ZlLh1fL413B/jwnvteUOGc0.vL9A9aZc9qpx2W.D45wkQOj/kFa', 0, 'admin', 'Activo', '2026-03-01 21:41:37', '2026-03-01 21:41:37'),
(7, 'sofia perilla', '3115248565', 'sofi32@gmail.com', '$2y$12$SzNbPEFt6Sqhneno0pyhLeFmQFJv2LS5WuF0tItZjgLRd//gw0v4O', 0, 'cliente', 'Activo', '2026-03-02 04:58:00', '2026-03-02 04:58:00'),
(8, 'daniela perez', '3145521245', 'daniela32', '$2y$12$u0apBhauCasJZfCw9djEa.kL.V89VQ/luXU8XXUTIZ7SFVIhQxbEy', 0, 'cliente', 'Activo', '2026-03-02 05:09:19', '2026-03-02 05:09:19'),
(9, 'Estephani olivero', '3210989022', 'estephani22', '$2y$12$O.o4G6Bblv6A1kfdfqHZYundYPwUINoqDVZNkCnqtVo2AkXPqPFPe', 0, 'cliente', 'Activo', '2026-03-04 06:58:06', '2026-03-04 06:58:06'),
(10, 'juan david', '325745865', 'jdiaz73@itfip', '$2y$12$xeKjeeUbreUH8/ECM7m.weE/Vxdvsna5QCWfIH1m8OI3tDq6Y5c9C', 0, 'cliente', 'Activo', '2026-03-06 07:04:24', '2026-03-06 07:04:24'),
(11, 'luis carlos', '3214384734', 'lbarreto42@itfip.edu.co', '$2y$12$FhHKGCD7046gxYiq8PYR1eAFGAWKOTyaXNZc7m4n3qSiLjx/NMmpi', 0, 'cliente', 'Activo', '2026-03-07 07:02:10', '2026-03-07 07:02:10'),
(12, 'Alejandra Castañeda', '3024758456', 'minos3217@gmail.com', '$2y$12$mIvpWTr0mfZr59zbtWAdrO.tbT/z2O0/AMUN26HEhtUxTe50jzkeC', 0, 'cliente', 'Activo', '2026-03-10 23:01:06', '2026-03-10 23:01:06'),
(13, 'fulano perez', '3021458652', 'funalo@gmail.com', '$2y$12$mCeMZQBEMObSdwK.JwsU7emc9nutgUvaiz1Nz9Z7H.Uok3j5dbKlO', 0, 'cliente', 'Activo', '2026-03-11 01:43:32', '2026-03-11 01:43:32'),
(14, 'Karen Feria Madrigal', '3002944712', 'karenferia185@gmail.com', '$2y$12$F8gTzX1zXQaK1x6qUVHI.ultWVKjWXZRTH0kix/b80lp2F8mpZX2i', 0, 'cliente', 'Activo', '2026-03-11 04:26:52', '2026-03-11 04:26:52'),
(15, 'Alejandra Castañeda', '3021452365', 'alejandracas3217@gmail.com', '$2y$12$Bvabs7rPphiWhNLMbRRGlOgehX6C.onuWsHFvNQeI19aZBWGqIUPu', 0, 'cliente', 'Activo', '2026-03-20 06:46:43', '2026-03-20 06:46:43'),
(16, 'Admin MiniMarket', '1-240-865-7391', 'admin@minimarket.com', '$2y$12$ujqZn5v/XJl5bmCLT/UksO9IaXP/w6oQZ/q69nRkapYnIxakRhHRy', 0, 'admin', 'Activo', '2026-03-26 02:26:13', '2026-03-26 02:26:13'),
(17, 'Ale suarez', '3021458545', 'aleja3217@gmail.com', '$2y$12$RJspwnX1LQCsvxK58tApHeG41aS9wwjEPJ14uQfEzT/6haIBRHog.', 0, 'cliente', 'Activo', '2026-03-27 09:41:47', '2026-03-27 09:41:47'),
(18, 'MAIRA ALEJANDRA', '33554335', 'ale@minimarket.com', '$2y$12$7f61Vi7xDYXOchx2s7u99eb5Op8iwdcsUtYNaxshkQ2Yqr0msNIpO', 0, 'cliente', 'Activo', '2026-03-28 05:48:40', '2026-03-28 05:48:40'),
(19, 'Lulo', '321452325', 'luli@gmail.com', '$2y$12$6EF2KFwhMJgWFvJoycC8D.abs5EjaW0wozcK8hwRXiRmbA4GwlaDC', 0, 'cliente', 'Activo', '2026-03-28 05:49:30', '2026-03-28 05:49:30'),
(20, 'Lulo2', '321452325', 'luli2@gmail.com', '$2y$12$NrTbcRvHEQr7hONI2AMjpecD2XHZTvVs4BWVAzOhcawPzCGKyy1w2', 0, 'cliente', 'Activo', '2026-03-28 05:53:56', '2026-03-28 05:53:56'),
(21, 'karen', '3214568566', 'karens2@gmail.com', '$2y$12$0gnAV8KuiWpSuMruPnsPQOPUB9zQOnLRbnx72YMp3XdnJ1Vl4JVGy', 0, 'cliente', 'Activo', '2026-03-28 05:56:45', '2026-03-28 05:56:45'),
(22, 'karol', '3214568454', 'karols2@gmail.com', '$2y$12$qpX.l.pbsVKlhf6KpXG.BOhwmIiaR9jkv/BrEsMKT4FIVgM.IojLK', 0, 'cliente', 'Activo', '2026-03-28 05:57:50', '2026-03-28 05:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint UNSIGNED NOT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id`, `usuario_id`, `total`, `fecha`) VALUES
(1, 1, 4800.00, '2026-03-27 17:17:53'),
(2, 1, 1800.00, '2026-03-27 17:36:52'),
(3, 1, 4200.00, '2026-03-27 17:49:09'),
(4, 1, 6600.00, '2026-03-27 18:06:56'),
(5, 1, 2400.00, '2026-03-27 18:12:43'),
(6, 1, 4800.00, '2026-03-27 18:14:32'),
(7, 1, 2400.00, '2026-03-27 18:16:07'),
(8, 1, 2400.00, '2026-03-27 18:17:18'),
(9, 1, 2400.00, '2026-03-27 18:22:16'),
(10, 1, 2400.00, '2026-03-27 23:25:51'),
(11, 1, 2400.00, '2026-03-27 23:37:55'),
(12, 1, 1800.00, '2026-03-27 23:38:16'),
(13, 1, 1800.00, '2026-03-28 00:34:56'),
(14, 1, 1800.00, '2026-03-28 00:52:10'),
(15, 1, 1800.00, '2026-03-28 02:42:16'),
(16, 1, 1800.00, '2026-03-28 04:58:22'),
(17, 1, 4920.00, '2026-03-28 05:20:38'),
(18, 16, 4800.00, '2026-03-28 06:08:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_venta` (`venta_id`),
  ADD KEY `fk_detalle_producto` (`producto_id`);

--
-- Indexes for table `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_categoria` (`categoria_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sesiones_caja`
--
ALTER TABLE `sesiones_caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ventas_usuario` (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caja`
--
ALTER TABLE `caja`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sesiones_caja`
--
ALTER TABLE `sesiones_caja`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sesiones_caja`
--
ALTER TABLE `sesiones_caja`
  ADD CONSTRAINT `sesiones_caja_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
