-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2020 a las 23:17:05
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `virtualmarket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dniCliente` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dniCliente`, `nombre`, `direccion`, `email`, `pwd`, `administrador`) VALUES
('22222222', 'mario', 'C/ Moreras 12', 'maria@midominio.es', '222222', 0),
('33333333', 'jaime', 'Avda Capitán 102', 'jaime@midominio.es', '333333', 1),
('44444444', 'marta', 'C/ Valeras 4', 'marta@midominio.es', '444444', 0),
('55555555', 'juan', 'Plaza Miguel de Unamuno', 'juan@midominio.es', '555555', 1),
('66666666', 'danie', 'C/Atocha 13', 'manuel@midominio.es', '666666', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedidos`
--

CREATE TABLE `lineaspedidos` (
  `idPedido` int(4) NOT NULL,
  `nlinea` int(2) NOT NULL,
  `idProducto` int(6) DEFAULT NULL,
  `cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lineaspedidos`
--

INSERT INTO `lineaspedidos` (`idPedido`, `nlinea`, `idProducto`, `cantidad`) VALUES
(1, 1, 3, 10),
(1, 2, 4, 10),
(1, 3, 9, 10),
(3, 1, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `dirEntrega` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nTarjeta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCaducidad` date DEFAULT NULL,
  `matriculaRepartidor` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dniCliente` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `fecha`, `dirEntrega`, `nTarjeta`, `fechaCaducidad`, `matriculaRepartidor`, `dniCliente`) VALUES
(1, '2016-01-20', 'C/ Valeras, 22', '111111', '2020-02-02', 'pbf-1144', '11111111'),
(2, '2016-02-10', 'C/ Princesa, 15', '333333', '2020-02-02', 'bbc-2589', '33333333'),
(3, '2020-11-06', '', '', '0000-00-00', '', '22222222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(6) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `origen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marca` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` enum('frio','congelado','seco') COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso` int(3) NOT NULL,
  `unidades` int(5) NOT NULL,
  `volumen` int(4) DEFAULT NULL,
  `precio` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `origen`, `foto`, `marca`, `categoria`, `peso`, `unidades`, `volumen`, `precio`) VALUES
(1, 'Macarrones', 'italia', 'macarrones.jpg', 'gallo', 'seco', 250, 100, 10, 1),
(2, 'Tallarines', 'italia', 'tallarines.jpg', 'gallo', 'seco', 250, 100, 10, 1),
(3, 'Atun', 'espa?a', 'atun.jpg', 'calvo', 'seco', 250, 100, 10, 1),
(4, 'Sardinillas', 'espa?a', 'sardinas.jpg', 'dia', 'seco', 250, 100, 10, 1),
(5, 'Mejillones', 'espa?a', 'mejillones.jpg', 'calvo', 'seco', 125, 100, 10, 1),
(6, 'Fideos', 'italia', 'fideos.jpg', 'gallo', 'seco', 250, 100, 10, 1),
(7, 'Galletas Cuadradas', 'francia', 'galletas.jpg', 'gullon', 'seco', 800, 100, 10, 1),
(8, 'Barquillos', 'espa?a', 'barquillos.jpg', 'cuetara', 'seco', 150, 100, 10, 1),
(9, 'Leche entera', 'espa?a', 'leche.jpg', 'pascual', 'frio', 1000, 100, 10, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dniCliente`);

--
-- Indices de la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  ADD PRIMARY KEY (`idPedido`,`nlinea`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
