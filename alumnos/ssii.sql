-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2023 a las 19:38:14
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ssii`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnosmysql`
--

CREATE TABLE `alumnosmysql` (
  `codigo` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `codigocurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnospdo`
--

CREATE TABLE `alumnospdo` (
  `codigo` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `codigocurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnospdo`
--

INSERT INTO `alumnospdo` (`codigo`, `nombre_completo`, `codigocurso`) VALUES
(7, 'David', 1),
(8, 'Andrés', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnosmysql`
--
ALTER TABLE `alumnosmysql`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `alumnospdo`
--
ALTER TABLE `alumnospdo`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnosmysql`
--
ALTER TABLE `alumnosmysql`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `alumnospdo`
--
ALTER TABLE `alumnospdo`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
