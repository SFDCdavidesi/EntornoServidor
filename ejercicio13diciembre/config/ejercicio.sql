-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2023 a las 00:46:29
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejercicio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `codigo_autor` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `año_nacimiento` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`codigo_autor`, `nombre`, `apellidos`, `año_nacimiento`) VALUES
(1, 'Juan', 'Gómez Jurado', '1977'),
(2, 'Miguel', 'De Cervantes Saavedra', '1547'),
(5, 'Santiago', 'Posteguillo', '1961'),
(6, 'Álvaro', 'De la Riva', '1977'),
(7, 'Antonio', 'Herrero Estévez', '1982'),
(8, 'Nicholas', 'Guild', '1955'),
(9, 'Eduardo', 'Mendoza', '1960');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `codigo` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `codigo_autor` int(11) NOT NULL,
  `disponible` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`codigo`, `titulo`, `codigo_autor`, `disponible`) VALUES
(1, 'Todo Vale', 1, 1),
(2, 'Todo Arde', 1, 1),
(3, 'Reina Roja', 1, 1),
(4, 'Don Quijote de la Mancha', 2, 1),
(5, 'Rinconete y Cortadillo', 2, 1),
(6, '(Des) Cuentos Increíbles', 6, 1),
(7, 'El ratoncito pérez', 2, 1),
(9, 'Caperucita Roja', 2, 0),
(11, 'La estrella de sangre', 8, 1),
(12, 'Sin Noticias de Gurb', 9, 1),
(13, 'Novelas ejemplares', 2, 1),
(14, 'El paciente', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nombre` varchar(128) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `createddate` datetime DEFAULT current_timestamp(),
  `lastlogindate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `email`, `nombre`, `apellidos`, `password`, `createddate`, `lastlogindate`) VALUES
('david77', 'davidesi@gmail.com', 'david', 'herrero', '$2y$10$a1HwMTSOjQu7dfWs.4BYCu4k5dVVF/HVIWqSE6mCcQ1pjbWfFsNW.', '2023-12-18 00:11:26', NULL),
('davidesi', 'david@herrero.us', 'David', 'Herrero Estévez', '$2y$10$YxQeR0fTdrJjNsNZ/q/3/eFLcVcc3jyASlKHOQaAPfcm6ttAbbXAK', '2023-12-18 00:01:39', NULL),
('natalia_carasandalia', 'natalia@garcia.es', 'Natalia', 'García Garrido', '$2y$10$E3Fdx9I3t0js3qLfpKgdHuusQszpG3JS7cFXV9hHRasqHzkIq6B6y', '2023-12-18 00:07:22', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`codigo_autor`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_autor` (`codigo_autor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `codigo_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
