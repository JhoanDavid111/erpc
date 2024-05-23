-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-08-2022 a las 17:36:31
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contratnew`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docgestion`
--

CREATE TABLE `docgestion` (
  `id` int(11) NOT NULL,
  `depid` int(5) NOT NULL,
  `perid` bigint(15) NOT NULL,
  `nomar` varchar(300) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `ruta` varchar(300) NOT NULL,
  `ultserie` bigint(12) NOT NULL,
  `num` bigint(20) NOT NULL,
  `nomserie` varchar(100) NOT NULL,
  `dfin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docgestion`
--

INSERT INTO `docgestion` (`id`, `depid`, `perid`, `nomar`, `tipo`, `fecha`, `ruta`, `ultserie`, `num`, `nomserie`, `dfin`) VALUES
(5, 1024, 1, '1659705057andres galeano.jpeg', 'jpeg', '2022-08-05 08:10:57', '../archi/1024/1659705057andres galeano.jpeg', 3001756001, 444, 'Prueba viernes', 'CO'),
(6, 1024, 1, '1659705057cactus1.jpeg', 'jpeg', '2022-08-05 08:10:57', '../archi/1024/1659705057cactus1.jpeg', 3001756001, 444, 'Prueba viernes', 'CO'),
(7, 1024, 1, '1659705109Katy 2020-12-11 at 18.44.39.jpeg', 'jpeg', '2022-08-05 08:11:49', '../archi/1024/1659705109Katy 2020-12-11 at 18.44.39.jpeg', 3001756001, 555, 'PRUEBA 2', 'CO'),
(8, 1024, 1, '1659706988aprod_certtomav.pdf', 'pdf', '2022-08-05 08:43:08', '../archi/1024/1659706988aprod_certtomav.pdf', 23011002, 234, 'ejemplo_formato_x123', 'CO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `docgestion`
--
ALTER TABLE `docgestion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `docgestion`
--
ALTER TABLE `docgestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
