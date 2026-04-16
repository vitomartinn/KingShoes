-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2026 a las 00:33:29
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
-- Base de datos: `king_shoes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calzado`
--

CREATE TABLE `calzado` (
  `id_calzado` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `talle` varchar(10) NOT NULL,
  `id_tienda` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calzado`
--

INSERT INTO `calzado` (`id_calzado`, `modelo`, `talle`, `id_tienda`, `precio`, `stock`) VALUES
(1, 'Nike Air Max', '42', 1, 85000.00, 15),
(2, 'Adidas Superstar', '40', 2, 72000.00, 20),
(3, 'Puma RS-X', '41', 3, 68000.00, 10),
(4, 'Vans Old Skool', '43', 4, 55000.00, 25),
(5, 'Converse Chuck Taylor', '39', 5, 48000.00, 30),
(6, 'New Balance 574', '44', 6, 79000.00, 12),
(7, 'Reebok Classic', '41', 7, 61000.00, 18),
(8, 'Nike Air Force 1', '42', 8, 90000.00, 8),
(9, 'Adidas Stan Smith', '40', 9, 65000.00, 22),
(10, 'Fila Disruptor', '38', 10, 58000.00, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `num_cliente` varchar(20) NOT NULL,
  `nom_cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `num_cliente`, `nom_cliente`) VALUES
(1, 'CLI001', 'Juan Pérez'),
(2, 'CLI002', 'María González'),
(3, 'CLI003', 'Carlos Rodríguez'),
(4, 'CLI004', 'Ana Martínez'),
(5, 'CLI005', 'Luis Fernández'),
(6, 'CLI006', 'Laura Sánchez'),
(7, 'CLI007', 'Diego López'),
(8, 'CLI008', 'Sofía Torres'),
(9, 'CLI009', 'Martín Díaz'),
(10, 'CLI010', 'Valentina Ruiz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_de_compra`
--

CREATE TABLE `orden_de_compra` (
  `id_compra` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_calzado` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_de_compra`
--

INSERT INTO `orden_de_compra` (`id_compra`, `fecha`, `cantidad`, `id_calzado`, `total`) VALUES
(1, '2026-01-05', 2, 1, 170000.00),
(2, '2026-01-10', 1, 2, 72000.00),
(3, '2026-01-15', 3, 3, 204000.00),
(4, '2026-01-20', 1, 4, 55000.00),
(5, '2026-02-01', 2, 5, 96000.00),
(6, '2026-02-10', 1, 6, 79000.00),
(7, '2026-02-14', 4, 7, 244000.00),
(8, '2026-02-20', 2, 8, 180000.00),
(9, '2026-03-01', 1, 9, 65000.00),
(10, '2026-03-15', 3, 10, 174000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id_tienda` int(11) NOT NULL,
  `nombre_tienda` varchar(100) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id_tienda`, `nombre_tienda`, `id_cliente`, `direccion`) VALUES
(1, 'King Shoes Centro', 1, 'Av. Corrientes 1234, CABA'),
(2, 'King Shoes Palermo', 2, 'Thames 567, Palermo'),
(3, 'King Shoes Belgrano', 3, 'Cabildo 890, Belgrano'),
(4, 'King Shoes Flores', 4, 'Av. Rivadavia 4321, Flores'),
(5, 'King Shoes Quilmes', 5, 'Mitre 234, Quilmes'),
(6, 'King Shoes Lomas', 6, 'Gral. Paz 678, Lomas de Zamora'),
(7, 'King Shoes Morón', 7, 'Rivadavia 1122, Morón'),
(8, 'King Shoes San Isidro', 8, 'Av. del Libertador 3344, San Isidro'),
(9, 'King Shoes La Plata', 9, 'Calle 7 Nro. 456, La Plata'),
(10, 'King Shoes Mar del Plata', 10, 'San Martín 789, Mar del Plata');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calzado`
--
ALTER TABLE `calzado`
  ADD PRIMARY KEY (`id_calzado`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `orden_de_compra`
--
ALTER TABLE `orden_de_compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_calzado` (`id_calzado`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id_tienda`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calzado`
--
ALTER TABLE `calzado`
  ADD CONSTRAINT `calzado_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `orden_de_compra`
--
ALTER TABLE `orden_de_compra`
  ADD CONSTRAINT `orden_de_compra_ibfk_1` FOREIGN KEY (`id_calzado`) REFERENCES `calzado` (`id_calzado`);

--
-- Filtros para la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD CONSTRAINT `tienda_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
