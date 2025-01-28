-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-01-2025 a las 21:16:35
-- Versión del servidor: 10.11.6-MariaDB-0+deb12u1
-- Versión de PHP: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `telefono`, `email`, `direccion`, `creado_en`) VALUES
(2, 'María López', '0987654321', 'maria.lopez@example.com', 'Avenida Siempreviva', '2025-01-28 17:19:13'),
(3, 'Carlos García', '0976543210', 'carlos.garcia@example.com', 'Calle del Sol 456', '2025-01-28 17:19:13'),
(5, 'Jarrinson Zamora', '0965626541', 'jzamora@unemi.edu.ec', '7 de mayo ', '2025-01-28 17:45:12'),
(6, 'Jarrinson Zamora', '0000000000', 'ansandoval@mailes.ueb.edu.ec', 'ANGEL VERDEZOTO PAZOS Y PASAJE RIOBANBA', '2025-01-28 18:01:13'),
(7, 'Jarrinson Zamora', '0965626541', 'ansandoval@mailes.ueb.edu.ec', '7 de mayo', '2025-01-28 21:12:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT current_timestamp(),
  `rol` enum('admin','usuario') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `nombre_completo`, `email`, `creado_en`, `rol`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrador del Sistema', 'admin@example.com', '2025-01-28 17:32:51', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
