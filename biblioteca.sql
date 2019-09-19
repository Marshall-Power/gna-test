-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2019 a las 14:55:44
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autors`
--

CREATE TABLE `autors` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autors`
--

INSERT INTO `autors` (`id`, `nom`) VALUES
(2, 'Aldous Huxley'),
(1, 'George R. R. Martin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorials`
--

CREATE TABLE `editorials` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `editorials`
--

INSERT INTO `editorials` (`id`, `nom`) VALUES
(4, 'Agostini'),
(1, 'Gigamesh'),
(2, 'Lubna'),
(3, 'Planeta'),
(5, 'Virtual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorialsautors`
--

CREATE TABLE `editorialsautors` (
  `autor_id` int(11) NOT NULL,
  `editorial_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `editorialsautors`
--

INSERT INTO `editorialsautors` (`autor_id`, `editorial_id`) VALUES
(2, 3),
(2, 4),
(2, 2),
(1, 1),
(1, 2),
(1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llibres`
--

CREATE TABLE `llibres` (
  `id` int(11) NOT NULL,
  `titol` varchar(50) NOT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `editorial_id` int(11) DEFAULT NULL,
  `preu` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `llibres`
--

INSERT INTO `llibres` (`id`, `titol`, `autor_id`, `editorial_id`, `preu`) VALUES
(1, 'Un mundo feliz', 2, 3, '20.00'),
(2, 'La isla', 2, 4, '20.00'),
(3, 'Time Must Have a Stop', 2, 2, '20.00'),
(4, 'The Genius and the Goddess', 2, 1, '20.00'),
(5, 'Crome Yellow', 2, 3, '20.00'),
(6, 'Canço de gel i foc', 1, 1, '12.50'),
(7, 'Xoc de reis', 1, 1, '12.50'),
(8, 'Dança amb dracs', 1, 1, '15.50'),
(9, 'Tempesta d\'esases', 1, 1, '11.50'),
(10, 'Muerte de la luz', 1, 2, '9.50'),
(11, 'Sueño del fevre', 1, 5, '5.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autors`
--
ALTER TABLE `autors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indices de la tabla `editorials`
--
ALTER TABLE `editorials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indices de la tabla `editorialsautors`
--
ALTER TABLE `editorialsautors`
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `editorial_id` (`editorial_id`);

--
-- Indices de la tabla `llibres`
--
ALTER TABLE `llibres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titol` (`titol`),
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `editorial_id` (`editorial_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autors`
--
ALTER TABLE `autors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `editorials`
--
ALTER TABLE `editorials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `llibres`
--
ALTER TABLE `llibres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `editorialsautors`
--
ALTER TABLE `editorialsautors`
  ADD CONSTRAINT `editorialsautors_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `autors` (`id`),
  ADD CONSTRAINT `editorialsautors_ibfk_2` FOREIGN KEY (`editorial_id`) REFERENCES `editorials` (`id`);

--
-- Filtros para la tabla `llibres`
--
ALTER TABLE `llibres`
  ADD CONSTRAINT `llibres_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `autors` (`id`),
  ADD CONSTRAINT `llibres_ibfk_2` FOREIGN KEY (`editorial_id`) REFERENCES `editorials` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
