-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 30-08-2024 a las 19:24:20
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peluqueria_p`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idinventario` int(11) NOT NULL DEFAULT '200',
  `cantidad` varchar(45) NOT NULL,
  `precio` float DEFAULT NULL,
  `producto_idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `cedula` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `rol_idrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL DEFAULT '1000',
  `nombre_producto` varchar(45) NOT NULL,
  `detaller_producto` varchar(45) DEFAULT NULL,
  `precio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_has_servicio`
--

CREATE TABLE `producto_has_servicio` (
  `producto_idproducto` int(11) NOT NULL,
  `servicio_idservicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL DEFAULT '100',
  `nombre_rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombre_rol`) VALUES
(100, 'admin'),
(101, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL,
  `nombre_servicio` varchar(45) NOT NULL,
  `descripcion_servicio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `nombre_servicio`, `descripcion_servicio`) VALUES
(1, 'Corte de Cabello', 'Corte de cabello para hombre, mujer o niño. I'),
(2, 'Coloración', 'Servicio de coloración completa o reflejos. I'),
(3, 'Peinado', 'Peinado para eventos especiales, como bodas o'),
(4, 'Tratamiento Facial', 'Tratamiento facial rejuvenecedor que incluye '),
(5, 'Masaje Relajante', 'Masaje corporal completo para aliviar tension'),
(6, 'Manicura', 'Cuidado de las manos, incluyendo limado, cort'),
(7, 'Pedicura', 'Cuidado de los pies, incluyendo exfoliación, '),
(8, 'Depilación', 'Depilación con cera en diferentes áreas del c'),
(9, 'Tratamiento Capilar', 'Tratamiento especializado para el cabello, qu'),
(10, 'Paquete Spa', 'Paquete completo que incluye masaje, tratamie'),
(11, 'Corte de Cabello', 'Corte de cabello para hombre, mujer o niño. I'),
(12, 'Coloración', 'Servicio de coloración completa o reflejos. I'),
(13, 'Peinado', 'Peinado para eventos especiales, como bodas o'),
(14, 'Tratamiento Facial', 'Tratamiento facial rejuvenecedor que incluye '),
(15, 'Masaje Relajante', 'Masaje corporal completo para aliviar tension'),
(16, 'Manicura', 'Cuidado de las manos, incluyendo limado, cort'),
(17, 'Pedicura', 'Cuidado de los pies, incluyendo exfoliación, '),
(18, 'Depilación', 'Depilación con cera en diferentes áreas del c'),
(19, 'Tratamiento Capilar', 'Tratamiento especializado para el cabello, qu'),
(20, 'Paquete Spa', 'Paquete completo que incluye masaje, tratamie');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idfactura` int(11) NOT NULL DEFAULT '2000',
  `fecha` date NOT NULL,
  `codigo_factura` varchar(45) NOT NULL,
  `precio` varchar(45) NOT NULL,
  `servicio_idservicio` int(11) NOT NULL,
  `persona_idpersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idinventario`,`producto_idproducto`),
  ADD KEY `fk_inventario_producto1_idx` (`producto_idproducto`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`,`rol_idrol`),
  ADD KEY `fk_persona_rol1_idx` (`rol_idrol`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `producto_has_servicio`
--
ALTER TABLE `producto_has_servicio`
  ADD PRIMARY KEY (`producto_idproducto`,`servicio_idservicio`),
  ADD KEY `fk_producto_has_servicio_servicio1_idx` (`servicio_idservicio`),
  ADD KEY `fk_producto_has_servicio_producto1_idx` (`producto_idproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idservicio`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idfactura`,`servicio_idservicio`,`persona_idpersona`),
  ADD KEY `fk_venta_servicio1_idx` (`servicio_idservicio`),
  ADD KEY `fk_venta_persona1_idx` (`persona_idpersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_rol1` FOREIGN KEY (`rol_idrol`) REFERENCES `rol` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_has_servicio`
--
ALTER TABLE `producto_has_servicio`
  ADD CONSTRAINT `fk_producto_has_servicio_producto1` FOREIGN KEY (`producto_idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_has_servicio_servicio1` FOREIGN KEY (`servicio_idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_persona1` FOREIGN KEY (`persona_idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_servicio1` FOREIGN KEY (`servicio_idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
