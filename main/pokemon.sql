-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2024 at 01:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokemon`
--

-- --------------------------------------------------------

--
-- Table structure for table `entrenadores`
--

CREATE TABLE `entrenadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entrenadores`
--

INSERT INTO `entrenadores` (`id`, `nombre`, `genero`, `usuario`, `contrasena`) VALUES
(1, 'Prueba', 'masculino', 'gv', '$2y$10$yFPYUdow3mcvLeX4fYvpTOzoZgfnC7H8pSwE2WKKPkyJZZ821sXS2'),
(2, 'Gabriel', 'masculino', 'gabo', '$2y$10$QEurrS5gvqo9ck8jDXGLyexaiJEHxFClcxWwRLO.Fe2Gsx.pXJmRu');

-- --------------------------------------------------------

--
-- Table structure for table `entrenador_objeto_favorito`
--

CREATE TABLE `entrenador_objeto_favorito` (
  `entrenador_id` int(11) NOT NULL,
  `objeto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entrenador_pokemon_favorito`
--

CREATE TABLE `entrenador_pokemon_favorito` (
  `entrenador_id` int(11) NOT NULL,
  `pokemon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objetos`
--

CREATE TABLE `objetos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objetos_favoritos`
--

CREATE TABLE `objetos_favoritos` (
  `id` int(11) NOT NULL,
  `id_entrenador` int(10) NOT NULL,
  `id_objeto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `objetos_favoritos`
--

INSERT INTO `objetos_favoritos` (`id`, `id_entrenador`, `id_objeto`) VALUES
(1, 4, 16);

-- --------------------------------------------------------

--
-- Table structure for table `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `altura` decimal(4,2) NOT NULL,
  `peso` decimal(4,2) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pokemon_favoritos`
--

CREATE TABLE `pokemon_favoritos` (
  `id` int(11) NOT NULL,
  `id_entrenador` int(10) NOT NULL,
  `id_pokemon` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pokemon_favoritos`
--

INSERT INTO `pokemon_favoritos` (`id`, `id_entrenador`, `id_pokemon`) VALUES
(2, 4, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entrenador_objeto_favorito`
--
ALTER TABLE `entrenador_objeto_favorito`
  ADD PRIMARY KEY (`entrenador_id`,`objeto_id`),
  ADD KEY `objeto_id` (`objeto_id`);

--
-- Indexes for table `entrenador_pokemon_favorito`
--
ALTER TABLE `entrenador_pokemon_favorito`
  ADD PRIMARY KEY (`entrenador_id`,`pokemon_id`),
  ADD KEY `pokemon_id` (`pokemon_id`);

--
-- Indexes for table `objetos`
--
ALTER TABLE `objetos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objetos_favoritos`
--
ALTER TABLE `objetos_favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pokemon_favoritos`
--
ALTER TABLE `pokemon_favoritos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entrenadores`
--
ALTER TABLE `entrenadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `objetos`
--
ALTER TABLE `objetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objetos_favoritos`
--
ALTER TABLE `objetos_favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pokemon_favoritos`
--
ALTER TABLE `pokemon_favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entrenador_objeto_favorito`
--
ALTER TABLE `entrenador_objeto_favorito`
  ADD CONSTRAINT `entrenador_objeto_favorito_ibfk_1` FOREIGN KEY (`entrenador_id`) REFERENCES `entrenadores` (`id`),
  ADD CONSTRAINT `entrenador_objeto_favorito_ibfk_2` FOREIGN KEY (`objeto_id`) REFERENCES `objetos` (`id`);

--
-- Constraints for table `entrenador_pokemon_favorito`
--
ALTER TABLE `entrenador_pokemon_favorito`
  ADD CONSTRAINT `entrenador_pokemon_favorito_ibfk_1` FOREIGN KEY (`entrenador_id`) REFERENCES `entrenadores` (`id`),
  ADD CONSTRAINT `entrenador_pokemon_favorito_ibfk_2` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
