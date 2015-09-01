-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Wrz 2015, 14:58
-- Wersja serwera: 5.6.26
-- Wersja PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `contacts`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `c_id` int(11) NOT NULL,
  `c_first_name` varchar(100) NOT NULL,
  `c_last_name` varchar(100) NOT NULL,
  `c_phone` varchar(10) NOT NULL,
  `c_email` varchar(200) NOT NULL,
  `c_adress` varchar(200) NOT NULL,
  `c_city` varchar(50) NOT NULL,
  `c_zip` varchar(6) NOT NULL,
  `c_friend` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `contacts`
--

INSERT INTO `contacts` (`c_id`, `c_first_name`, `c_last_name`, `c_phone`, `c_email`, `c_adress`, `c_city`, `c_zip`, `c_friend`) VALUES
(2, 'Julian', 'Król', '5554443336', 'aaa@qsgt.pl', 'Ulica', 'Miasto', '66-666', 0),
(4, 'wrth"', 'ty', '555444333', 'trewt@qsgt.pl', 'etyuetyu', 'etyu', '46-432', 1),
(6, 'wrth"', 'ty', '555444333', 'trewt@qsgt.pl', 'etyuetyu', 'etyu', '46-432', 1),
(8, 'Mateusz', 'ty', '555444333', 'trewt@qsgt.pl', 'etyuetyu', 'etyu', '46-432', 0),
(9, 'Mateusz', 'ty', '555444333', 'trewt@qsgt.pl', 'etyuetyu', 'etyu', '46-432', 0),
(10, 'Olek', 'Romanow', '123456789', 'adfg@asdg.pl', 'dfga', 'dsfh', '33-091', 0),
(11, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 0),
(12, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 0),
(13, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 0),
(15, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 0),
(16, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 0),
(17, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(18, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(19, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(20, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(21, 'Ktostam', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(22, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(23, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(24, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(25, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(26, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(27, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(28, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(29, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(30, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 0),
(31, 'Alek', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(38, 'Roman', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(39, 'Roman', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(40, 'Roman', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1),
(41, 'Roman', 'ty', '1234567890', 'ad@adg.pl', 'sfgsfh', 'Moje', '44-000', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `contacts`
--
ALTER TABLE `contacts`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
