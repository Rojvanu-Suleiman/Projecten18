-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 10:30 AM
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
-- Database: `autowebshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelling_id` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `status` enum('Nieuw','In behandeling','Voltooid','Geannuleerd') NOT NULL DEFAULT 'Nieuw',
  `betaalmethode` enum('iDEAL','Creditcard','Bankoverschrijving','PayPal') NOT NULL,
  `betaald` tinyint(1) DEFAULT 0,
  `totaal_bedrag` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bestellingen`
--

INSERT INTO `bestellingen` (`bestelling_id`, `klant_id`, `datum`, `status`, `betaalmethode`, `betaald`, `totaal_bedrag`) VALUES
(1, 1, '2024-02-10 14:30:00', 'Voltooid', 'iDEAL', 1, 8000.00),
(2, 2, '2024-02-15 10:45:00', 'Voltooid', 'Creditcard', 1, 9500.00),
(3, 3, '2024-03-01 16:20:00', 'Voltooid', 'Bankoverschrijving', 1, 11000.00),
(4, 4, '2024-03-10 09:15:00', 'Voltooid', 'iDEAL', 1, 25000.00),
(5, 5, '2024-03-20 11:30:00', 'Voltooid', 'PayPal', 1, 3000.00),
(6, 6, '2024-04-05 15:45:00', 'In behandeling', 'Creditcard', 1, 13500.00),
(7, 7, '2024-04-10 13:20:00', 'In behandeling', 'iDEAL', 1, 55000.00),
(8, 8, '2024-04-15 10:10:00', 'Nieuw', 'Bankoverschrijving', 0, 6500.00),
(9, 9, '2024-04-18 14:05:00', 'Nieuw', 'iDEAL', 0, 9000.00),
(10, 10, '2024-04-19 16:30:00', 'Nieuw', 'PayPal', 0, 7000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelling_id`),
  ADD KEY `klant_id` (`klant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `klanten` (`klant_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
