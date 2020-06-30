-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2019 a las 18:10:10
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prestamos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `nombre`, `cedula`, `direccion`, `telefono`, `estado`) VALUES
(1, 'Mario Casas', '103259878', 'Los Lagos', '214545', 1),
(2, 'Juan Camilo', '281-051089-0012s', 'Torres', '333333', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `idgasto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `concepto` varchar(50) NOT NULL,
  `gasto` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idpago` int(11) NOT NULL,
  `idprestamo` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `cuota` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idpago`, `idprestamo`, `usuario`, `fecha`, `cuota`) VALUES
(2, 2, 'juan', '2019-04-30 00:00:00', '1000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` int(11) NOT NULL,
  `permiso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `permiso`) VALUES
(1, 'Escritorio'),
(2, 'Clientes'),
(3, 'Prestamos'),
(4, 'Pagos'),
(5, 'Usuarios'),
(6, 'Gastos'),
(7, 'Consultas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `idprestamo` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fprestamo` datetime NOT NULL,
  `monto` decimal(16,2) NOT NULL,
  `interes` decimal(16,2) NOT NULL,
  `saldo` decimal(16,2) NOT NULL,
  `formapago` varchar(20) DEFAULT NULL,
  `fpago` datetime DEFAULT NULL,
  `plazo` varchar(20) DEFAULT NULL,
  `fplazo` datetime DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`idprestamo`, `idcliente`, `usuario`, `fprestamo`, `monto`, `interes`, `saldo`, `formapago`, `fpago`, `plazo`, `fplazo`, `estado`) VALUES
(2, 1, 3, '2019-04-30 00:00:00', '10000.00', '20.00', '12000.00', 'Diario', '2019-04-01 00:00:00', 'Mes', '2019-05-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariopermiso`
--

CREATE TABLE `usuariopermiso` (
  `idusuariopermiso` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idpermiso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuariopermiso`
--

INSERT INTO `usuariopermiso` (`idusuariopermiso`, `idusuario`, `idpermiso`) VALUES
(24, 3, 1),
(25, 3, 2),
(26, 3, 3),
(27, 3, 4),
(28, 3, 5),
(29, 3, 6),
(30, 3, 7),
(31, 4, 1),
(32, 4, 2),
(33, 4, 3),
(34, 4, 4),
(35, 4, 5),
(36, 4, 6),
(37, 4, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `direccion`, `telefono`, `login`, `clave`, `imagen`, `estado`) VALUES
(3, 'Juan', 'Centro 2', '8333333', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '', 1),
(4, 'Juan', 'Centro', '222222', 'juan', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`),
  ADD UNIQUE KEY `idclientes_UNIQUE` (`idcliente`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`idgasto`),
  ADD UNIQUE KEY `idgasto_UNIQUE` (`idgasto`),
  ADD KEY `fkgastosusuarios_idx` (`idusuario`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `fkPrestamos_idx` (`idprestamo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`idprestamo`),
  ADD KEY `fkClientes_idx` (`idcliente`),
  ADD KEY `fkusuarios_idx` (`usuario`);

--
-- Indices de la tabla `usuariopermiso`
--
ALTER TABLE `usuariopermiso`
  ADD PRIMARY KEY (`idusuariopermiso`),
  ADD UNIQUE KEY `idusuariopermiso_UNIQUE` (`idusuariopermiso`),
  ADD KEY `fkPermiso_idx` (`idpermiso`),
  ADD KEY `fkUsuario_idx` (`idusuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario_UNIQUE` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `idgasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idpago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `idprestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuariopermiso`
--
ALTER TABLE `usuariopermiso`
  MODIFY `idusuariopermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `fkgastosusuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fkPrestamos` FOREIGN KEY (`idprestamo`) REFERENCES `prestamos` (`idprestamo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `fkClientes` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkusuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuariopermiso`
--
ALTER TABLE `usuariopermiso`
  ADD CONSTRAINT `fkPermiso` FOREIGN KEY (`idpermiso`) REFERENCES `permisos` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkUsuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
