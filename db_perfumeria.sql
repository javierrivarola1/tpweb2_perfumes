-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2025 a las 16:22:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_perfumeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `origen` varchar(25) DEFAULT NULL,
  `creador` varchar(50) DEFAULT NULL,
  `año` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `origen`, `creador`, `año`) VALUES
(1, 'Antonio Banderas', 'españa', 'antonio banderas', 1960),
(2, 'Paco Rabanne', 'francia', 'familia puig', 1966),
(3, 'Carolina Herrera', 'estados unidos', 'carolina herrera', 1981);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `descripcion` varchar(700) NOT NULL,
  `marca` int(100) NOT NULL,
  `sexo` char(3) NOT NULL,
  `stock` tinyint(1) NOT NULL,
  `precio` float NOT NULL,
  `presentacion` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `url`, `nombre`, `descripcion`, `marca`, `sexo`, `stock`, `precio`, `presentacion`) VALUES
(4, 'https://juleriaque.vtexassets.com/arquivos/ids/201518/good-girl-edp-8FB3ED41E09E468530B3404297CDA472.jpg?v=638085739653070000', 'Good Girl', 'Good Girl de Carolina Herrera es una fragancia de la familia olfativa Oriental Floral para Mujeres. Las Notas de Salida son almendra, café, bergamota y limón (lima ácida); las Notas de Corazón son nardos, jazmín sambac (sampaguita), flor de azahar del naranjo, rosa de Bulgaria (rosa Damascena de Bulgaria) y raíz de lirio; las Notas de Fondo son haba tonka, cacao, vainilla, praliné, sándalo, almizcle, ámbar, madera de cachemira, pachulí, canela y cedro.', 3, 'F', 1, 28000, 100),
(6, 'https://m.media-amazon.com/images/I/61q5qvBaZ9L.jpg', 'Carolina', 'Carolina de Carolina Herrera es una fragancia de la familia olfativa Almizcle Floral Amaderado para Mujeres. Las Notas de Salida son hojas del fresal salvaje, naranja amarga y cardamomo; las Notas de Corazón son frutas del bosque, rosa y pimienta; las Notas de Fondo son madera de cachemira, almizcle, ámbar y vainilla.', 3, 'F', 1, 25000, 100),
(7, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSuRWLKyEI1TerN0OBO7zVn4vRZ7wCWJC1JxQ&s', 'Invictus Victory Elixir Rabanne', 'Invictus Victory Elixir de Rabanne es una fragancia de la familia olfativa Oriental Amaderada para Hombres. Esta fragrancia es nueva. Invictus Victory Elixir se lanzó en 2023. Las Notas de Salida son lavanda, cardamomo y pimienta negra; las Notas de Corazón son incienso y pachulí; las Notas de Fondo son vaina de vainilla y haba tonka.', 2, 'M', 1, 55000, 50),
(8, 'https://www.siemprefarmacias.com.ar/contenido/productos/original/1631298985-7750.jpeg', 'Olympéa Rabanne', 'Olympéa de Rabanne es una fragancia de la familia olfativa Oriental Floral para Mujeres. Las Notas de Salida son jazmín de agua, mandarina verde y flor de jengibre; las Notas de Corazón son vainilla y sal; las Notas de Fondo son madera de cachemira, ámbar gris y sándalo.', 2, 'F', 1, 21000, 50),
(9, 'https://farmaciasdelpueblo.vtexassets.com/arquivos/ids/209568/3349668617050-2.png?v=638848256100330000', '1 Million Royal Rabanne', '1 Million Royal de Rabanne es una fragancia de la familia olfativa Oriental Amaderada para Hombres.  Las Notas de Salida son cardamomo, naranja tangerina y bergamota; las Notas de Corazón son lavanda, salvia y hojas de violeta; las Notas de Fondo son benjuí, cedro y pachulí.', 2, 'U', 1, 23000, 100),
(13, 'https://www.siemprefarmacias.com.ar/contenido/productos/original/1659099276-320.jpeg', 'King of Seduction Absolute', 'Fragancia de la familia olfativa Amaderada Aromática para Hombres. Las Notas de Salida son piña, melón, bergamota, manzana verde y toronja ', 1, 'M', 1, 13000, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(80) NOT NULL,
  `contrasenia` varchar(80) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasenia`, `id`) VALUES
('webadmin', '$2y$10$E3XfATYhKbmrEOo16FSqgOR/mtwFa6dSz0z1BvkGEVUQbvkD7DTmq', 1),
('javo', '$2y$10$FXSGGRoPRl/BD8VxwSbwKO.fGYWVElLFWR8rfYcRw2sMPHKwYW4V6', 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `marca` (`marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
