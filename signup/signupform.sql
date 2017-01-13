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
-- Структура на таблица `friends`
--

CREATE TABLE `friends` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Схема на данните от таблица `friends`
--

INSERT INTO `friends` (`id`, `name`) VALUES
(1, 'Plamen'),
(2, 'Bogomil'),
(3, 'Valentin'),
(4, 'Mariya'),
(5, 'Cvetomir'),
(6, 'Teodora');

-- --------------------------------------------------------

--
-- Структура на таблица `logininfo`
--

CREATE TABLE `logininfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(10) COLLATE utf16_unicode_ci NOT NULL,
  `browser` varchar(32) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Схема на данните от таблица `logininfo`
--

INSERT INTO `logininfo` (`id`, `date`, `user_id`, `browser`) VALUES
(17, '2017-01-13 15:15:15', '79', 'Google Chrome'),
(18, '2017-01-13 15:40:45', '79', 'Google Chrome');

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
(77, 'Bogomil', 'Dimitrov', 24, 'Bulgaria', 'Varna', 'podpolkovnik kalitin 27', 'bogomil@abv.bg', 'c8cdddae3fd642dadc4786eaf01e8264'),
(79, 'Plamen', 'Penchev', 24, 'Bulgaria', 'Tervel', 'maritsa 8', 'plamen@abv.bg', 'c8cdddae3fd642dadc4786eaf01e8264'),
(80, 'Valentina', 'Angelova', 24, 'Bulgaria', 'Varna', 'kalitin 27', 'valq@abv.bg', 'c8cdddae3fd642dadc4786eaf01e8264'),
(82, 'adadadasd', 'asdasdsadsa', 21, 'England', 'asdasdasdad', 'asdasdasdasd', 'plamen232213231@abv.bg', '25f9e794323b453885f5181f1b624d0b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logininfo`
--
ALTER TABLE `logininfo`
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
-- AUTO_INCREMENT for table `logininfo`
--
ALTER TABLE `logininfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
