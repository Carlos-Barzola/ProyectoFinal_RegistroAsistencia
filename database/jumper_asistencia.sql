-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2026 a las 07:25:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jumper_asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `presente` tinyint(1) NOT NULL,
  `registrado_por_usuario_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `estudiante_id`, `curso_id`, `fecha`, `presente`, `registrado_por_usuario_id`, `created_at`) VALUES
(1, 1, 1, '2026-02-03', 1, 2, '2026-02-03 18:08:39'),
(2, 2, 1, '2026-02-03', 1, 2, '2026-02-03 18:08:39'),
(3, 3, 1, '2026-02-03', 1, 2, '2026-02-03 18:08:39'),
(10, 1, 1, '2026-02-02', 1, 2, '2026-02-03 18:15:03'),
(11, 2, 1, '2026-02-02', 1, 2, '2026-02-03 18:15:03'),
(12, 3, 1, '2026-02-02', 0, 2, '2026-02-03 18:15:03'),
(13, 1, 1, '2026-02-04', 1, 2, '2026-02-04 00:27:39'),
(14, 2, 1, '2026-02-04', 1, 2, '2026-02-04 00:27:39'),
(15, 4, 1, '2026-02-04', 1, 2, '2026-02-04 00:27:39'),
(18, 4, 1, '2026-02-03', 1, 2, '2026-02-04 00:28:23'),
(21, 5, 1, '2026-02-04', 0, 2, '2026-02-04 03:17:16'),
(23, 1, 1, '2026-02-07', 1, 2, '2026-02-04 05:41:52'),
(24, 2, 1, '2026-02-07', 1, 2, '2026-02-04 05:41:52'),
(25, 5, 1, '2026-02-07', 1, 2, '2026-02-04 05:41:52'),
(26, 4, 1, '2026-02-07', 1, 2, '2026-02-04 05:41:52'),
(27, 1, 1, '2026-02-10', 1, 2, '2026-02-04 05:55:08'),
(28, 2, 1, '2026-02-10', 1, 2, '2026-02-04 05:55:08'),
(29, 5, 1, '2026-02-10', 1, 2, '2026-02-04 05:55:08'),
(30, 4, 1, '2026-02-10', 1, 2, '2026-02-04 05:55:08'),
(31, 1, 1, '2026-02-06', 1, 2, '2026-02-04 05:55:52'),
(32, 2, 1, '2026-02-06', 1, 2, '2026-02-04 05:55:52'),
(33, 5, 1, '2026-02-06', 0, 2, '2026-02-04 05:55:52'),
(34, 4, 1, '2026-02-06', 0, 2, '2026-02-04 05:55:52'),
(35, 7, 2, '2026-02-05', 1, 3, '2026-02-04 06:03:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `activo`, `created_at`) VALUES
(1, 'T-912', 1, '2026-02-03 18:03:30'),
(2, 'T-1317', 1, '2026-02-04 00:08:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `creado_por_usuario_id` int(11) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `edad` int(11) NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `curso_id`, `creado_por_usuario_id`, `nombres`, `apellidos`, `edad`, `celular`, `activo`, `created_at`) VALUES
(1, 1, 2, 'Abby', 'Barzola', 18, '0990171181', 1, '2026-02-03 18:06:41'),
(2, 1, 2, 'Katherine', 'Macias', 30, '09850210102', 1, '2026-02-03 18:07:10'),
(3, 1, 2, 'Maria', 'Salas', 40, '0989965423', 0, '2026-02-03 18:07:43'),
(4, 1, 2, 'Maria', 'Salas', 40, '0989965423', 1, '2026-02-04 00:25:32'),
(5, 1, 2, 'Alyssa', 'Macias', 20, '0990181190', 1, '2026-02-04 01:51:24'),
(6, 1, 2, 'Leyda', 'barzo', 38, '0998644368', 0, '2026-02-04 03:16:01'),
(7, 2, 3, 'Eduardo', 'Molina', 25, '0999999999', 1, '2026-02-04 06:03:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'maestro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rol_id`, `nombre`, `apellido`, `correo`, `password_hash`, `curso_id`, `activo`, `created_at`) VALUES
(1, 1, 'Admin', 'Jumper', 'admin@jumper.com', '$2y$10$ljNIYlHYXGDfjqJtecIrj..gglsfMEE.N6FmS2jVWAxltN4JSroKu', NULL, 1, '2026-02-03 16:52:52'),
(2, 2, 'Josue', 'Ruiz', 'jruiz@jumper.com', '$2y$10$IFPbK2O50qxk68E7XGRHSO1oXpkoWBmBrL2FMK7ZQsREOrHUpZzU6', 1, 1, '2026-02-03 18:05:02'),
(3, 2, 'Gabriel', 'Caicedo', 'gcaicedo@jumper.com', '$2y$10$0nQ9Ylimp8dOoepb0JiI5efBrcX5.32R6g.RQJ07y12uz5Y5yVpZG', 2, 1, '2026-02-04 00:19:43'),
(4, 2, 'Katherine', 'Macias', 'kmacias@jumper.com', '$2y$10$8Y3og4XA0VSr3HZMVUnIkO78u0eIuO6mtArYp9y8LDLd6RzfNHwjC', 1, 0, '2026-02-04 00:22:10'),
(5, 2, 'Alfredo', 'Salas', 'asalas@jumper.com', '$2y$10$Wu77IBRg1fGRBYeXXxXA2.07bW3MIKO7QXRIYTyTEaWNOaIl8ijSm', 2, 0, '2026-02-04 01:56:07'),
(7, 2, 'Jose', 'Salas', 'jsalas@jumper.com', '$2y$10$oozI/Qup3YhwjXkhIJcBteSVa1mdCTVEF5DOuN8ohDb3lZPgxhQTa', 2, 1, '2026-02-04 02:05:45'),
(8, 2, 'David', 'Ortega', 'dortega@jumper.ecom', '$2y$10$4APOK.p3mE4EFdr9lGM6wuZfYgrDX/4fNBxpGdMP.tUc4.S14Ga4u', 2, 0, '2026-02-04 02:11:10'),
(9, 2, 'Martin', 'Mora', 'mmora@jumper.com', '$2y$10$fAGLe/xiWbIIwZsI7MDJr.TCz3FzPTvHoO4Jjt3TwXyNeLU95iukm', 1, 1, '2026-02-04 03:36:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_asistencia` (`estudiante_id`,`fecha`),
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `registrado_por_usuario_id` (`registrado_por_usuario_id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `creado_por_usuario_id` (`creado_por_usuario_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`),
  ADD CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `asistencias_ibfk_3` FOREIGN KEY (`registrado_por_usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `estudiantes_ibfk_2` FOREIGN KEY (`creado_por_usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
