-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 01:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gtc_gamificacion`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(9) NOT NULL,
  `id_usuario` int(9) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `id_estado_actividad` int(9) NOT NULL,
  `id_lista_actividades` int(9) NOT NULL,
  `id_grado_actividad` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `id_usuario`, `fecha_inicio`, `fecha_fin`, `titulo`, `descripcion`, `id_estado_actividad`, `id_lista_actividades`, `id_grado_actividad`) VALUES
(15, 2, '2025-07-02', '2025-07-22', 'comprar harina Pan', '0', 1, 1, 3),
(17, 4, '2025-07-23', '2025-07-31', 'Cumpleaños', 'cumpleaños de alguien pero se me olvido de quein', 2, 1, 1),
(18, 4, '2025-07-23', '2025-07-24', 'Veterinario', 'hay q llevar al chiguire al veterinario', 3, 1, 3),
(19, 4, '2025-07-29', '2025-07-30', 'Comprar Arina PAN', 'ya no tengo arina pan, hay que comprar más', 2, 1, 3),
(20, 4, '2025-07-21', '2025-07-31', 'Evento Hatsune Miku Live', 'omg es hatsune miku!!!', 3, 1, 1),
(21, 4, '2025-07-17', '2025-07-17', 'Reparar la impresora', 'EPSON L355', 2, 1, 2),
(22, 4, '2025-07-17', '2025-07-17', 'Entregar el proyecto a Moya', 'se nota que javascript se creó en 10 dias', 3, 1, 3),
(23, 4, '2025-07-19', '2025-07-19', 'Comprar comida de gato', 'estos gatos comen mucho', 2, 1, 2),
(24, 4, '2025-07-14', '2025-07-14', 'Practicar Inglés en Duolingo', 'Hay que mantener la racha', 2, 1, 1),
(25, 4, '2025-07-23', '2025-07-23', 'Pagar membresia Spotify Premium', 'Ya no quiero ver anuncios molestos', 2, 1, 1),
(26, 4, '2025-07-15', '2025-07-15', 'Tarea de Investigación de Operaciones', 'opordios', 2, 1, 2),
(27, 4, '2025-07-14', '2025-07-14', 'Avance del proyecto de PHP', 'ay chamo', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id_balance` int(9) NOT NULL,
  `total_moneda` int(9) NOT NULL,
  `id_usuario` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id_balance`, `total_moneda`, `id_usuario`) VALUES
(1, 25, 2),
(2, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `estado_actividad`
--

CREATE TABLE `estado_actividad` (
  `id_estado_actividad` int(9) NOT NULL,
  `estado` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estado_actividad`
--

INSERT INTO `estado_actividad` (`id_estado_actividad`, `estado`) VALUES
(1, 'Completada'),
(2, 'Incompleta'),
(3, 'En Proceso');

-- --------------------------------------------------------

--
-- Table structure for table `estado_logro`
--

CREATE TABLE `estado_logro` (
  `id_estado_logro` int(9) NOT NULL,
  `estado` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estado_logro`
--

INSERT INTO `estado_logro` (`id_estado_logro`, `estado`) VALUES
(1, 'Incompleto'),
(2, 'Completo');

-- --------------------------------------------------------

--
-- Table structure for table `grado_actividad`
--

CREATE TABLE `grado_actividad` (
  `id_grado_actividad` int(9) NOT NULL,
  `grado` varchar(40) NOT NULL,
  `recompensa` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grado_actividad`
--

INSERT INTO `grado_actividad` (`id_grado_actividad`, `grado`, `recompensa`) VALUES
(1, 'Basico', 20),
(2, 'Intermedio', 45),
(3, 'Importante', 80);

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(9) NOT NULL,
  `id_usuario` int(9) NOT NULL,
  `id_item` int(9) NOT NULL,
  `cantidad` int(9) NOT NULL DEFAULT 1,
  `fecha_adquisicion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_usuario`, `id_item`, `cantidad`, `fecha_adquisicion`) VALUES
(1, 2, 1, 2, '2025-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(9) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` text NOT NULL,
  `id_tipo_item` int(9) NOT NULL,
  `valor` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `nombre`, `descripcion`, `id_tipo_item`, `valor`) VALUES
