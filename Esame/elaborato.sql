-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 27, 2021 alle 22:44
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elaborato`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `Id` int(11) NOT NULL,
  `NomeCategoria` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`Id`, `NomeCategoria`) VALUES
(1, 'Lifestyle'),
(2, 'Jordan'),
(3, 'Running'),
(4, 'Camminata'),
(5, 'Basket');

-- --------------------------------------------------------

--
-- Struttura della tabella `dettaglioordine`
--

CREATE TABLE `dettaglioordine` (
  `Id` int(11) NOT NULL,
  `Quantita` int(11) NOT NULL,
  `IdProdotti` int(11) NOT NULL,
  `IdOrdine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `dettaglioordine`
--

INSERT INTO `dettaglioordine` (`Id`, `Quantita`, `IdProdotti`, `IdOrdine`) VALUES
(189, 1, 14, 147),
(190, 1, 25, 148),
(191, 1, 21, 148),
(192, 1, 14, 149),
(194, 1, 46, 150),
(200, 1, 27, 153),
(202, 1, 44, 154),
(203, 1, 12, 154),
(204, 1, 12, 156),
(205, 3, 16, 157),
(206, 1, 44, 158),
(207, 3, 46, 158),
(208, 1, 137, 159),
(209, 1, 173, 159),
(210, 5, 109, 159),
(211, 1, 109, 160),
(212, 1, 101, 160),
(213, 5, 137, 160),
(214, 1, 137, 161),
(215, 2, 173, 161),
(216, 5, 215, 161),
(217, 1, 107, 162),
(218, 1, 164, 162),
(219, 1, 229, 162),
(220, 8, 109, 163),
(221, 4, 173, 163),
(222, 1, 164, 164),
(223, 1, 194, 164),
(224, 4, 27, 164),
(225, 2, 106, 165),
(226, 1, 27, 166),
(227, 4, 223, 166),
(228, 3, 161, 166),
(229, 1, 107, 167),
(230, 1, 164, 167),
(231, 1, 106, 167),
(232, 4, 223, 168),
(233, 1, 101, 169),
(234, 1, 106, 169),
(235, 4, 161, 169),
(236, 2, 229, 169),
(237, 1, 232, 170),
(238, 1, 109, 171),
(239, 1, 173, 171),
(242, 2, 173, 172),
(243, 4, 161, 172),
(244, 1, 1, 1),
(245, 1, 161, 173),
(246, 1, 194, 173),
(247, 1, 177, 173),
(248, 1, 187, 173),
(249, 3, 121, 173),
(250, 1, 109, 174),
(251, 1, 196, 175),
(252, 1, 194, 175),
(253, 3, 173, 175),
(254, 2, 215, 175),
(255, 1, 182, 176),
(256, 1, 103, 176),
(257, 1, 215, 176),
(258, 1, 194, 176),
(259, 1, 109, 176),
(260, 1, 173, 176),
(261, 1, 181, 176),
(262, 1, 233, 176),
(263, 1, 212, 176),
(264, 1, 223, 176),
(265, 1, 229, 176),
(266, 3, 101, 176),
(267, 2, 103, 177),
(268, 1, 27, 178),
(269, 2, 27, 179);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `Id` int(11) NOT NULL,
  `NumeroCarta` varchar(60) NOT NULL,
  `IndirizzoSpedizione` varchar(80) NOT NULL,
  `Corriere` varchar(50) NOT NULL,
  `CodiceFiscaleUtente` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`Id`, `NumeroCarta`, `IndirizzoSpedizione`, `Corriere`, `CodiceFiscaleUtente`) VALUES
