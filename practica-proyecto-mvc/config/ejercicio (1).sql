-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-12-2023 a las 15:35:12
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
(9, 'Eduardo', 'Mendoza', '1960'),
(10, 'Natalia', 'García Garrido', '1982'),
(11, 'Francisco', 'Ibáñez', '1939'),
(12, 'Eloy', 'Romero', '1901');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `codigo` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `codigo_autor` int(11) NOT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`codigo`, `titulo`, `codigo_autor`, `disponible`, `descripcion`, `precio`) VALUES
(4, 'Don Quijote de la Mancha', 2, 1, NULL, 25),
(5, 'Rinconete y Cortadillo', 2, 0, '', 25),
(6, '(Des) Cuentos Increíbles', 6, 1, NULL, 25),
(7, 'El ratoncito pérez', 2, 1, NULL, 25),
(9, 'Caperucita Roja', 2, 0, NULL, 25),
(11, 'La estrella de sangre', 8, 1, NULL, 25),
(12, 'Sin Noticias de Gurb', 9, 1, NULL, 25),
(13, 'Novelas ejemplares', 2, 1, NULL, 25),
(14, 'El paciente', 1, 1, NULL, 25),
(16, 'Las legiones malditas', 5, 1, NULL, 25),
(17, 'Escipión', 5, 1, NULL, 25),
(18, 'Viajar sólo a Marruecos', 7, 1, NULL, 25),
(20, 'El botones sacarino', 11, 1, 'recopilación de títulos del botones sacarino', 125),
(21, 'Cicatriz', 1, 1, 'Libro policiaco ambientado en Málaga y Madrid', 2),
(22, 'Reina Roja', 1, 1, 'Libro de reinas rojas', 3),
(23, 'Yo Maru', 6, 1, '', 19),
(24, 'Manual hacia la grandez', 7, 1, 'Descubriendo cómo vender humos en diferentes olores y formas', 100),
(25, 'El boli de gel verde', 12, 1, '', 9),
(26, 'Don Quijote de la Mancha', 2, 0, 'Las trepidantes aventuras del ingenioso hidalgo Don Quijote de La Panza', 25);

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
  `lastlogindate` datetime DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `email`, `nombre`, `apellidos`, `password`, `createddate`, `lastlogindate`, `rol`) VALUES
('david77', 'davidesi@gmail.com', 'david', 'herrero', '$2y$10$a1HwMTSOjQu7dfWs.4BYCu4k5dVVF/HVIWqSE6mCcQ1pjbWfFsNW.', '2023-12-18 00:11:26', '2023-12-23 10:05:54', 'Admin'),
('david7701', 'd@h.es', 'David', 'Herrero', '$2y$10$Jfywaq2JlesXic4IR0jOdOe5mzcrkOcmnvougo4h3j9hLdnHgCKsm', '2023-12-20 21:17:43', NULL, 'Admin'),
('davidesi', 'david@herrero.us', 'David', 'Herrero Estévez', '$2y$10$YxQeR0fTdrJjNsNZ/q/3/eFLcVcc3jyASlKHOQaAPfcm6ttAbbXAK', '2023-12-18 00:01:39', NULL, 'Admin'),
('eusebio', 'eusebio@hotmail.com', 'Eusebio', 'Eusebio', '$2y$10$Eo.SgyoX5Zq6nPQ84lofq.Ow5bKRE6WYysow5uBXxvjwDsCRZpyB.', '2023-12-23 09:29:06', '2023-12-23 10:00:43', 'Admin'),
('felipe', 'felipe@gutierrez.san', 'felipe', 'gutierrez sanchis', '$2y$10$GzxkU.7wyATuLmVVEyXwn.4yLDKp8neoPs4lTVmhtVThRHEJq7efq', '2023-12-22 17:21:44', '2023-12-23 09:02:24', 'Admin');

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
  MODIFY `codigo_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