(1, 'Goku', 'Es el goku en estado base, continua coleccionandolos  todos para revelar el increible secreto de las bolas\r\n', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `lista_actividades`
--

CREATE TABLE `lista_actividades` (
  `id_lista_actividades` int(9) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lista_actividades`
--

INSERT INTO `lista_actividades` (`id_lista_actividades`, `nombre`) VALUES
(1, 'Lista actividades');

-- --------------------------------------------------------

--
-- Table structure for table `lista_logros`
--

CREATE TABLE `lista_logros` (
  `id_lista_logros` int(9) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logro`
--

CREATE TABLE `logro` (
  `id_logro` int(9) NOT NULL,
  `id_usuario` int(9) NOT NULL,
  `id_lista_actividades` int(9) NOT NULL,
  `id_estado_logro` int(9) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` text NOT NULL,
  `id_item` int(9) NOT NULL,
  `recompensa_dinero` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_item`
--

CREATE TABLE `tipo_item` (
  `id_tipo_item` int(9) NOT NULL,
  `tipo_nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_item`
--

INSERT INTO `tipo_item` (`id_tipo_item`, `tipo_nombre`) VALUES
(1, 'Coleccionable'),
(2, 'Foto');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_inventario` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `alias`, `contraseña`, `fecha_registro`, `id_inventario`) VALUES
(2, 'Admin', 'Rotundo', 'admin', '$2y$10$DQQIUcS8gn1zkCejrdBIcuT34MLkbmSenC3pJPWvvXupmouO.Odu6', '2025-07-11', 0),
(3, 'Marleny', 'Andrade', 'madre', '$2y$10$562d4Kq3uTGTncJfK.UlkOBEcb6C7gbmRBpRKN1yCLMyOeKDvVbVW', '2025-07-11', 0),
(4, 'Picaflor', 'Inocentemiel', 'juan', '$2y$10$a0u/XDP8PsglUBiTkhe4MOGRBx2fI0PW06VJw224tYgLbfsSDKSVC', '2025-07-13', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estado_actividad` (`id_estado_actividad`),
  ADD KEY `id_lista_actividades` (`id_lista_actividades`),
  ADD KEY `id_grado_actividad` (`id_grado_actividad`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id_balance`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `estado_actividad`
--
ALTER TABLE `estado_actividad`
  ADD PRIMARY KEY (`id_estado_actividad`);

--
-- Indexes for table `estado_logro`
--
ALTER TABLE `estado_logro`
  ADD PRIMARY KEY (`id_estado_logro`);

--
-- Indexes for table `grado_actividad`
--
ALTER TABLE `grado_actividad`
  ADD PRIMARY KEY (`id_grado_actividad`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD UNIQUE KEY `uq_inventario_item_usuario` (`id_usuario`,`id_item`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_tipo_item` (`id_tipo_item`);

--
-- Indexes for table `lista_actividades`
--
ALTER TABLE `lista_actividades`
  ADD PRIMARY KEY (`id_lista_actividades`);

--
-- Indexes for table `logro`
--
ALTER TABLE `logro`
  ADD PRIMARY KEY (`id_logro`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estado_logro` (`id_estado_logro`),
  ADD KEY `id_lista_actividades` (`id_lista_actividades`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `tipo_item`
--
ALTER TABLE `tipo_item`
  ADD PRIMARY KEY (`id_tipo_item`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id_balance` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estado_actividad`
--
ALTER TABLE `estado_actividad`
  MODIFY `id_estado_actividad` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estado_logro`
--
ALTER TABLE `estado_logro`
  MODIFY `id_estado_logro` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grado_actividad`
--
ALTER TABLE `grado_actividad`
  MODIFY `id_grado_actividad` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lista_actividades`
--
ALTER TABLE `lista_actividades`
  MODIFY `id_lista_actividades` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logro`
--
ALTER TABLE `logro`
  MODIFY `id_logro` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_item`
--
ALTER TABLE `tipo_item`
  MODIFY `id_tipo_item` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`id_estado_actividad`) REFERENCES `estado_actividad` (`id_estado_actividad`),
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`id_lista_actividades`) REFERENCES `lista_actividades` (`id_lista_actividades`),
  ADD CONSTRAINT `actividad_ibfk_4` FOREIGN KEY (`id_grado_actividad`) REFERENCES `grado_actividad` (`id_grado_actividad`);

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `balance_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_tipo_item`) REFERENCES `tipo_item` (`id_tipo_item`);

--
-- Constraints for table `logro`
--
ALTER TABLE `logro`
  ADD CONSTRAINT `logro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `logro_ibfk_2` FOREIGN KEY (`id_estado_logro`) REFERENCES `estado_logro` (`id_estado_logro`),
  ADD CONSTRAINT `logro_ibfk_3` FOREIGN KEY (`id_lista_actividades`) REFERENCES `lista_actividades` (`id_lista_actividades`),
  ADD CONSTRAINT `logro_ibfk_4` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
