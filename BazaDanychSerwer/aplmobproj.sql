-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 02 Cze 2020, 13:14
-- Wersja serwera: 10.0.28-MariaDB-2+b1
-- Wersja PHP: 7.3.14-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `aplmobproj`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sklepy`
--

CREATE TABLE `sklepy` (
  `id` int(11) NOT NULL,
  `sklep` text COLLATE utf8_polish_ci NOT NULL,
  `address` text COLLATE utf8_polish_ci NOT NULL,
  `along` double NOT NULL,
  `alat` double NOT NULL,
  `blong` double NOT NULL,
  `blat` double NOT NULL,
  `clong` double NOT NULL,
  `clat` double NOT NULL,
  `dlong` double NOT NULL,
  `dlat` double NOT NULL,
  `klienci` float NOT NULL,
  `maxklienci` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `sklepy`
--

INSERT INTO `sklepy` (`id`, `sklep`, `address`, `along`, `alat`, `blong`, `blat`, `clong`, `clat`, `dlong`, `dlat`, `klienci`, `maxklienci`) VALUES
(1, 'Lidl', 'Fredry 7', 10, 20, 30, 20, 30, 10, 10, 10, 0, 4),
(2, 'Lidl', 'Baraniaka 25', 10.100000381469727, 20.200000762939453, 30.329999923706055, 40.439998626708984, 0, 0, 0, 0, 0, 4),
(3, 'aldi', 'krzacza', 20, 54, 20, 54, 20, 52, 9, 52, 12, 0),
(4, 'test', 'test', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'pokój', 'walecznych 8', 16.701740264892578, 53.15433120727539, 16.7019100189209, 53.15433120727539, 16.7019100189209, 53.15428924560547, 16.701740264892578, 53.15428924560547, 0, 0),
(8, 'pokój', 'walecznych 8', 16.7016, 53.15434, 16.70191, 53.15434, 16.70191, 53.15429, 16.7016, 53.15429, 0, 0),
(9, 'Mrówka', 'Batorego 15', 16.6, 53.5, 16.9, 53.5, 16.9, 53, 16.6, 53, 1, 0),
(10, 'moj', 'jest', 16.70023, 53.15526, 16.70353, 53.15526, 16.70353, 53.15403, 16.70202, 53.15403, 0, 0),
(11, 'McDonald', 'Prusa', 43, 70, 60, 70, 60, 34, 60, 34, 0, 0),
(12, 'xxx', 'aaa', 16.70194, 55, 99, 55, 99, 53.15451, 99, 53.15451, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `haslo`) VALUES
(1, 'admin', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `sklepy`
--
ALTER TABLE `sklepy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `sklepy`
--
ALTER TABLE `sklepy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