(147, '10E3u8Njk37N2', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(148, '10I2/WUJXaTbw', 'via passo enea', 'Brt', 'MNDMRC02T16D423K'),
(149, '10jqeJZcS6rEA', 'via salemi', 'Brt', 'MNDMRC02T16D423K'),
(150, '10hNiDKCuffz6', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(151, '10hNiDKCuffz6', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(152, '10hNiDKCuffz6', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(153, '106icj8ADD73I', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(154, '108lLlXm3hhJA', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(156, '10BuqIjAbYfjU', 'via dei prun', 'Brt', 'MNDMRC02T16D423K'),
(157, '10OWzwfNzEJIo', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(158, '10nMNWKxYozoQ', 'via salemi', 'Brt', 'MNDMRC02T16D423K'),
(159, '10lonApufpXLM', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(160, '10NUCcy7chMSs', 'via dei pruni', 'Brt', 'MNDMRC02T16D423K'),
(161, '107hHck8wcg7.', 'via rosario', 'Brt', 'glngnn03t07d423l'),
(162, '10SOUQ3DcF1Jg', 'via roma', 'Brt', 'PLTPNZ51A01H501T'),
(163, '10mvLcHkZJApg', 'via salemi', 'Brt', 'MTASVT02A01D423G'),
(164, '10c6zxBSPDUpU', 'via roma', 'Brt', 'PLTPNZ51A01H501T'),
(165, '10BBZUorhDvpA', 'via dei pruni', 'Brt', 'PLTPNZ51A01H501T'),
(166, '100vKW4jyKjkU', 'via roma', 'Brt', 'PLTPNZ51A01H501T'),
(167, '10AQepyd6JyyQ', 'via roma', 'Brt', 'PLTPNZ51A01H501T'),
(168, '10AQepyd6JyyQ', 'via roma', 'Brt', 'PLTPNZ51A01H501T'),
(169, '108NCZIu4/8.U', 'via roma', 'Brt', 'PLTPNZ51A01H501T'),
(170, '10yIEWbNhZyjs', 'via dei pruni', 'Brt', 'PLTPNZ51A01H501T'),
(171, '10jo7lptdnR5.', 'via roma', 'Brt', 'PLTPNZ51A01H501T'),
(172, '10vaI4JiULew2', 'via della salvezza', 'Brt', 'PLTPNZ51A01H501T'),
(173, '10vaI4JiULew2', 'via roma', 'Brt', 'MNDMRC02T16D423K'),
(174, '10iLN6INvJAJQ', 'via roma', 'Brt', 'MNDMRC02T16D423K'),
(175, '10sRtgLEaBv8E', 'via roma', 'Brt', 'MNDMRC02T16D423K'),
(176, '10UE1zZCQ9G7c', 'via roma', 'Brt', 'MNDMRC02T16D423K'),
(177, '10PgOSdegsixk', 'via salemi', 'Brt', 'MNDMRC02T16D423K'),
(178, '10Ne2TqWWHNrQ', 'via salemi', 'Brt', 'MNDMRC02T16D423K'),
(179, '10OlikZ1q6jEM', 'via roma', 'Brt', 'MNDMRC02T16D423K');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Prezzo` int(11) NOT NULL,
  `Giacenza` varchar(70) NOT NULL,
  `Sconto` int(11) NOT NULL,
  `PercorsoImmagine` varchar(70) NOT NULL,
  `Recensione` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`Id`, `Nome`, `Prezzo`, `Giacenza`, `Sconto`, `PercorsoImmagine`, `Recensione`, `IdCategoria`) VALUES
(9, 'Nike Air Max Plus', 169, 'Via passo enea 31', 20, 'img/Scarpe/Nike-Air-Max-Plus.png', 5, 1),
(10, 'Nike Air Max Genome', 169, 'Via passo enea 31', 20, 'img/Scarpe/Nike-Air-Max-Genome.png', 3, 1),
(11, 'Nike Air VaporMax Evo', 224, 'Via passo enea 31', 30, 'img/Scarpe/Nike-Air-VaporMax-Evo.png', 3, 1),
(12, 'Nike Air Max Plus 3', 179, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Air-Max-Plus-3.png', 4, 1),
(14, 'Nike Air Presto', 119, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Air-Presto.png', 4, 1),
(16, 'Nike Air Max Plus III', 179, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Air-Max-Plus-III.png', 4, 1),
(17, 'Nike Air Force 1 &#x27;07', 99, 'Via passo enea 31', 30, 'img/Scarpe/Nike-Air-Force.png', 3, 1),
(21, 'Nike Air Max Plus EOI', 179, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Air-Max-Plus-EOI.png', 4, 1),
(22, 'Nike Air Max SC', 79, 'Via passo enea 31', 0, 'img/Scarpe/Nike-Air-Max-SC.png', 4, 1),
(23, 'Air Jordan 1 Low', 109, 'Via passo enea 31', 30, 'img/Scarpe/Air-Jordan-1-Low.png', 3, 1),
(24, 'Nike Air Force 1 LV8', 109, 'Via passo enea 31', 20, 'img/Scarpe/Nike-Air-Force-1-LV8.png', 5, 1),
(25, 'Nike Air Max 97', 179, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Air-Max-97.png', 3, 1),
(26, 'Nike Air Structure', 129, 'Via passo enea 31', 0, 'img/Scarpe/Nike-Air-Structure.png', 5, 1),
(27, 'Nike Wearallday', 64, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Wearallday.png', 3, 1),
(28, 'Nike Go FlyEase', 119, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Go-FlyEase.png', 5, 1),
(29, 'Nike Venture Runner', 64, 'Via passo enea 31', 0, 'img/Scarpe/Nike-Venture-Runner.png', 5, 1),
(32, 'Nike Air Max 95', 169, 'Via passo enea 31', 20, 'img/Scarpe/Nike-Air-Max-95.png', 5, 1),
(33, 'Nike Air Max 2090 EOI', 159, 'Via passo enea 31', 0, 'img/Scarpe/Nike-Air-Max-2090-EOI.png', 3, 1),
(34, 'Jordan Delta Breathe', 149, 'Via passo enea 31', 50, 'img/Scarpe/Jordan-Delta.png', 3, 1),
(35, 'Nike Air Max Excee', 109, 'Via passo enea 31', 0, 'img/Scarpe/Nike-Air-Max-Excee.png', 4, 1),
(36, 'Nike Air Force 1 GTX Boot', 179, 'Via passo enea 31', 30, 'img/Scarpe/Nike-Air-Force-1-GTX-Boot.png', 3, 1),
(39, 'Nike Air Max 2090', 149, 'Via passo enea 31', 30, 'img/Scarpe/Nike-Air-Max-2090.png', 3, 1),
(42, 'Nike Air Max Zephyr', 179, 'Via passo enea 31', 30, 'img/Scarpe/Nike-Air-Max-Zephyr.png', 3, 1),
(43, 'Nike Cross Trainer Low', 79, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Cross-Trainer-Low.png', 4, 1),
(46, 'Nike Air Max 270', 149, 'Via passo enea 31', 50, 'img/Scarpe/Nike-Air-Max-270.png', 5, 1),
(50, 'Nike React Vision', 129, 'Via passo enea 31', 20, 'img/Scarpe/Nike-React-Vision.png', 5, 1),
(51, 'Nike Air Max 95 Essential', 169, 'Via passo enea 31', 0, 'img/Scarpe/Nike-Air-Max-95-Essential.png', 4, 1),
(52, 'Nike Air Max Plus II', 179, 'Via passo enea 31', 20, 'img/Scarpe/Nike-Air-Max-Plus-II.png', 5, 1),
(53, 'Nike Air Max Tailwind V SP', 179, 'Via passo enea 31', 0, 'img/Scarpe/Nike-Air-Max-Tailwind-V-SP.png', 4, 1),
(54, 'Nike Air Max VG-R', 99, 'Via passo enea 31', 30, 'img/Scarpe/Nike-Air-Max-VG-R.png', 3, 1),
(56, 'Nike Air Max 90', 139, 'Via passo enea 31', 30, 'img/Scarpe/Nike-Air-Max-90.png', 5, 1),
(57, 'Jordan Delta 2', 129, 'Via salemi 88', 20, 'img/Scarpe/Jordan-Delta-2.png', 3, 2),
(60, 'Air Jordan XXXV Low', 174, 'Via salemi 88', 30, 'img/Scarpe/Air-Jordan-XXXV-Low.png', 3, 2),
(62, 'Air Jordan 1 Mid', 119, 'Via salemi 88', 50, 'img/Scarpe/Air-Jordan-1-Mid.png', 3, 2),
(63, 'Jordan MA2 &quot;Still Loading&quot;', 129, 'Via salemi 88', 0, 'img/Scarpe/Jordan-MA2.png', 3, 2),
(64, 'Air Jordan 11 CMFT Low', 124, 'Via salemi 88', 20, 'img/Scarpe/Air-Jordan-11-CMFT-Low.png', 4, 2),
(68, 'Zion 1', 119, 'Via salemi 88', 30, 'img/Scarpe/Zion-1.png', 3, 2),
(69, 'Air Jordan 1 Hi FlyEase', 159, 'Via salemi 88', 20, 'img/Scarpe/Air-Jordan-1-Hi-FlyEase.png', 3, 2),
(70, 'Air Jordan 1 Low SE', 119, 'Via salemi 88', 30, 'img/Scarpe/Air-Jordan-1-Low-SE.png', 4, 2),
(71, 'Jordan Max Aura 2', 119, 'Via salemi 88', 30, 'img/Scarpe/Jordan-Max-Aura-2.png', 5, 2),
(75, 'Jordan ADG 3', 149, 'Via salemi 88', 20, 'img/Scarpe/Jordan-ADG-3.png', 3, 2),
(76, 'Jordan Zoom &#x27;92', 149, 'Via salemi 88', 20, 'img/Scarpe/Jordan-Zoom92.png', 4, 2),
(78, 'Air Jordan XXXV &quot;Sisterhood&quot;', 184, 'Via salemi 88', 20, 'img/Scarpe/Air-Jordan-XXXVz.png', 5, 2),
(81, 'Air Jordan 7 Retro GC', 199, 'Via salemi 88', 20, 'img/Scarpe/Air-Jordan-7-Retro-GC.png', 4, 2),
(82, 'Jordan Max 200', 129, 'Via salemi 88', 50, 'img/Scarpe/Jordan-Max-200.png', 3, 2),
(83, 'Jordan Crater', 149, 'Via salemi 88', 30, 'img/Scarpe/Jordan-Crater.png', 3, 2),
(91, 'Nike Air Zoom Alphafly NEXT% Eliud Kipchoge', 309, 'Via salemi 90', 30, 'img/Scarpe/Nike-Air-Zoom-Alphafly-NEXT-Eliud-Kipchoge.png', 3, 3),
(92, 'Nike ZoomX Vaporfly NEXT%', 274, 'Via salemi 90', 20, 'img/Scarpe/Nike-ZoomX-Vaporfly-NEXT1.png', 3, 3),
(96, 'Nike Air Zoom Pegasus 38 FlyEase', 119, 'Via salemi 90', 0, 'img/Scarpe/Nike-Air-Zoom-Pegasus-38-FlyEase.png', 5, 3),
(97, 'Nike Air Zoom Tempo NEXT%', 199, 'Via salemi 90', 0, 'img/Scarpe/Nike-Air-Zoom-Tempo-NEXT.png', 5, 3),
(100, 'Nike Air Zoom Vomero 15', 149, 'Via salemi 90', 30, 'img/Scarpe/Nike-Air-Zoom-Vomero-15.png', 3, 3),
(101, 'Nike Revolution 5 FlyEase', 54, 'Via salemi 90', 75, 'img/Scarpe/Nike-Revolution-5-FlyEase.png', 4, 3),
(103, 'Nike Air Zoom Structure 23', 119, 'Via salemi 90', 75, 'img/Scarpe/Nike-Air-Zoom-Structure-23.png', 3, 3),
(105, 'Nike Air Zoom Terra Kiger 7', 139, 'Via salemi 90', 30, 'img/Scarpe/Nike-Air-Zoom-Terra-Kiger-7.png', 4, 3),
(109, 'Nike Zoom Rival D 10', 69, 'Via salemi 90', 75, 'img/Scarpe/Nike-Zoom-Rival-D-10.png', 4, 3),
(112, 'Nike React Infinity Run Flyknit', 159, 'Via salemi 90', 30, 'img/Scarpe/Nike-React-Infinity-Run-Flyknit.png', 4, 3),
(113, 'Nike Revolution 5', 54, 'Via salemi 90', 30, 'img/Scarpe/Nike-Revolution-5.png', 4, 3),
(118, 'Nike Zoom Victory Elite 2', 149, 'Via salemi 90', 30, 'img/Scarpe/Nike-Zoom-Victory-Elite-2.png', 4, 3),
(119, 'Nike React Miler', 129, 'Via salemi 90', 50, 'img/Scarpe/Nike-React-Miler.png', 5, 3),
(121, 'Nike Renew Ride 2', 74, 'Via salemi 90', 30, 'img/Scarpe/Nike-Renew-Ride-2.png', 3, 3),
(127, 'Nike Run All Day 2', 64, 'Via salemi 90', 30, 'img/Scarpe/Nike-Run-All-Day-2.png', 4, 3),
(128, 'Nike Flex 2018 RN', 81, 'Via salemi 90', 50, 'img/Scarpe/Nike-Flex-2018-RN.png', 3, 3),
(129, 'Nike Zoom Rival M 9', 69, 'Via salemi 90', 20, 'img/Scarpe/Nike-Zoom-Rival-M-9.png', 5, 3),
(130, 'Nike Zoom Mamba 3', 131, 'Via salemi 90', 30, 'img/Scarpe/Nike-Zoom-Mamba-3.png', 5, 3),
(132, 'Nike Zoom Victory 3', 131, 'Via salemi 90', 50, 'img/Scarpe/Nike-Zoom-Victory-3.png', 4, 3),
(133, 'Nike Pegasus Trail 2 GORE-TEX', 149, 'Via salemi 90', 20, 'img/Scarpe/Nike-Pegasus-Trail-2-GORE-TEX.png', 4, 3),
(135, 'Nike Air Zoom Structure 22', 119, 'Via salemi 90', 50, 'img/Scarpe/Nike-Air-Zoom-Structure-22.png', 5, 3),
(138, 'Nike Air Zoom Winflo 6', 99, 'Via salemi 90', 50, 'img/Scarpe/Nike-Air-Zoom-Winflo-6.png', 3, 3),
(140, 'Nike React Miler Shield', 139, 'Via salemi 90', 50, 'img/Scarpe/Nike-React-Miler-Shield.png', 4, 3),
(141, 'Nike Air Max Fusion', 91, 'Via salemi 90', 0, 'img/Scarpe/Nike-Air-Max-Fusion.png', 4, 3),
(142, 'Nike Zoom Matumbo 3', 121, 'Via salemi 90', 0, 'img/Scarpe/Nike-Zoom-Matumbo-3.png', 3, 3),
(143, 'Nike Downshifter 10 Special Edition', 60, 'Via salemi 90', 20, 'img/Scarpe/Nike-Downshifter-10-Special-Edition.png', 3, 3),
(144, 'Nike Air Zoom Winflo 7', 99, 'Via salemi 90', 30, 'img/Scarpe/Nike-Air-Zoom-Winflo-7.png', 3, 3),
(145, 'Nike Odyssey React Shield 2', 141, 'Via salemi 90', 30, 'img/Scarpe/Nike-Odyssey-React-Shield-2.png', 3, 3),
(147, 'Nike Superfly Elite', 151, 'Via salemi 90', 20, 'img/Scarpe/Nike-Superfly-Elite.png', 5, 3),
(149, 'Nike Zoom Fly 3', 159, 'Via salemi 90', 20, 'img/Scarpe/Nike-Zoom-Fly-3.png', 5, 3),
(150, 'Nike Todos RN', 54, 'Via salemi 90', 20, 'img/Scarpe/Nike-Todos-RN.png', 3, 3),
(154, 'Nike Joyride Dual Run', 129, 'Via salemi 90', 0, 'img/Scarpe/Nike-Joyride-Dual-Run.png', 4, 3),
(155, 'Nike Revolution 5 Special Edition', 55, 'Via salemi 90', 20, 'img/Scarpe/Nike-Revolution-5-Special-Edition.png', 5, 3),
(160, 'Nike Air Zoom Pegasus 38', 119, 'Via salemi 90', 30, 'img/Scarpe/Nike-Air-Zoom-Pegasus-38.png', 5, 4),
(163, 'Nike ZoomX Invincible Run Flyknit', 179, 'Via salemi 90', 30, 'img/Scarpe/Nike-ZoomX-Invincible-Run-Flyknit.png', 3, 4),
(168, 'Nike Flex Experience Run 10', 64, 'Via salemi 90', 0, 'img/Scarpe/Nike-Flex-Experience-Run-10.png', 4, 4),
(169, 'Nike React Miler 2', 129, 'Via salemi 90', 50, 'img/Scarpe/Nike-React-Miler-2.png', 4, 4),
(173, 'Nike Revolution 5 Premium', 54, 'Via salemi 90', 75, 'img/Scarpe/Nike-Revolution-5-Premium.png', 5, 4),
(181, 'Nike Air Max Alpha Trainer 2', 79, 'Via salemi 90', 75, 'img/Scarpe/Nike-Air-Max-Alpha-Trainer-2.png', 4, 4),
(182, 'Nike Epic React Flyknit 2', 151, 'Via salemi 90', 75, 'img/Scarpe/Nike-Epic-React-Flyknit-2.png', 4, 4),
(184, 'Nike Winflo 7 Shield', 104, 'Via salemi 90', 50, 'img/Scarpe/Nike-Winflo-7-Shield.png', 5, 4),
(187, 'Nike Downshifter 9', 60, 'Via salemi 90', 30, 'img/Scarpe/Nike-Downshifter-9.png', 5, 4),
(188, 'Nike Downshifter 10', 59, 'Via salemi 90', 20, 'img/Scarpe/Nike-Downshifter-10.png', 3, 4),
(192, 'Nike Juniper Trail', 79, 'Via salemi 90', 30, 'img/Scarpe/Nike-Juniper-Trail.png', 5, 4),
(194, 'Nike Pegasus Trail 2', 129, 'Via salemi 90', 75, 'img/Scarpe/Nike-Pegasus-Trail-2.png', 3, 4),
(195, 'Nike Renew Run', 89, 'Via salemi 90', 50, 'img/Scarpe/Nike-Renew-Run.png', 3, 4),
(196, 'Nike Air Monarch IV', 59, 'Via salemi 90', 50, 'img/Scarpe/Nike-Air-Monarch-IV.png', 3, 4),
(198, 'KD14', 149, 'Via salemi 90', 50, 'img/Scarpe/KD14.png', 3, 5),
(201, 'PG 5', 119, 'Via salemi 90', 20, 'img/Scarpe/PG-5.png', 4, 5),
(202, 'Kyrie 7', 129, 'Via salemi 90', 0, 'img/Scarpe/Kyrie-7.png', 5, 5),
(205, 'Jordan One Take II', 99, 'Via salemi 90', 30, 'img/Scarpe/Jordan-One-Take-II.png', 5, 5),
(207, 'KD Trey 5 IX', 99, 'Via salemi 90', 0, 'img/Scarpe/KD-Trey-5-IX.png', 4, 5),
(212, 'Zoom Freak 2 &quot;Play for the Future&quot;', 119, 'Via salemi 90', 75, 'img/Scarpe/Zoom-Freak.png', 3, 5),
(213, 'Air Jordan XXXV', 184, 'Via salemi 90', 20, 'img/Scarpe/Air-Jordan-XXXV.png', 4, 5),
(215, 'LeBron Witness 5', 99, 'Via salemi 90', 75, 'img/Scarpe/LeBron-Witness-5.png', 3, 5),
(216, 'Zoom Freak 2', 119, 'Via salemi 90', 50, 'img/Scarpe/Zoom-Freak-2.png', 5, 5),
(217, 'KD13', 149, 'Via salemi 90', 0, 'img/Scarpe/KD13.png', 4, 5),
(220, 'Nike Cosmic Unity &quot;Green Glow&quot;', 149, 'Via salemi 90', 0, 'img/Scarpe/Nike-Cosmic-Unity1.png', 3, 5),
(221, 'Nike Air Zoom BB NXT &quot;Sisterhood&quot;', 179, 'Via salemi 90', 30, 'img/Scarpe/Nike-Air-Zoom-BB-NXT.png', 5, 5),
(223, 'KD Trey 5 VIII', 99, 'Via salemi 90', 75, 'img/Scarpe/KD-Trey-5-VIII.png', 4, 5),
(224, 'Kyrie Flytrap 4', 89, 'Via salemi 90', 20, 'img/Scarpe/Kyrie-Flytrap-4.png', 3, 5),
(227, 'Air Jordan XXXV &quot;Chinese New Year&quot; PF', 174, 'Via salemi 90', 50, 'img/Scarpe/Air-Jordan-XXXV1.png', 3, 5),
(228, 'Kyrie 7 &quot;Play for the Future&quot;', 129, 'Via salemi 90', 0, 'img/Scarpe/Kyrie.png', 3, 5),
(229, 'Kyrie 7 &quot;Creator&quot;', 129, 'Via salemi 90', 75, 'img/Scarpe/Kyrie-72.png', 3, 5),
(231, 'Nike Adapt BB 2.0', 349, 'Via salemi 90', 0, 'img/Scarpe/Nike-Adapt-BB-2.0.png', 5, 5),
(233, 'Nike Renew Elevate', 79, 'Via salemi 90', 75, 'img/Scarpe/Nike-Renew-Elevate.png', 4, 5),
(234, 'Nike Precision 5 FlyEase', 69, 'Via salemi 90', 20, 'img/Scarpe/Nike-Precision-5-FlyEase.png', 4, 5),
(235, 'KD13 &quot;Play for the Future&quot;', 149, 'Via salemi 90', 20, 'img/Scarpe/KD131.png', 5, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `CodiceFiscale` varchar(16) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Password` varchar(126) NOT NULL,
  `DataNascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`CodiceFiscale`, `Nome`, `Cognome`, `Email`, `Password`, `DataNascita`) VALUES
('BRBMNG72L45D423M', 'MARCO', 'MINAUDO', 'marmm@gmail.com', '10XcPZ7WY4TRM', '2021-05-11'),
('glngnn03t07d423l', 'giovanni', 'gulino', 'giovanni@gmail.com', '10XcPZ7WY4TRM', '2003-12-07'),
('MNDMRC02T16D423K', 'marco', 'minaudo', 'marco@gmail.com', '10XcPZ7WY4TRM', '2021-04-10'),
('MTASVT02A01D423G', 'salvatore', 'amato', 'salvo@gmail.com', '10XcPZ7WY4TRM', '1999-12-28'),
('PLTPNZ51A01H501T', 'ponzio', 'pilato', 'ponziopil@gmail.com', '10XcPZ7WY4TRM', '2006-06-13'),
('TRPGNN80A01D423K', 'MARCO', 'ruggirello', 'marco.minaudo@gmail.com', '10XcPZ7WY4TRM', '2021-05-18');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `dettaglioordine`
--
ALTER TABLE `dettaglioordine`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`CodiceFiscale`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `dettaglioordine`
--
ALTER TABLE `dettaglioordine`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
