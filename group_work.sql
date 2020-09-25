-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2020 at 02:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group_work`
--

-- --------------------------------------------------------

--
-- Table structure for table `benutzer`
--

CREATE TABLE `benutzer` (
  `Benutzer_ID` int(11) NOT NULL,
  `Benutzer_Role_ID` int(11) NOT NULL,
  `Benutzer_Name` varchar(20) COLLATE latin1_german1_ci NOT NULL,
  `Job_Name` varchar(30) COLLATE latin1_german1_ci NOT NULL,
  `DOB` date NOT NULL,
  `SEX` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `EMail` varchar(30) COLLATE latin1_german1_ci NOT NULL,
  `Adresse` varchar(30) COLLATE latin1_german1_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `benutzer`
--

INSERT INTO `benutzer` (`Benutzer_ID`, `Benutzer_Role_ID`, `Benutzer_Name`, `Job_Name`, `DOB`, `SEX`, `EMail`, `Adresse`) VALUES
(1, 1, 'Emre', 'Geschäftsführer', '1990-09-23', 'HERR', 'ex@gmail.com', 'Bomhauerstr.'),
(2, 1, 'Alperen', 'Data Scientist', '1989-01-05', 'HERR', 'ex2@gmail.com', 'Bomhauerstr. 22'),
(3, 2, 'Asim', 'Web Entwickler', '1980-09-23', 'HERR', 'ex3@gmail.com', 'Bomhauerstr. 1222'),
(4, 3, 'Meriem', 'Gastarbeiter', '1989-01-02', 'FRAU', 'ex4@gmail.com', 'Bomhauerstr. 22'),
(5, 2, 'Halim', 'WEB', '1955-02-22', 'HERR', 'my@yahoo.com', 'Hildesheimerstr. 12'),
(6, 1, 'Mesut', 'Ingenieur', '1965-01-24', 'HERR', 'mesut@gmail.com', 'Bismarkstr. 44'),
(7, 3, 'Sila', 'Grafiker', '1982-04-13', 'FRAU', 'sila@hotmail.de', 'Berliner Platz 2'),
(8, 1, 'Ayse', 'Grafiker', '1982-04-13', 'FRAU', 'ayse@hotmail.com', 'Hildesheimerstr. 2'),
(9, 2, 'Hasret', 'Ingenieur', '1982-04-13', 'FRAU', 'hasret@hotmail.de', 'Berliner Platz 17'),
(10, 3, 'Reem', 'Biologist', '1988-04-13', 'FRAU', 'reem@hotmail.de', 'Berliner Platz 2'),
(11, 1, 'Reem', 'Biologist and Nature', '1982-04-13', 'FRAU', 'reem@hotmail.de', 'Berliner Platz 3'),
(12, 1, 'Rana', 'Ingenieur', '1987-04-13', 'FRAU', 'rana@hotmail.de', 'Berliner Platz 17'),
(13, 2, 'Elif', 'WEB', '1989-04-13', 'FRAU', 'elif@hotmail.de', 'Berliner Platz 56'),
(14, 2, 'Zekiye', 'WEB', '1981-08-12', 'FRAU', 'zekiye@hotmail.de', 'Hildesheimerstr. 5'),
(15, 1, 'Fritz', 'Ingenieur', '1981-04-13', 'FRAU', 'fritz@hotmail.de', 'Berliner Platz 22'),
(16, 3, 'Nuriye', 'Grafiker', '1982-04-13', 'FRAU', 'nuriye@hotmail.de', 'Berliner Platz 122'),
(17, 2, 'Canan', 'WEB', '1982-07-13', 'FRAU', 'canan@hotmail.de', 'Berliner Platz 32'),
(18, 1, 'Sevda', 'WEB', '1982-04-13', 'FRAU', 'sevda@hotmail.de', 'Berliner Platz 52'),
(19, 3, 'Kadriye', 'Grafiker', '1982-04-12', 'FRAU', 'kadriye@hotmail.de', 'Berliner Platz 62'),
(20, 3, 'Goethe', 'Ingenieur', '1976-03-24', 'HERR', 'haci@gmail.com', 'Bismarkstr. 412'),
(21, 3, 'Sakir', 'Ingenieur', '1965-09-24', 'HERR', 'sakir@gmail.com', 'Bismarkstr. 6'),
(22, 3, 'Yusuf', 'Designer', '1965-10-24', 'HERR', 'yusuf@gmail.com', 'Bismarkstr. 17'),
(23, 3, 'ibrahim', 'Lehrer', '1975-11-22', 'HERR', 'ibrahim@gmail.com', 'Bismarkstr. 2'),
(24, 3, 'Yildiz', 'BWL', '1985-12-15', 'HERR', 'yildiz@gmail.com', 'Bismarkstr. 7'),
(25, 2, 'Yildirim', 'Body Builder', '1999-10-04', 'HERR', 'yildirim@gmail.com', 'Bismarkstr. 23'),
(26, 1, 'Selami', 'Tanzer', '1995-11-11', 'HERR', 'selami@gmail.com', 'Bismarkstr. 85'),
(28, 3, 'Yusuf', 'Spieler', '1991-05-24', 'HERR', 'yusuf@gmail.com', 'Bismarkstr. 5');

-- --------------------------------------------------------

--
-- Table structure for table `rechten`
--

CREATE TABLE `rechten` (
  `Recht_ID` int(11) NOT NULL,
  `Recht_Name` varchar(20) COLLATE latin1_german1_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `rechten`
--

INSERT INTO `rechten` (`Recht_ID`, `Recht_Name`) VALUES
(1, 'DATA_READ'),
(2, 'DATA_ADD'),
(3, 'DATA_EDIT'),
(4, 'DATA_DELETE');

-- --------------------------------------------------------

--
-- Table structure for table `rollen`
--

CREATE TABLE `rollen` (
  `Rollen_ID` int(11) NOT NULL,
  `Rollen_Name` varchar(20) COLLATE latin1_german1_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `rollen`
--

INSERT INTO `rollen` (`Rollen_ID`, `Rollen_Name`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'Guest'),
(4, 'Webber'),
(5, 'Creator'),
(6, 'King'),
(7, 'CEO'),
(8, 'CTO');

-- --------------------------------------------------------

--
-- Table structure for table `rollen_rechten`
--

CREATE TABLE `rollen_rechten` (
  `Rollen_ID` int(11) NOT NULL,
  `Recht_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Dumping data for table `rollen_rechten`
