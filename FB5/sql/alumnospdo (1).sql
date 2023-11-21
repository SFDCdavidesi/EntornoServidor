-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-11-2023 a las 18:48:15
-- Versión del servidor: 10.3.37-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alumnospdo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnospdo`
--

CREATE TABLE `alumnospdo` (
  `id` varchar(18) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido1` varchar(64) DEFAULT NULL,
  `apellido2` varchar(64) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `telefono` varchar(32) DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `fechaModificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `modificadoPor` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `alumnospdo`
--

INSERT INTO `alumnospdo` (`id`, `nombre`, `apellido1`, `apellido2`, `fechaNacimiento`, `email`, `telefono`, `fechaCreacion`, `fechaModificacion`, `modificadoPor`) VALUES
('alumno1', 'Andrés', 'Gutiérrez', 'Sanchís', '1983-10-12', 'andres@gmail.com', NULL, '2023-10-19 16:45:20', '2023-10-19 18:45:20', 'david');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `createddate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`email`, `password`, `createddate`) VALUES
('davidesi@gmail.com', '$2y$10$GJuGajmSUvNnAitUUUQ.2OY.Lic5YdByGDIKCDTDNEsRPYeF8KaoG', '2023-11-21 18:38:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnospdo`
--
ALTER TABLE `alumnospdo`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
