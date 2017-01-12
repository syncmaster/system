-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `signupform`
--

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `age` int(32) NOT NULL,
  `country` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `age`, `country`, `city`, `address`, `email`, `password`) VALUES
(69, 'MArtin', 'Goranov', 23, 'Bulgaria', 'Pleven', 'pokalitin27', 'plamen@topnet.bg', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(75, 'Plamen', 'Penchev', 26, 'Bulgaria', 'Montana', 'montana 12', 'plamen1@topnet.bg', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(76, 'Plamen', 'Penchev', 25, 'Bulgaria', 'Tolbuhin', 'masdasdasd', 'wqesdaxcz@abv.bg', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(77, 'Bogomil', 'Dimitrov', 24, 'Bulgaria', 'Varna', 'podpolkovnik kalitin 27', 'bogomil@abv.bg', 'c8cdddae3fd642dadc4786eaf01e8264'),
(78, 'Plamen', 'Penchev', 26, 'Serbia', 'Pliska', 'Preslav 15', 'gosho0@abv.bg', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(79, 'Plamen', 'Penchev', 24, 'Bulgaria', 'Tervel', 'maritsa 8', 'plamen@abv.bg', 'c8cdddae3fd642dadc4786eaf01e8264');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
