-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 00:57:17
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_motos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `email`, `password`) VALUES
(1, 'doloresparral@hotmail.com', '$2a$12$1kejve3AwpYKlGn6h6TOi.DsxlTp5AnYnC1nN0nh2nSBM.hVW6Pba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificacion`
--

CREATE TABLE `especificacion` (
  `id_especificacion` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `cilindrada` varchar(50) NOT NULL,
  `potencia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especificacion`
--

INSERT INTO `especificacion` (`id_especificacion`, `modelo`, `descripcion`, `cilindrada`, `potencia`) VALUES
(1, 'Interceptor 650 ', 'INTERCEPTOR 650 Captura todas las miradas dondequiera que vayas Su diseño único y atemporal captura todas las miradas donde quiera que vayas, te ofrece la maniobrabilidad ideal para interactuar en el tráfico urbano con facilidad y la suficiente potencia como para sacarte una sonrisa en las autopistas y rutas.', '648 CM3 BICILÍNDRICO EN PARALERO', '47 bph @7100 RPM'),
(2, 'Himalayan', 'Es una de las motos de Royal Enfield más vendidas a nivel mundial, la diseñamos para recorrer el mundo entero, es perfecta para esos aventureros que necesitan moverse en el día a día a sus lugares de trabajo y también quieren aprovechar cada oportunidad para ir a recorrer diferentes paisajes de este planeta  en una máquina totalmente resistente y perfecta para cualquier tipo de viaje, largo o corto.', '411 CC SINGLE CYLINDER', '24.5 bph @6500 RPM'),
(3, 'Meteor 350', 'La Meteor representa la esencia de la conducción, el espíritu de la travesía, con un diseño clásico y atemporal. La Meteor está preparada para que sea tu moto en el día a día y para esos viajes del fin de semana.', '349 CC MONOCILÍNDRICO SOHC', '20. 2 BHP @6100 RPM'),
(5, 'Classic 350', 'Un auténtico diseño británico, una moto inspirada en la época de la posguerra', 'MONOCILÍNDRICO 4T, 346CC.', '19,8 BHP @5250 RPM'),
(6, 'Continental GT 650', 'La nueva Continental GT 650 es una evolución del Continental GT 535. La original Royal Enfield British café racer. Impulsada por el nuevo motor 650 Twin, se parece en todo a su predecesor y funciona aún mucho mejor. Una joya clásica con gran tecnología.', '648 CM3 BICILÍNDRICO EN PARALELO', '47 bph @7100 RPM'),
(13, 'Scram 411', 'Una motocicleta hecha para el mundo en el que vivimos El mundo de hoy nos obliga a adaptarnos a cualquier situación. Oportunidades y obstáculos, trabajar y descansar, día y noche, carretera y off-road, rápido y lento. La nueva scram 411 es ideal para cualquier situación.', 'Monocilindrico 411 cc single cylinder', '17.88KW@6500RPM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(20) UNSIGNED NOT NULL,
  `precio` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `stock` int(40) NOT NULL,
  `id_especificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `precio`, `color`, `stock`, `id_especificacion`) VALUES
(54, 700, 'Halycon Black', 4, 5),
(56, 1000, 'Ventura Blue', 1, 1),
(58, 1040, 'Gun Metal Grey', 3, 5),
(59, 1100, 'Chrome Bronze', 2, 5),
(62, 1070, 'Pine Green', 5, 2),
(63, 1180, 'Mirage Silver', 6, 2),
(64, 900, 'Stellar Red', 3, 3),
(65, 1150, 'Mr Clean', 8, 6),
(66, 1200, 'Rocker Red', 2, 6),
(67, 990, 'British Racing Green', 1, 6),
(68, 1200, 'Graphite Red', 1, 13),
(69, 1099, 'Supernova Brown', 10, 3),
(71, 1140, 'Rocker Red', 2, 3),
(72, 1190, 'Like Blue', 2, 2),
(73, 1060, 'Granite', 3, 2),
(74, 980, 'Fireball Yelow', 3, 3),
(75, 1130, 'Orange Crush', 4, 1),
(76, 1130, 'Orange Crush', 4, 1),
(77, 1200, 'Skyline Blue', 1, 13),
(78, 1160, 'Graphite Yellow', 2, 13),
(79, 1160, 'White Flame', 2, 13),
(81, 1000, 'Ventura Blue', 2, 1),
(83, 1190, 'Stellar red', 4, 3),
(84, 1090, 'Dark Stealth Black', 7, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especificacion`
--
ALTER TABLE `especificacion`
  ADD PRIMARY KEY (`id_especificacion`),
  ADD KEY `Id_Especificación` (`id_especificacion`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `Id_Producto` (`id_producto`),
  ADD KEY `Id_Especificación` (`id_especificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `especificacion`
--
ALTER TABLE `especificacion`
  MODIFY `id_especificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_especificacion`) REFERENCES `especificacion` (`id_especificacion`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
