-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 01, 2021 at 01:13 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miprimersitio`
--

-- --------------------------------------------------------

--
-- Table structure for table `atributos`
--

CREATE TABLE `atributos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comunas`
--

CREATE TABLE `comunas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comunas`
--

INSERT INTO `comunas` (`id`, `nombre`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'Santiago', 1, '2021-05-26 11:02:30', '2021-05-26 11:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `regiones`
--

CREATE TABLE `regiones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regiones`
--

INSERT INTO `regiones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Metropolitana de Santiago', '2021-05-18 11:28:26', '2021-05-18 11:28:26'),
(2, 'De Los Lagos', '2021-05-18 11:41:09', '2021-05-18 12:09:59'),
(3, 'De Valparaíso', '2021-05-25 10:36:56', '2021-05-25 10:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(2, 'Administrador', '2021-04-27 11:10:17', '2021-04-27 11:10:17'),
(3, 'Supervisor', '2021-05-11 11:17:00', '2021-05-11 11:17:11'),
(4, 'Cliente', '2021-05-12 10:37:24', '2021-05-12 10:37:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atributos`
--
ALTER TABLE `atributos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comunas`
--
ALTER TABLE `comunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `comunas_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
