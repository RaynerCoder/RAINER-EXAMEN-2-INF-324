-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2023 a las 01:25:57
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
-- Base de datos: `workflow2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujo`
--

CREATE TABLE `flujo` (
  `id` int(11) NOT NULL,
  `flujo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `procesoSiguiente` varchar(3) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `rol` varchar(15) DEFAULT NULL,
  `pantalla` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `flujo`
--

INSERT INTO `flujo` (`id`, `flujo`, `proceso`, `procesoSiguiente`, `tipo`, `rol`, `pantalla`) VALUES
(1, 'F1', 'P1', 'P2', 'I', 'secretaria', 'convocatoria'),
(2, 'F1', 'P2', 'P3', 'P', 'estudiante', 'publicacion'),
(3, 'F1', 'P3', 'P4', 'P', 'estudiante', 'documentos'),
(4, 'F1', 'P4', 'P5', 'P', 'estudiante', 'presentarDoc'),
(5, 'F1', 'P5', 'P6', 'P', 'kardexF', 'recepcionDoc'),
(6, 'F1', 'P6', 'P7', 'P', 'secretaria', 'revisionDoc'),
(7, 'F1', 'P7', 'P8', 'P', 'secretaria', 'listaPos'),
(8, 'F1', 'P8', '', 'Q', 'secretaria', 'habilitado'),
(9, 'F1', 'P9', 'P11', 'P', 'secretaria', 'notifica'),
(10, 'F1', 'P10', 'P11', 'P', 'estudiante', 'verifica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujocondicional`
--

CREATE TABLE `flujocondicional` (
  `id` int(11) NOT NULL,
  `flujo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `psi` varchar(3) DEFAULT NULL,
  `pno` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `flujocondicional`
--

INSERT INTO `flujocondicional` (`id`, `flujo`, `proceso`, `psi`, `pno`) VALUES
(1, 'F1', 'P8', 'P10', 'P9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujousuario`
--

CREATE TABLE `flujousuario` (
  `id` int(11) NOT NULL,
  `numeroPostulante` int(11) DEFAULT NULL,
  `flujo` varchar(3) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `flujousuario`
--

INSERT INTO `flujousuario` (`id`, `numeroPostulante`, `flujo`, `proceso`, `fechaInicio`, `fechaFin`, `usuario`) VALUES
(1, 1, 'F1', 'P1', '2022-11-03 12:00:00', '2022-11-03 12:15:00', 'maria'),
(2, 1, 'F1', 'P2', '2022-11-03 12:15:00', '2022-11-03 12:30:00', 'juan'),
(3, 1, 'F1', 'P3', '2022-11-03 12:30:00', '2022-11-03 12:50:00', 'juan'),
(4, 1, 'F1', 'P4', '2022-11-10 15:00:00', '2022-11-10 15:20:00', 'juan'),
(5, 1, 'F1', 'P5', '2022-11-10 15:20:00', '2022-11-10 15:30:00', 'luis'),
(6, 1, 'F1', 'P6', '2022-11-12 08:00:00', '2022-12-10 16:30:00', 'maria'),
(7, 1, 'F1', 'P7', '2022-12-03 08:00:00', '2022-12-20 16:30:00', 'maria'),
(8, 1, 'F1', 'P8', '2022-12-03 08:00:00', '2022-12-20 16:30:00', 'maria'),
(9, 1, 'F1', 'P9', '2022-12-03 08:00:00', '2022-12-20 16:30:00', 'maria'),
(10, 1, 'F1', 'P10', '2023-01-25 12:00:00', NULL, 'juan');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `flujo`
--
ALTER TABLE `flujo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `flujocondicional`
--
ALTER TABLE `flujocondicional`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `flujousuario`
--
ALTER TABLE `flujousuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `flujo`
--
ALTER TABLE `flujo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `flujocondicional`
--
ALTER TABLE `flujocondicional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `flujousuario`
--
ALTER TABLE `flujousuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
