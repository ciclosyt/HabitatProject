-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2021 a las 19:26:02
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `habitat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adimin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `telefono` char(9) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fecha_inscripcion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adimin`
--

INSERT INTO `adimin` (`id`, `nombre`, `apellido`, `telefono`, `email`, `password`, `fecha_inscripcion`) VALUES
(1, ' Javier', 'Jatar Gonzalez', '660660660', 'habitatDev1@habitat.es', '$2y$10$Y/XDZoCatxMDEhoL8vH.EOpx0fMLhjcRklLLhg515FpI1r0uy0feq', '2021-05-16 19:18:55'),
(2, 'Javier', 'M Calvete Parrilla', '660660660', 'habitatDev2@habitat.es', '$2y$10$Y/XDZoCatxMDEhoL8vH.EOpx0fMLhjcRklLLhg515FpI1r0uy0feq', '2021-05-16 19:18:55'),
(3, 'Jose Cabral Antonio', 'Jamba', '660660660', 'habitatDev3@habitat.es', '$2y$10$Y/XDZoCatxMDEhoL8vH.EOpx0fMLhjcRklLLhg515FpI1r0uy0feq', '2021-05-16 19:18:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `num_compra` char(8) NOT NULL,
  `ref_compra_uuid` char(36) NOT NULL,
  `nom_usuario` varchar(100) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE `inmueble` (
  `id` int(11) NOT NULL,
  `id_proprietario` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `num_habitacione` int(11) NOT NULL,
  `wc` int(11) NOT NULL,
  `estacionamiento` int(11) NOT NULL,
  `fecha_inscripcion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inmueble`
--

INSERT INTO `inmueble` (`id`, `id_proprietario`, `titulo`, `precio`, `imagen`, `descripcion`, `num_habitacione`, `wc`, `estacionamiento`, `fecha_inscripcion`) VALUES
(9, 1, 'La Casa de Sus sueños', '8270.00', '608a463296d28c39ed95452d17b8f820.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore officia sint atque optio alias explicabo inventore omnis vitae, perspiciatis quaerat neque ipsa cumque commodi quo soluta nam facere, dicta quod.\r\nAsperiores et numquam cumque. \r\nLorem ipsum dolor sit amet consectetur adipisicing elit.', 3, 2, 2, '2021-04-27 00:42:00'),
(14, 1, 'La Casa perfecta', '5541.00', 'a2bb655d01a590b0ba39627cb9de490e.jpg', 'Reiciendis impedit aliquam voluptate corporis officiis similique illo asperiores nesciunt consequuntur.\r\nQuod illum adipisci exercitationem neque nesciunt commodi natus consectetur porro explicabo consequuntur ipsa, distinctio totam. Reiciendis impedit aliquam voluptate corporis officiis similique illo asperiores nesciunt consequuntur.', 6, 3, 2, '2021-05-08 18:41:31'),
(15, 1, 'La decoración Moderna ', '7845.00', '53d14632063364e56ae6a79962dca391.jpg', 'Reiciendis impedit aliquam voluptate corporis officiis similique illo asperiores nesciunt consequuntur. Quod illum adipisci exercitationem neque nesciunt commodi natus consectetur porro explicabo consequuntur ipsa, distinctio totam. Reiciendis impedit aliquam voluptate corporis officiis similique illo asperiores nesciunt consequuntur.', 6, 4, 2, '2021-05-11 23:37:23'),
(24, 5, 'Casa a su gusto', '7845.00', '4584512ae9f8595b698d95316df35076.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore officia sint atque optio alias explicabo inventore omnis vitae, perspiciatis quaerat neque ipsa cumque commodi quo soluta nam facere, dicta quod.\r\nAsperiores et numquam cumque. \r\nLorem ipsum dolor sit amet consectetur adipisicing elit.', 3, 3, 3, '2021-05-14 17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `remintente` varchar(60) NOT NULL,
  `destinatario` varchar(60) NOT NULL,
  `contexto` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proprietario`
--

CREATE TABLE `proprietario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `telefono` char(9) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fecha_inscripcion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proprietario`
--

INSERT INTO `proprietario` (`id`, `nombre`, `apellido`, `telefono`, `email`, `password`, `fecha_inscripcion`) VALUES
(1, 'Javier', 'Coma Carmen', '660000742', 'javierC@gmail.com', '$2y$10$TcWOHlJzC22xQjiWVmcIHOkhTIWIUuuCKz9E3aEg42HO6D3uX6Bh6', '2021-05-02 00:33:19'),
(5, ' Andrade', 'Velazaq', '123123123', 'cabralzay@gmail.com', '$2y$10$Y/XDZoCatxMDEhoL8vH.EOpx0fMLhjcRklLLhg515FpI1r0uy0feq', '2021-05-09 18:23:38'),
(9, 'Andrade EFER', 'Velazaq MADDD', '123123123', 'jami@gmail.com', '$2y$10$Y/XDZoCatxMDEhoL8vH.EOpx0fMLhjcRklLLhg515FpI1r0uy0feq', '2021-05-13 18:24:03'),
(10, ' MM', 'mm', '660660660', 'mm@gmail.com', '$2y$10$hDcJlEjn9IcU2OtsqSBT1ezKBv75EDE3EfQuyLh6z3iaAMMBcDib6', '0000-00-00 00:00:00'),
(11, ' Andrade', 'Velazaq', '626262534', 'javierC@gmail.comD', '$2y$10$JsfttVxaJ3OOluq4h9sby.tTu5JsCWX4Tlk0RGjBH0abOkZApC.pO', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `num_reserva` char(8) NOT NULL,
  `ref_reserva_uuid` char(36) DEFAULT NULL,
  `nom_usuario` varchar(100) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `telefono` char(9) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fecha_inscripcion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `telefono`, `email`, `password`, `fecha_inscripcion`) VALUES
(1, 'Miquel', 'Azevedo Miller', '662662665', 'azevedo@gmail.com', '$2y$10$Y/XDZoCatxMDEhoL8vH.EOpx0fMLhjcRklLLhg515FpI1r0uy0feq', '2021-05-13 01:39:54'),
(2, 'Jose', 'Cabral AC', '660660660', 'cabral12@gmail.com', '$2y$10$ak9B4geCk0bYMT3taNI2JOFp/7jj5AMlnizxsAMc19EAwdEQU3Pye', '2021-05-13 01:40:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adimin`
--
ALTER TABLE `adimin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proprietario` (`id_proprietario`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reserva` (`id_reserva`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adimin`
--
ALTER TABLE `adimin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD CONSTRAINT `inmueble_ibfk_1` FOREIGN KEY (`id_proprietario`) REFERENCES `proprietario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_mensaje`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`id_mensaje`) REFERENCES `proprietario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
