-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Jun 2023 um 08:37
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `network_device_management`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `network_device`
--

CREATE TABLE `network_device` (
  `device_id` int(11) NOT NULL,
  `device_type` varchar(45) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `MAC_address` varchar(45) DEFAULT NULL,
  `network_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `network_device`
--

INSERT INTO `network_device` (`device_id`, `device_type`, `ip_address`, `MAC_address`, `network_address`) VALUES
(428, 'notebook', '192.168.0.5', '00-1D-60-4A-8C-CB', '192.168.0.0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_uid` tinytext NOT NULL,
  `users_pwd` longtext NOT NULL,
  `users_email` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`users_id`, `users_uid`, `users_pwd`, `users_email`) VALUES
(6, 'micha', '$2y$10$HeL90QumjllTRvj2QmGyXOX2iSCIsIx2h0NgFKIRGW/GAtlhCb2WO', 'michamangold@gmail.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vlan`
--

CREATE TABLE `vlan` (
  `network_address` varchar(45) NOT NULL,
  `subnet_mask` varchar(45) DEFAULT NULL,
  `default_gateway` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `vlan`
--

INSERT INTO `vlan` (`network_address`, `subnet_mask`, `default_gateway`) VALUES
('192.168.0.0', '255.255.255.0', '192.168.0.1');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `network_device`
--
ALTER TABLE `network_device`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `network_address` (`network_address`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indizes für die Tabelle `vlan`
--
ALTER TABLE `vlan`
  ADD PRIMARY KEY (`network_address`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `network_device`
--
ALTER TABLE `network_device`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `network_device`
--
ALTER TABLE `network_device`
  ADD CONSTRAINT `network_device_ibfk_1` FOREIGN KEY (`network_address`) REFERENCES `vlan` (`network_address`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
