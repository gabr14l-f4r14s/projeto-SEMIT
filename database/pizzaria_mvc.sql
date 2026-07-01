-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2026 at 04:31 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzaria_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponivel` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `nome`, `disponivel`) VALUES
(12, 'Molho de Tomate', 1),
(13, 'Mussarela', 1),
(14, 'Calabresa', 1),
(15, 'Cebola', 0),
(16, 'Tomate', 1),
(17, 'Orégano', 1),
(18, 'Azeitona', 1),
(19, 'Presunto', 1),
(20, 'Frango', 1),
(21, 'Catupiry', 1),
(22, 'Bacon', 1),
(23, 'Milho', 1),
(24, 'Cheddar', 1),
(25, 'Parmesão', 1),
(26, 'Provolone', 1),
(27, 'Gorgonzola', 1),
(28, 'Manjericão', 1),
(30, 'Pepperoni', 1),
(31, 'Ovo', 1),
(32, 'Pimentão', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE `pizzas` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`id`, `nome`, `preco`) VALUES
(44, 'Mussarela', 32.00),
(45, 'Calabresa', 35.00),
(46, 'Portuguesa', 38.00),
(47, 'Marguerita', 36.00),
(48, 'Frango com Catupiry', 40.00),
(49, 'Quatro Queijos', 42.00),
(50, 'Pepperoni', 44.00),
(52, 'Bacon com Cheddar', 43.00),
(53, 'Napolitana', 37.00),
(54, 'Vegetariana', 39.00);

-- --------------------------------------------------------

--
-- Table structure for table `pizza_ingredientes`
--

CREATE TABLE `pizza_ingredientes` (
  `pizza_id` int NOT NULL,
  `ingrediente_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pizza_ingredientes`
--

INSERT INTO `pizza_ingredientes` (`pizza_id`, `ingrediente_id`) VALUES
(44, 12),
(45, 12),
(46, 12),
(47, 12),
(48, 12),
(49, 12),
(50, 12),
(52, 12),
(53, 12),
(54, 12),
(44, 13),
(45, 13),
(46, 13),
(47, 13),
(48, 13),
(49, 13),
(50, 13),
(52, 13),
(53, 13),
(54, 13),
(45, 14),
(45, 15),
(46, 15),
(47, 16),
(53, 16),
(54, 16),
(44, 17),
(45, 17),
(46, 17),
(47, 17),
(48, 17),
(50, 17),
(52, 17),
(53, 17),
(54, 17),
(46, 18),
(46, 19),
(48, 20),
(48, 21),
(52, 22),
(54, 23),
(52, 24),
(49, 25),
(53, 25),
(49, 26),
(49, 27),
(47, 28),
(50, 30),
(46, 31),
(54, 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_ingredientes_nome` (`nome`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_pizzas_nome` (`nome`);

--
-- Indexes for table `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  ADD PRIMARY KEY (`pizza_id`,`ingrediente_id`),
  ADD KEY `ingrediente_id` (`ingrediente_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  ADD CONSTRAINT `pizza_ingredientes_ibfk_1` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pizza_ingredientes_ibfk_2` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