--

INSERT INTO `rollen_rechten` (`Rollen_ID`, `Recht_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`Benutzer_ID`),
  ADD KEY `Benutzer_Role_ID` (`Benutzer_Role_ID`);

--
-- Indexes for table `rechten`
--
ALTER TABLE `rechten`
  ADD PRIMARY KEY (`Recht_ID`);

--
-- Indexes for table `rollen`
--
ALTER TABLE `rollen`
  ADD PRIMARY KEY (`Rollen_ID`);

--
-- Indexes for table `rollen_rechten`
--
ALTER TABLE `rollen_rechten`
  ADD KEY `Recht_ID` (`Recht_ID`),
  ADD KEY `Rollen_ID` (`Rollen_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `Benutzer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `rechten`
--
ALTER TABLE `rechten`
  MODIFY `Recht_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rollen`
--
ALTER TABLE `rollen`
  MODIFY `Rollen_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `benutzer_ibfk_1` FOREIGN KEY (`Benutzer_Role_ID`) REFERENCES `rollen` (`Rollen_ID`);

--
-- Constraints for table `rollen_rechten`
--
ALTER TABLE `rollen_rechten`
  ADD CONSTRAINT `rollen_rechten_ibfk_1` FOREIGN KEY (`Recht_ID`) REFERENCES `rechten` (`Recht_ID`),
  ADD CONSTRAINT `rollen_rechten_ibfk_2` FOREIGN KEY (`Rollen_ID`) REFERENCES `rollen` (`Rollen_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
