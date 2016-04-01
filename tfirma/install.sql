-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 24, 2013 at 08:36 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `efirma`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm_korisnici`
--

CREATE TABLE IF NOT EXISTS `adm_korisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(250) DEFAULT NULL,
  `nalog` varchar(10) DEFAULT NULL,
  `jmbg` varchar(13) DEFAULT NULL,
  `ime` varchar(250) DEFAULT NULL,
  `prezime` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `telefon` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `adm_korisnici`
--


-- --------------------------------------------------------

--
-- Table structure for table `adm_pristup`
--

CREATE TABLE IF NOT EXISTS `adm_pristup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `efirma` int(11) DEFAULT NULL,
  `s48` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `adm_pristup`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_aktivnost`
--

CREATE TABLE IF NOT EXISTS `ks_aktivnost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) DEFAULT NULL,
  `vrsta` int(11) DEFAULT NULL,
  `br_akta` varchar(255) DEFAULT NULL,
  `opis` varchar(1000) DEFAULT NULL,
  `donet` date DEFAULT NULL,
  `izricanje` date DEFAULT NULL,
  `prestanak` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_aktivnost`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_deca`
--

CREATE TABLE IF NOT EXISTS `ks_deca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbgradnika` varchar(13) DEFAULT NULL,
  `ime` varchar(255) DEFAULT NULL,
  `pol` varchar(1) DEFAULT NULL,
  `rodjen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_deca`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_dodaci_go`
--

CREATE TABLE IF NOT EXISTS `ks_dodaci_go` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dodatak_id` int(11) NOT NULL DEFAULT '0',
  `jmbg` varchar(13) NOT NULL DEFAULT '',
  PRIMARY KEY (`dodatak_id`,`jmbg`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_dodaci_go`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_dodatak_go`
--

CREATE TABLE IF NOT EXISTS `ks_dodatak_go` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  `sledovanje` int(11) DEFAULT NULL,
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `ks_dodatak_go`
--

INSERT INTO `ks_dodatak_go` (`id`, `naziv`, `sledovanje`) VALUES
(3, 'Slozenost posla I stepen', 1),
(4, 'Slozenost posla II stepen', 2),
(5, 'Slozenost posla III stepen', 3),
(8, 'ss', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ks_firma`
--

CREATE TABLE IF NOT EXISTS `ks_firma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) DEFAULT NULL,
  `sediste` varchar(255) DEFAULT NULL,
  `adresa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ks_firma`
--

INSERT INTO `ks_firma` (`id`, `naziv`, `sediste`, `adresa`) VALUES
(1, 'Gradska uprava Smederevo', 'Smederevo', 'Omladinska br.1');

-- --------------------------------------------------------

--
-- Table structure for table `ks_go_resenja`
--

CREATE TABLE IF NOT EXISTS `ks_go_resenja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) DEFAULT NULL,
  `godina` int(11) DEFAULT NULL,
  `dana_odmora` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_go_resenja`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_jezici`
--

CREATE TABLE IF NOT EXISTS `ks_jezici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ks_jezici`
--

INSERT INTO `ks_jezici` (`id`, `naziv`) VALUES
(1, 'Srpski'),
(2, 'Engleski'),
(3, 'Nemacki'),
(4, 'Ruski'),
(5, 'Spanski');

-- --------------------------------------------------------

--
-- Table structure for table `ks_mesta`
--

CREATE TABLE IF NOT EXISTS `ks_mesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ks_mesta`
--

INSERT INTO `ks_mesta` (`id`, `naziv`) VALUES
(1, 'Smederevo'),
(2, 'Beograd'),
(3, 'Novi Sad'),
(4, 'Badljevica'),
(5, 'Vrbovac'),
(6, 'Lunjevac'),
(7, 'Drugovac'),
(8, 'Dobri Do'),
(9, 'Saraorci'),
(10, 'Petrijevo'),
(11, 'Smederevska Palanka');

-- --------------------------------------------------------

--
-- Table structure for table `ks_ocene`
--

CREATE TABLE IF NOT EXISTS `ks_ocene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) DEFAULT NULL,
  `godina` int(11) DEFAULT NULL,
  `ocena` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_ocene`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_odgovornost`
--

CREATE TABLE IF NOT EXISTS `ks_odgovornost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) DEFAULT NULL,
  `vrsta` int(11) DEFAULT NULL,
  `br_akta` varchar(255) DEFAULT NULL,
  `mera` varchar(1000) DEFAULT NULL,
  `izricanje` date DEFAULT NULL,
  `prestanak` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_odgovornost`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_odlazak_na_odmor`
--

CREATE TABLE IF NOT EXISTS `ks_odlazak_na_odmor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(255) DEFAULT NULL,
  `datum_odlaska` date DEFAULT NULL,
  `godina` int(11) DEFAULT NULL,
  `iskorisceno_dana` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_odlazak_na_odmor`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_opisi_poslova`
--

CREATE TABLE IF NOT EXISTS `ks_opisi_poslova` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) DEFAULT NULL,
  `opis` text,
  `stepen` int(11) DEFAULT NULL,
  `iskustvo` varchar(100) DEFAULT NULL,
  `posebno` varchar(255) DEFAULT NULL,
  `br_izvrs` int(11) DEFAULT NULL,
  `uslov` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ks_opisi_poslova`
--

INSERT INTO `ks_opisi_poslova` (`id`, `naziv`, `opis`, `stepen`, `iskustvo`, `posebno`, `br_izvrs`, `uslov`) VALUES
(1, 'ÐÐ°Ñ‡ÐµÐ»Ð½Ð¸Ðº ÐžÐ´ÐµÑ™ÐµÑšÐ°', 'Ð ÑƒÐºÐ¾Ð²Ð¾Ð´Ð¸, ÐºÐ¾Ð¾Ñ€Ð´Ð¸Ð½Ð¸Ñ€Ð° Ñ€Ð°Ð´ ÐžÐ´ÐµÑ™ÐµÑšÐ° Ð¸ ÑšÐµÐ³Ð¾Ð²Ð¸Ñ… Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ð¾Ð½Ð¸Ñ… Ñ˜ÐµÐ´Ð¸Ð½Ð¸Ñ†Ð°; Ð´Ð°Ñ˜Ðµ Ð·Ð°Ð´Ð°Ñ‚ÐºÐµ Ð¸ ÑƒÐ¿ÑƒÑ‚ÑÑ‚Ð²Ð°<br /> Ð·Ð° Ð¸Ð·Ð²Ñ€ÑˆÐ°Ð²Ð°ÑšÐµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð° Ð¸ Ð·Ð°Ð´Ð°Ñ‚Ð°ÐºÐ°; Ð¾Ð±Ð°Ð²Ñ™Ð° Ð½Ð°Ñ˜ÑÐ»Ð¾Ð¶ÐµÐ½Ð¸Ñ˜Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¸Ð· Ð´ÐµÐ»Ð¾ÐºÑ€ÑƒÐ³Ð° ÐžÐ´ÐµÑ™ÐµÑšÐ° Ð¸ Ð¿Ñ€ÑƒÐ¶Ð°<br /> ÑÑ‚Ñ€ÑƒÑ‡Ð½Ñƒ Ð¿Ð¾Ð¼Ð¾Ñ› Ð·Ð°Ð¿Ð¾ÑÐ»ÐµÐ½Ð¸Ð¼Ð°; Ð¾Ð´Ð³Ð¾Ð²Ð¾Ñ€Ð°Ð½ Ñ˜Ðµ Ð·Ð° Ð·Ð°ÐºÐ¾Ð½Ð¸Ñ‚Ð¾, Ð±Ð»Ð°Ð³Ð¾Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¾ Ð¸ ÐµÑ„Ð¸ÐºÐ°ÑÐ½Ð¾ Ð¾Ð±Ð°Ð²Ñ™Ð°ÑšÐµ<br /> Ð¿Ð¾ÑÐ»Ð¾Ð²Ð° Ð¸Ð· Ð´ÐµÐ»Ð¾ÐºÑ€ÑƒÐ³Ð° ÐžÐ´ÐµÑ™ÐµÑšÐ°; Ð¿Ð¾Ñ‚Ð¿Ð¸ÑÑƒÑ˜Ðµ ÑÐ²Ð° Ð°ÐºÑ‚Ð° Ð¸Ð· Ð½Ð°Ð´Ð»ÐµÐ¶Ð½Ð¾ÑÑ‚Ð¸ ÐžÐ´ÐµÑ™ÐµÑšÐ°,  Ð¾Ð±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ<br /> Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° Ð“Ñ€Ð°Ð´ÑÐºÐµ ÑƒÐ¿Ñ€Ð°Ð²Ðµ.<br />', 0, '', '', 0, ''),
(2, 'ÐÐ´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð°Ñ‚Ð¸Ð²Ð½Ð¾-Ñ‚ÐµÑ…Ð½Ð¸Ñ‡ÐºÐ¸ ÑÐµÐºÑ€ÐµÑ‚Ð°Ñ€', 'ÐžÐ±Ð°Ð²Ñ™Ð° Ð°Ð´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð°Ñ‚Ð¸Ð²Ð½Ðµ, Ñ˜ÐµÐ´Ð½Ð¾ÑÑ‚Ð°Ð²Ð½Ðµ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ð¾Ð½Ðµ, ÑÑ‚Ð°Ñ‚Ð¸ÑÑ‚Ð¸Ñ‡ÐºÐ¾-ÐµÐ²Ð¸Ð´ÐµÐ½Ñ†Ð¸Ð¾Ð½Ðµ Ð¸ Ð¾Ð¿ÐµÑ€Ð°Ñ‚Ð¸Ð²Ð½Ðµ <br />\r\nÐ¿Ð¾ÑÐ»Ð¾Ð²Ðµ, Ð¿Ñ€Ð¸Ð¼Ð°, Ð¿Ñ€ÐµÐ³Ð»ÐµÐ´Ð°Ð²Ð°, Ñ€Ð°ÑÐ¿Ð¾Ñ€ÐµÑ’ÑƒÑ˜Ðµ, ÐµÐ²Ð¸Ð´ÐµÐ½Ñ‚Ð¸Ñ€Ð° Ð¸ Ð´Ð¾ÑÑ‚Ð°Ð²Ñ™Ð° Ñƒ Ñ€Ð°Ð´ Ð°ÐºÑ‚Ð° Ð¸ Ð¿Ñ€ÐµÐ´Ð¼ÐµÑ‚Ðµ, <br />\r\nÐ¾Ñ‚Ð¿Ñ€ÐµÐ¼Ð° Ð¿Ð¾ÑˆÑ‚Ñƒ, Ñ€Ð°Ð·Ð²Ð¾Ð´Ð¸ Ð¿Ñ€ÐµÐ´Ð¼ÐµÑ‚Ðµ Ð¸ Ð°ÐºÑ‚Ð°, Ð°Ñ€Ñ…Ð¸Ð²Ð¸Ñ€Ð° Ð¿Ñ€ÐµÐ´Ð¼ÐµÑ‚e, ÐµÐ²Ð¸Ð´ÐµÐ½Ñ‚Ð¸Ñ€Ð° Ð¿Ð¾Ð´Ð°Ñ‚Ðºe Ð¾ Ð´Ð½ÐµÐ²Ð½Ð¾Ñ˜, <br />\r\nÐ½ÐµÐ´ÐµÑ™Ð½Ð¾Ñ˜ Ð¸ Ð¼ÐµÑÐµÑ‡Ð½Ð¾Ñ˜ Ð¿Ñ€Ð¸ÑÑƒÑ‚Ð½Ð¾ÑÑ‚Ð¸ Ð·Ð°Ð¿Ð¾ÑÐ»ÐµÐ½Ð¸Ñ… Ð½Ð° Ñ€Ð°Ð´Ñƒ, Ð¾Ð¿ÐµÑ€Ð°Ñ‚Ð¸Ð²Ð½Ð¾ Ð¿Ñ€Ð¸Ð¿Ñ€ÐµÐ¼Ð° Ð¿Ð¾Ð´Ð°Ñ‚Ðºe Ð·Ð° Ð´Ð¾Ð½Ð¾ÑˆÐµÑšÐµ <br />\r\nÐ¿Ð»Ð°Ð½Ð¾Ð²Ð° Ð³Ð¾Ð´Ð¸ÑˆÑšÐµÐ³ Ð¾Ð´Ð¼Ð¾Ñ€Ð°, Ð¾Ð´ÑÑƒÑÑ‚Ð²Ð° Ð¸ Ð¿Ñ€ÐµÐºÐ¾Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¾Ð³ Ñ€Ð°Ð´Ð°, Ð¿Ñ€Ð°Ñ‚Ð¸ Ð¸ Ð±ÐµÐ»ÐµÐ¶Ð¸ Ð¿Ð¾Ñ€ÑƒÐºÐµ, ÑƒÐ¿Ð¾Ð·Ð½Ð°Ñ˜Ðµ Ð¸ <br />\r\nÐ¿Ð¾Ð´ÑÐµÑ›Ð° Ñ€ÑƒÐºÐ¾Ð²Ð¾Ð´Ð¸Ð¾Ñ†Ðµ Ð¸ ÑÐ°Ñ€Ð°Ð´Ð½Ð¸ÐºÐµ Ð½Ð° Ð¾Ð±Ð°Ð²ÐµÐ·Ðµ, ÑƒÐ¼Ð½Ð¾Ð¶Ð°Ð²Ð° Ð¼Ð°Ñ‚ÐµÑ€Ð¸Ñ˜Ð°Ð», Ñ‚Ñ€ÐµÐ±ÑƒÑ˜Ðµ ÐºÐ°Ð½Ñ†ÐµÐ»Ð°Ñ€Ð¸Ñ˜ÑÐºÐ¸ <br />\r\nÐ¼Ð°Ñ‚ÐµÑ€Ð¸Ñ˜Ð°Ð», Ð¾Ð±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n', 0, '', '', 0, ''),
(3, 'Ð¨ÐµÑ„ ÐžÐ´ÑÐµÐºÐ°', '	ÐžÑ€Ð³Ð°Ð½Ð¸Ð·ÑƒÑ˜Ðµ Ð¸ ÑƒÑÐ¼ÐµÑ€Ð°Ð²Ð° Ñ€Ð°Ð´ ÐžÐ´ÑÐµÐºÐ°, Ð¾Ð´Ð½Ð¾ÑÐ½Ð¾ Ð¿Ð¾Ñ˜ÐµÐ´Ð¸Ð½Ð¸Ñ… Ð¸Ð·Ð²Ñ€ÑˆÐ¸Ð»Ð°Ñ†Ð°; Ð¾Ð±Ð°Ð²Ñ™Ð° Ð½Ð°Ñ˜ÑÐ»Ð¾Ð¶ÐµÐ½Ð¸Ñ˜Ðµ<br />\r\n Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¸Ð· Ð´ÐµÐ»Ð¾ÐºÑ€ÑƒÐ³Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð¿Ñ€ÑƒÐ¶Ð° ÑÑ‚Ñ€ÑƒÑ‡Ð½Ñƒ Ð¿Ð¾Ð¼Ð¾Ñ› Ð·Ð°Ð¿Ð¾ÑÐ»ÐµÐ½Ð¸Ð¼Ð°; Ñ€Ð°ÑÐ¿Ð¾Ñ€ÐµÑ’ÑƒÑ˜Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð½Ð° <br />\r\nÐ¸Ð·Ð²Ñ€ÑˆÐ¸Ð¾Ñ†Ðµ; Ð¾Ð´Ð³Ð¾Ð²Ð°Ñ€Ð° Ð·Ð° Ð±Ð»Ð°Ð³Ð¾Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¾, Ð·Ð°ÐºÐ¾Ð½Ð¸Ñ‚Ð¾ Ð¸ Ð¿Ñ€Ð°Ð²Ð¸Ð»Ð½Ð¾ Ð¾Ð±Ð°Ð²Ñ™Ð°ÑšÐµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð° Ð¸Ð· Ð´ÐµÐ»Ð¾ÐºÑ€ÑƒÐ³Ð° <br />\r\nÐžÐ´ÑÐµÐºÐ°; Ð¾Ð±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° Ð“Ñ€Ð°Ð´ÑÐºÐµ ÑƒÐ¿Ñ€Ð°Ð²Ðµ Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n', 0, '', '', 0, ''),
(4, 'ÐÐ¾Ñ€Ð¼Ð°Ñ‚Ð¸Ð²Ð½Ð¾-Ð¿Ñ€Ð°Ð²Ð½Ð¸ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð¸ Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð¾Ð±Ñ€Ð°Ð·Ð¾Ð²Ð°ÑšÐ°, \n ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ, Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð¸ÑÐ°ÑšÐ° Ð¸ Ñ„Ð¸Ð·Ð¸Ñ‡ÐºÐµ ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ', ' Ð¡Ñ‚Ñ€ÑƒÑ‡Ð½Ð° Ð¾Ð±Ñ€Ð°Ð´Ð° Ð¿Ð¸Ñ‚Ð°ÑšÐ° Ð¸ Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼Ð° Ð¸Ð· Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð¾Ð±Ñ€Ð°Ð·Ð¾Ð²Ð°ÑšÐ°, ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ Ð¸ Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð¸ÑÐ°ÑšÐ°, <br />Ñ„Ð¸Ð·Ð¸Ñ‡ÐºÐµ ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ (Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸).  Ð˜Ð·Ñ€Ð°Ð´Ð° Ð½Ð°Ñ†Ñ€Ñ‚Ð° Ð¸ Ð¿Ñ€ÐµÐ´Ð»Ð¾Ð³Ð° Ð¾Ð¿ÑˆÑ‚Ð¸Ñ… Ð°ÐºÐ°Ñ‚Ð° ÐºÐ¾Ñ˜Ð° Ð´Ð¾Ð½Ð¾ÑÐµ Ð¾Ñ€Ð³Ð°Ð½Ð¸ <br />Ð³Ñ€Ð°Ð´Ð°. ÐŸÑ€Ð¸Ð¿Ñ€ÐµÐ¼Ð° Ð¼Ð¸ÑˆÑ™ÐµÑšÐ° Ð½Ð° Ð¾Ð¿ÑˆÑ‚Ð° Ð°ÐºÑ‚Ð° ÑƒÑÑ‚Ð°Ð½Ð¾Ð²Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ð¸Ñ… Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ñ˜Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… <br />ÑÐ»ÑƒÐ¶Ð±Ð¸, Ð¿Ñ€ÑƒÐ¶Ð° ÑÑ‚Ñ€ÑƒÑ‡Ð½Ñƒ Ð¿Ð¾Ð¼Ð¾Ñ› Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð¼Ð° ÑƒÑÑ‚Ð°Ð½Ð¾Ð²Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ð¸m Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ñ˜Ð°Ð¼Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… <br />ÑÐ»ÑƒÐ¶Ð±Ð¸ ÐºÐ¾Ð´ Ð´Ð¾Ð½Ð¾ÑˆÐµÑšÐ° Ð¾Ð¿ÑˆÑ‚Ð¸Ñ… Ð°ÐºÐ°Ñ‚Ð° Ð¸ Ñ‚ÑƒÐ¼Ð°Ñ‡ÐµÑšÐ° Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐ°. ÐŸÑ€Ð°Ñ‚Ð¸ Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐµ Ð¾Ð´ Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ° Ð·Ð° <br />Ð¾ÑÑ‚Ð²Ð°Ñ€Ð¸Ð²Ð°ÑšÐµ Ð·Ð°ÐºÐ¾Ð½Ð¸Ñ‚Ð¾ÑÑ‚Ð¸ Ñ€Ð°Ð´Ð° ÑƒÑÑ‚Ð°Ð½Ð¾Ð²Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸, Ñ‡Ð¸Ñ˜Ð¸ Ñ˜Ðµ Ð¾ÑÐ½Ð¸Ð²Ð°Ñ‡ Ð³Ñ€Ð°Ð´, Ð¾Ð±Ð°Ð²Ñ™Ð° <br />Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ñ€Ð°Ð²Ð½Ðµ  Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />', 0, '', '', 0, ''),
(5, 'Ð¨ÐµÑ„ ÐžÐ´ÑÐµÐºÐ°', '	ÐžÑ€Ð³Ð°Ð½Ð¸Ð·ÑƒÑ˜Ðµ Ð¸ ÑƒÑÐ¼ÐµÑ€Ð°Ð²Ð° Ñ€Ð°Ð´ ÐžÐ´ÑÐµÐºÐ°, Ð¾Ð´Ð½Ð¾ÑÐ½Ð¾ Ð¿Ð¾Ñ˜ÐµÐ´Ð¸Ð½Ð¸Ñ… Ð¸Ð·Ð²Ñ€ÑˆÐ¸Ð»Ð°Ñ†Ð°; Ð¾Ð±Ð°Ð²Ñ™Ð° Ð½Ð°Ñ˜ÑÐ»Ð¾Ð¶ÐµÐ½Ð¸Ñ˜Ðµ <br />\r\nÐ¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¸Ð· Ð´ÐµÐ»Ð¾ÐºÑ€ÑƒÐ³Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð¿Ñ€ÑƒÐ¶Ð° ÑÑ‚Ñ€ÑƒÑ‡Ð½Ñƒ Ð¿Ð¾Ð¼Ð¾Ñ› Ð·Ð°Ð¿Ð¾ÑÐ»ÐµÐ½Ð¸Ð¼Ð°; Ñ€Ð°ÑÐ¿Ð¾Ñ€ÐµÑ’ÑƒÑ˜Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð½Ð° <br />\r\nÐ¸Ð·Ð²Ñ€ÑˆÐ¸Ð¾Ñ†Ðµ; Ð¾Ð´Ð³Ð¾Ð²Ð°Ñ€Ð° Ð·Ð° Ð±Ð»Ð°Ð³Ð¾Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¾, Ð·Ð°ÐºÐ¾Ð½Ð¸Ñ‚Ð¾ Ð¸ Ð¿Ñ€Ð°Ð²Ð¸Ð»Ð½Ð¾ Ð¾Ð±Ð°Ð²Ñ™Ð°ÑšÐµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð° Ð¸Ð· Ð´ÐµÐ»Ð¾ÐºÑ€ÑƒÐ³Ð° <br />\r\nÐžÐ´ÑÐµÐºÐ°; Ð¾Ð±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° Ð“Ñ€Ð°Ð´ÑÐºÐµ ÑƒÐ¿Ñ€Ð°Ð²Ðµ Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n', 0, '', '', 0, ''),
(6, 'ÐÐ¾Ñ€Ð¼Ð°Ñ‚Ð¸Ð²Ð½Ð¾-Ð¿Ñ€Ð°Ð²Ð½Ð¸ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð¸ Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð¾Ð±Ñ€Ð°Ð·Ð¾Ð²Ð°ÑšÐ°, \n ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ, Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð¸ÑÐ°ÑšÐ° Ð¸ Ñ„Ð¸Ð·Ð¸Ñ‡ÐºÐµ ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ', ' Ð¡Ñ‚Ñ€ÑƒÑ‡Ð½Ð° Ð¾Ð±Ñ€Ð°Ð´Ð° Ð¿Ð¸Ñ‚Ð°ÑšÐ° Ð¸ Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼Ð° Ð¸Ð· Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð¾Ð±Ñ€Ð°Ð·Ð¾Ð²Ð°ÑšÐ°, ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ Ð¸ Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð¸ÑÐ°ÑšÐ°, <br />Ñ„Ð¸Ð·Ð¸Ñ‡ÐºÐµ ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ (Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸).  Ð˜Ð·Ñ€Ð°Ð´Ð° Ð½Ð°Ñ†Ñ€Ñ‚Ð° Ð¸ Ð¿Ñ€ÐµÐ´Ð»Ð¾Ð³Ð° Ð¾Ð¿ÑˆÑ‚Ð¸Ñ… Ð°ÐºÐ°Ñ‚Ð° ÐºÐ¾Ñ˜Ð° Ð´Ð¾Ð½Ð¾ÑÐµ Ð¾Ñ€Ð³Ð°Ð½Ð¸ <br />Ð³Ñ€Ð°Ð´Ð°. ÐŸÑ€Ð¸Ð¿Ñ€ÐµÐ¼Ð° Ð¼Ð¸ÑˆÑ™ÐµÑšÐ° Ð½Ð° Ð¾Ð¿ÑˆÑ‚Ð° Ð°ÐºÑ‚Ð° ÑƒÑÑ‚Ð°Ð½Ð¾Ð²Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ð¸Ñ… Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ñ˜Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… <br />ÑÐ»ÑƒÐ¶Ð±Ð¸, Ð¿Ñ€ÑƒÐ¶Ð° ÑÑ‚Ñ€ÑƒÑ‡Ð½u Ð¿Ð¾Ð¼Ð¾Ñ› Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð¼Ð° ÑƒÑÑ‚Ð°Ð½Ð¾Ð²Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ð¸m Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ñ˜Ð°Ð¼Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… <br />ÑÐ»ÑƒÐ¶Ð±Ð¸ ÐºÐ¾Ð´ Ð´Ð¾Ð½Ð¾ÑˆÐµÑšÐ° Ð¾Ð¿ÑˆÑ‚Ð¸Ñ… Ð°ÐºÐ°Ñ‚Ð° Ð¸ Ñ‚ÑƒÐ¼Ð°Ñ‡ÐµÑšÐ° Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐ°. ÐŸÑ€Ð°Ñ‚Ð¸ Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐµ Ð¾Ð´ Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ° Ð·Ð° <br />Ð¾ÑÑ‚Ð²Ð°Ñ€Ð¸Ð²Ð°ÑšÐµ Ð·Ð°ÐºÐ¾Ð½Ð¸Ñ‚Ð¾ÑÑ‚Ð¸ Ñ€Ð°Ð´Ð° ÑƒÑÑ‚Ð°Ð½Ð¾Ð²Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸, Ñ‡Ð¸Ñ˜Ð¸ Ñ˜Ðµ Ð¾ÑÐ½Ð¸Ð²Ð°Ñ‡ Ð³Ñ€Ð°Ð´, Ð¾Ð±Ð°Ð²Ñ™Ð°<br /> Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ñ€Ð°Ð²Ð½Ðµ  Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />', 0, '', '', 0, ''),
(7, 'ÐŸÐ¾ÑÐ»Ð¾Ð²Ð¸ Ð¿Ñ€Ð¸Ð¿Ñ€ÐµÐ¼Ðµ Ð¸ Ð¸Ð·Ð²Ñ€ÑˆÐµÑšÐ° Ñ„Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¸Ñ… Ð¿Ð»Ð°Ð½Ð¾Ð²Ð°', '	ÐžÐ±Ð°Ð²Ñ™Ð° Ð½Ð°Ñ˜ÑÐ»Ð¾Ð¶ÐµÐ½Ð¸Ñ˜Ðµ ÑÑ‚Ñ€ÑƒÑ‡Ð½Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð»Ð°Ð½Ð¸Ñ€Ð°ÑšÐ° Ð¸ Ð¿Ñ€Ð°Ñ›ÐµÑšÐ° Ð¿Ñ€Ð¸Ñ…Ð¾Ð´Ð° Ð¸ Ñ€Ð°ÑÑ…Ð¾Ð´Ð° Ð±ÑƒÑŸÐµÑ‚ÑÐºÐ¸Ñ…<br />\r\n ÐºÐ¾Ñ€Ð¸ÑÐ½Ð¸ÐºÐ° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸. Ð£Ñ‡ÐµÑÑ‚Ð²ÑƒÑ˜Ðµ Ñƒ Ð¸Ð·Ñ€Ð°Ð´Ð¸ Ð¿Ñ€ÐµÐ´Ð»Ð¾Ð³Ð° Ñ„Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¾Ð³ Ð¿Ð»Ð°Ð½Ð° <br />\r\nÐ´Ð¸Ñ€ÐµÐºÑ‚Ð½Ð¾Ð³ Ð±ÑƒÑŸÐµÑ‚ÑÐºÐ¾Ð³ ÐºÐ¾Ñ€Ð¸ÑÐ½Ð¸ÐºÐ° â€“ Ð“Ñ€Ð°Ð´ÑÐºÐµ ÑƒÐ¿Ñ€Ð°Ð²Ðµ Ñƒ Ð´ÐµÐ»Ñƒ ÐºÐ¾Ñ˜Ð¸ ÑÐµ Ð¾Ð´Ð½Ð¾ÑÐ¸ Ð½Ð° Ñ˜Ð°Ð²Ð½Ðµ ÑÐ»ÑƒÐ¶Ð±Ðµ, <br />\r\nÑƒÑ‡ÐµÑÑ‚Ð²Ð¾Ð²ÑƒÑ˜Ðµ Ñƒ Ð¸Ð·Ð¼ÐµÐ½Ð¸ Ð¸ Ð´Ð¾Ð¿ÑƒÐ½Ð¸ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¾Ð³ Ð¿Ð»Ð°Ð½Ð°, Ð¿Ñ€Ð°Ñ‚Ð¸ Ð¸ ÐºÐ¾Ð½Ñ‚Ñ€Ð¾Ð»Ð¸ÑˆÐµ Ð¸Ð·Ð²Ñ€ÑˆÐµÑšÐµ Ð¸ÑÑ‚Ð¾Ð³.ÐžÐ±Ð°Ð²Ñ™Ð° <br />\r\nÐ¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿ÐµÑ€Ð¸Ð¾Ð´Ð¸Ñ‡Ð½Ð¾Ð³ Ð¸Ð·Ð²ÐµÑˆÑ‚Ð°Ð²Ð°ÑšÐ° Ð¾ Ð¾ÑÑ‚Ð²Ð°Ñ€ÐµÐ½Ð¸Ð¼ Ð¿Ñ€Ð¸Ñ…Ð¾Ð´Ð¸Ð¼Ð° Ð¸ Ð¸Ð·Ð²Ñ€ÑˆÐµÐ½Ð¸Ð¼ Ñ€Ð°ÑÑ…Ð¾Ð´Ð¸Ð¼Ð° Ð±ÑƒÑŸÐµÑ‚ÑÐºÐ¸Ñ… <br />\r\nÐºÐ¾Ñ€Ð¸ÑÐ½Ð¸ÐºÐ°.ÐŸÑ€Ð¾ÑƒÑ‡Ð°Ð²Ð° Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐµ Ð¸Ð· Ð½Ð°Ð´Ð»ÐµÐ¶Ð½Ð¾ÑÑ‚Ð¸ ÐžÐ´ÑÐµÐºÐ°. ÐŸÑ€Ð¸Ð¿Ñ€ÐµÐ¼Ð° Ð¼Ð¸ÑˆÑ™ÐµÑšÐ° Ð¸ Ð¿Ñ€ÐµÐ´Ð»Ð¾Ð³Ðµ Ñƒ Ð²ÐµÐ·Ð¸ <br />\r\nÐ·Ð°Ñ…Ñ‚ÐµÐ²Ð° ÐºÐ¾Ñ€Ð¸ÑÐ½Ð¸ÐºÐ° Ð±ÑƒÑŸÐµÑ‚Ð° Ð¸ Ð¾Ð±Ð°Ð²Ñ™Ð° Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°. <br />\r\n', 0, '', '', 0, ''),
(8, 'Ð•ÐºÐ¾Ð½Ð¾Ð¼ÑÐºÐ¾-Ñ„Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¸ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð¸ Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸', '	ÐžÐ±Ð°Ð²Ñ™Ð° Ð½Ð°Ñ˜ÑÐ»Ð¾Ð¶ÐµÐ½Ð¸Ñ˜Ðµ ÑÑ‚Ñ€ÑƒÑ‡Ð½Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ, Ð¿Ñ€Ð¸Ð¿Ñ€ÐµÐ¼Ð° Ð°Ð½Ð°Ð»Ð¸Ð·Ðµ, Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ†Ð¸Ñ˜Ðµ Ð¸ Ð¸Ð·Ð²ÐµÑˆÑ‚Ð°Ñ˜Ðµ Ð·Ð° <br />\r\nÐ¿Ð¾Ñ‚Ñ€ÐµÐ±Ðµ Ð“Ñ€Ð°Ð´Ð¾Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ°, Ð“Ñ€Ð°Ð´ÑÐºÐ¾Ð³ Ð²ÐµÑ›Ð° Ð¸ Ð¡ÐºÑƒÐ¿ÑˆÑ‚Ð¸Ð½Ðµ Ð³Ñ€Ð°Ð´Ð° Ð¸Ð· Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð¾Ð±Ñ€Ð°Ð·Ð¾Ð²Ð°ÑšÐ°, ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ, <br />\r\nÐ¸Ð½Ñ„Ð¾Ñ€Ð¼Ð¸ÑÐ°ÑšÐ° Ð¸ Ñ„Ð¸Ð·Ð¸Ñ‡ÐºÐµ ÐºÑƒÐ»Ñ‚ÑƒÑ€Ðµ. ÐŸÑ€Ð°Ñ‚Ð¸ Ð¸ Ð¾Ð±ÐµÐ·Ð±ÐµÑ’ÑƒÑ˜Ðµ Ñ„ÑƒÐ½ÐºÑ†Ð¸Ð¾Ð½Ð¸ÑÐ°ÑšÐµ ÑƒÑÑ‚Ð°Ð½Ð¾Ð²Ð°, Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ñ˜Ð°, <br />\r\nÑ„Ð¾Ð½Ð´Ð¾Ð²Ð° Ð¸ Ð¿Ñ€ÐµÐ´ÑƒÐ·ÐµÑ›Ð° Ñ‡Ð¸Ñ˜Ð¸ Ñ˜Ðµ Ð¾ÑÐ½Ð¸Ð²Ð°Ñ‡ Ð“Ñ€Ð°Ð´ Ð¸Ð· Ð¾Ð²Ð¸Ñ… Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð¸ Ð²Ñ€ÑˆÐ¸ Ð½Ð°Ð´Ð·Ð¾Ñ€ Ð½Ð°Ð´ ÑšÐ¸Ñ…Ð¾Ð²Ð¸Ð¼ Ñ€Ð°Ð´Ð¾Ð¼. <br />\r\nÐŸÑ€Ð¸Ð¿Ñ€ÐµÐ¼Ð° Ð¼Ð¸ÑˆÑ™ÐµÑšÐ° Ð½Ð° Ð¸Ð·Ð²ÐµÑˆÑ‚Ð°Ñ˜Ðµ, Ð¿Ñ€Ð¾Ð³Ñ€Ð°Ð¼Ðµ Ð¸ Ð¿Ð»Ð°Ð½Ð¾Ð²Ðµ Ñ€Ð°Ð´Ð° ÑƒÑÑ‚Ð°Ð½Ð¾Ð²Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ð¸Ñ… Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ñ˜Ð° Ñƒ <br />\r\nÐ¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸. ÐŸÑ€Ð¸Ð¿Ñ€ÐµÐ¼Ð° Ð¼Ð¸ÑˆÑ™ÐµÑšÐ° Ñƒ Ð²ÐµÐ·Ð¸ Ð·Ð°Ñ…Ñ‚ÐµÐ²Ð° ÐºÐ¾Ñ€Ð¸ÑÐ½Ð¸ÐºÐ° Ð±ÑƒÑŸÐµÑ‚Ð°. Ð£Ñ‡ÐµÑÑ‚Ð²ÑƒÑ˜Ðµ Ñƒ Ð¸Ð·Ñ€Ð°Ð´Ð¸<br />\r\n Ð¿Ð»Ð°Ð½Ð° Ñ˜Ð°Ð²Ð½Ð¸Ñ… Ð½Ð°Ð±Ð°Ð²ÐºÐ¸ ÐµÐ½ÐµÑ€Ð³ÐµÐ½Ð°Ñ‚Ð° Ð¸ Ð¿Ñ€Ð¾Ð³Ñ€Ð°Ð¼Ð° Ð¸Ð½Ð²ÐµÑÑ‚Ð¸Ñ†Ð¸Ð¾Ð½Ð¾Ð³ Ð¾Ð´Ñ€Ð¶Ð°Ð²Ð°ÑšÐ° Ð¸Ð½Ð´Ð¸Ñ€ÐµÐºÑ‚Ð½Ð¸Ñ… Ð±ÑƒÑŸÐµÑ‚ÑÐºÐ¸Ñ… <br />\r\nÐºÐ¾Ñ€Ð¸ÑÐ½Ð¸ÐºÐ°.ÐŸÑ€Ð¾ÑƒÑ‡Ð°Ð²Ð° Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐµ Ð¸Ð· Ð½Ð°Ð´Ð»ÐµÐ¶Ð½Ð¾ÑÑ‚Ð¸ ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð¾Ð±Ð°Ð²Ñ™Ð° Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° <br />\r\nÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.', 0, '', '', 0, ''),
(9, 'Ð¤Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¾-Ð¼Ð°Ñ‚ÐµÑ€Ð¸Ñ˜Ð°Ð»Ð½Ð¸ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð¸', 'Ð£Ñ‡ÐµÑÑ‚Ð²ÑƒÑ˜Ðµ Ñƒ Ð¸Ð·Ñ€Ð°Ð´Ð¸ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¸Ñ… Ð¿Ð»Ð°Ð½Ð¾Ð²Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸, Ð¾Ð±Ð°Ð²Ñ™Ð° Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð½Ð° Ð¸Ð·Ð²Ñ€ÑˆÐµÑšÑƒ <br />\r\nÑ„Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¸Ñ… Ð¿Ð»Ð°Ð½Ð¾Ð²Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸, Ð¿Ñ€Ð¸Ð¿Ñ€ÐµÐ¼Ð° Ð¸ Ð¾Ð±Ñ€Ð°Ñ’ÑƒÑ˜Ðµ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ñ˜Ñƒ Ð·Ð° Ð¿Ñ€ÐµÐ½Ð¾Ñ <br />\r\nÑÑ€ÐµÐ´ÑÑ‚Ð°Ð²Ð° Ð¸Ð½Ð´Ð¸Ñ€ÐµÐºÑ‚Ð½Ð¸Ð¼ Ð±ÑƒÑŸÐµÑ‚ÑÐºÐ¸Ð¼ ÐºÐ¾Ñ€Ð¸ÑÐ½Ð¸Ñ†Ð¸Ð¼Ð°. ÐžÐ±Ð°Ð²Ñ™Ð° Ð¿Ð¾ÑÐ»Ð¾Ð²Ð° ÐºÐ¾Ð½Ñ‚Ð¸Ñ€Ð°ÑšÐ° Ð¸ ÐºÐ¾Ð½Ñ‚Ñ€Ð¾Ð»Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð½Ð¸Ñ… <br />\r\nÐ¿Ñ€Ð¾Ð¼ÐµÐ½Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ñ˜Ð°Ð²Ð½Ð¸Ñ… ÑÐ»ÑƒÐ¶Ð±Ð¸, Ð¾Ð±ÐµÐ·Ð±ÐµÑ’ÑƒÑ˜Ðµ, Ð¸ Ð°Ð¶ÑƒÑ€Ð¸Ñ€Ð° Ð¿Ð¾Ñ‚Ñ€ÐµÐ±Ð½Ðµ Ð¿Ð¾Ð´Ð°Ñ‚Ð°ÐºÐµ Ð·Ð° Ð²Ñ€ÑˆÐµÑšÐµ <br />\r\nÐ¸Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ‚Ð¸Ñ‡ÐºÐ¸Ñ… Ð¸ Ð°Ð½Ð°Ð»Ð¸Ñ‚Ð¸Ñ‡ÐºÐ¸Ñ… Ð¿Ð¾ÑÐ»Ð¾Ð²Ð°, Ð¾Ð±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ <br />\r\nÐ½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n', 0, '', '', 0, ''),
(10, 'Ð¨ÐµÑ„ ÐžÐ´ÑÐµÐºÐ°', '	ÐžÑ€Ð³Ð°Ð½Ð¸Ð·ÑƒÑ˜Ðµ Ð¸ ÑƒÑÐ¼ÐµÑ€Ð°Ð²Ð° Ñ€Ð°Ð´ ÐžÐ´ÑÐµÐºÐ°, Ð¾Ð´Ð½Ð¾ÑÐ½Ð¾ Ð¿Ð¾Ñ˜ÐµÐ´Ð¸Ð½Ð¸Ñ… Ð¸Ð·Ð²Ñ€ÑˆÐ¸Ð»Ð°Ñ†Ð°. ÐžÐ±Ð°Ð²Ñ™Ð° Ð½Ð°Ñ˜ÑÐ»Ð¾Ð¶ÐµÐ½Ð¸Ñ˜Ðµ <br />\r\nÐ¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¸Ð· Ð´ÐµÐ»Ð¾ÐºÑ€ÑƒÐ³Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð¿Ñ€ÑƒÐ¶Ð° ÑÑ‚Ñ€ÑƒÑ‡Ð½Ñƒ Ð¿Ð¾Ð¼Ð¾Ñ› Ð·Ð°Ð¿Ð¾ÑÐ»ÐµÐ½Ð¸Ð¼Ð°. Ð Ð°ÑÐ¿Ð¾Ñ€ÐµÑ’ÑƒÑ˜Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð½Ð° <br />\r\nÐ¸Ð·Ð²Ñ€ÑˆÐ¸Ð¾Ñ†Ðµ. ÐžÐ´Ð³Ð¾Ð²Ð°Ñ€Ð° Ð·Ð° Ð±Ð»Ð°Ð³Ð¾Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¾, Ð·Ð°ÐºÐ¾Ð½Ð¸Ñ‚Ð¾ Ð¸ Ð¿Ñ€Ð°Ð²Ð¸Ð»Ð½Ð¾ Ð¾Ð±Ð°Ð²Ñ™Ð°ÑšÐµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð° Ð¸Ð· Ð´ÐµÐ»Ð¾ÐºÑ€ÑƒÐ³Ð° <br />\r\nÐžÐ´ÑÐµÐºÐ°. ÐžÐ±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° Ð“Ñ€Ð°Ð´ÑÐºÐµ ÑƒÐ¿Ñ€Ð°Ð²Ðµ Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n', 0, '', '', 0, ''),
(11, 'Ð£Ð¿Ñ€Ð°Ð²Ð½Ð¸ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð¸ Ð´Ñ€ÑƒÑˆÑ‚Ð²ÐµÐ½Ðµ Ð±Ñ€Ð¸Ð³Ðµ Ð¾ Ð´ÐµÑ†Ð¸', '	ÐŸÑ€Ð¾ÑƒÑ‡Ð°Ð²Ð° Ð¾Ð±Ñ˜Ð°Ð²Ñ™ÐµÐ½Ðµ Ð·Ð°ÐºÐ¾Ð½ÑÐºÐµ Ð¸ Ð¿Ð¾Ð´Ð·Ð°ÐºÐ¾Ð½ÑÐºÐµ Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐµ Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð´Ñ€ÑƒÑˆÑ‚Ð²ÐµÐ½Ðµ Ð±Ñ€Ð¸Ð³Ðµ Ð¾ Ð´ÐµÑ†Ð¸ <br />\r\nÐ¸ Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·ÑƒÑ˜Ðµ ÑšÐ¸Ñ…Ð¾Ð²Ñƒ Ð¿Ñ€Ð¸Ð¼ÐµÐ½Ñƒ, Ð´Ð°Ñ˜Ðµ ÑÑ‚Ñ€ÑƒÑ‡Ð½Ð° Ð¼Ð¸ÑˆÑ™ÐµÑšÐ°, Ð¿Ñ€ÐµÐ´Ð»Ð¾Ð³Ðµ Ð¸ Ñ‚ÑƒÐ¼Ð°Ñ‡ÐµÑšÐ° Ð¾ Ð¾ÑÑ‚Ð²Ð°Ñ€Ð¸Ð²Ð°ÑšÑƒ Ð¿Ñ€Ð°Ð²Ð° <br />\r\nÐ³Ñ€Ð°Ñ’Ð°Ð½Ð°, Ð´Ð°Ñ˜Ðµ Ð¸Ð½Ð¸Ñ†Ð¸Ñ˜Ð°Ñ‚Ð¸Ð²Ñƒ Ð·Ð° Ð¸Ð·Ð¼ÐµÐ½Ñƒ Ð¸ Ð´Ð¾Ð¿ÑƒÐ½Ñƒ Ð¿Ñ€Ð°Ð²Ð½Ð¸Ñ… Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐ°, Ð¸Ð·Ñ€Ð°Ñ’ÑƒÑ˜Ðµ Ñ€ÐµÑˆÐµÑšÐ° Ð¾ Ð¾ÑÑ‚Ð²Ð°Ñ€Ð¸Ð²Ð°ÑšÑƒ <br />\r\nÐ¿Ñ€Ð°Ð²Ð° Ð³Ñ€Ð°Ñ’Ð°Ð½Ð° Ñƒ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð´Ñ€ÑƒÑˆÑ‚Ð²ÐµÐ½Ðµ Ð±Ñ€Ð¸Ð³Ðµ Ð¾ Ð´ÐµÑ†Ð¸, Ð¸Ð·Ñ€Ð°Ñ’ÑƒÑ˜Ðµ Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ†Ð¸Ñ˜Ðµ, Ð¸Ð·Ð²ÐµÑˆÑ‚Ð°Ñ˜Ðµ Ð¸ Ð°Ð½Ð°Ð»Ð¸Ð·Ð° <br />\r\nÐ·Ð° Ð¿Ð¾Ñ‚Ñ€ÐµÐ±Ðµ Ð½Ð°Ð´Ð»ÐµÐ¶Ð½Ð¾Ð³ ÐœÐ¸Ð½Ð¸ÑÑ‚Ð°Ñ€ÑÑ‚Ð²Ð° Ð¸ Ð¾Ñ€Ð³Ð°Ð½Ð° Ð³Ñ€Ð°Ð´Ð°. ÐžÐ±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° <br />\r\nÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n', 0, '', '', 0, ''),
(12, 'Ð¤Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¸ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð¸ Ð´Ñ€ÑƒÑˆÑ‚Ð²ÐµÐ½Ðµ Ð±Ñ€Ð¸Ð³Ðµ Ð¾ Ð´ÐµÑ†Ð¸', '	Ð’Ñ€ÑˆÐ¸ Ð¿Ñ€Ð¸Ñ˜ÐµÐ¼ ÑÑ‚Ñ€Ð°Ð½Ð°ÐºÐ° Ð¸ Ð¿Ñ€Ð¸Ñ˜ÐµÐ¼ Ð·Ð°Ñ…Ñ‚ÐµÐ²Ð° Ð·Ð° Ñ€Ð¾Ð´Ð¸Ñ‚ÐµÑ™ÑÐºÐ¸ Ð´Ð¾Ð´Ð°Ñ‚Ð°Ðº Ð¸ Ð½Ð°ÐºÐ½Ð°Ð´Ñƒ<br />\r\n Ð·Ð°Ñ€Ð°Ð´Ðµ Ð·Ð° Ð²Ñ€ÐµÐ¼Ðµ Ð¿Ð¾Ñ€Ð¾Ð´Ð¸Ñ™ÑÐºÐ¾Ð³ Ð¾Ð´ÑÑƒÑÑ‚Ð²Ð°, Ð¾Ð´ÑÑƒÑÑ‚Ð²Ð° Ñ€Ð°Ð´Ð¸ Ð½ÐµÐ³Ðµ Ð´ÐµÑ‚ÐµÑ‚Ð° Ð¸ Ð¿Ð¾ÑÐµÐ±Ð½Ðµ Ð½ÐµÐ³Ðµ Ð´ÐµÑ‚ÐµÑ‚Ð°.<br />\r\nÐ’Ñ€ÑˆÐ¸ Ð¿Ñ€Ð¸Ð¿Ñ€ÐµÐ¼Ñƒ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ñ˜Ðµ Ð¸ Ð¿Ð¾ÑÑ‚ÑƒÐ¿Ð° Ð¿Ð¾ Ñ€ÐµÐºÐ»Ð°Ð¼Ð°Ñ†Ð¸Ñ˜Ð°Ð¼Ð°. ÐžÐ±Ð°Ð²Ñ™Ð° Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð²ÐµÐ·Ð°Ð½Ðµ Ð·Ð° ÑƒÑ‚Ð²Ñ€Ñ’Ð¸Ð²Ð°ÑšÐµ<br />\r\nÐ²Ð¸ÑÐ¸Ð½Ðµ Ð½Ð°ÐºÐ½Ð°Ð´Ðµ Ð·Ð°Ñ€Ð°Ð´Ðµ Ð·Ð° Ð²Ñ€ÐµÐ¼Ðµ Ð¿Ð¾Ñ€Ð¾Ð´Ð¸Ñ™ÑÐºÐ¾Ð³ Ð¾Ð´ÑÑƒÑÑ‚Ð²Ð°, Ð¾Ð´ÑÑƒÑÑ‚Ð²Ð° Ñ€Ð°Ð´Ð¸ Ð½ÐµÐ³Ðµ Ð´ÐµÑ‚ÐµÑ‚Ð° Ð¸ Ð¿Ð¾ÑÐµÐ±Ð½Ðµ <br />\r\nÐ½ÐµÐ³Ðµ Ð´ÐµÑ‚ÐµÑ‚Ð°, ÐºÐ°Ð¾ Ð¸ ÑƒÑ‚Ð²Ñ€Ñ’Ð¸Ð²Ð°ÑšÐµ Ð¿Ñ€Ð°Ð²Ð° Ð½Ð° Ñ€Ð¾Ð´Ð¸Ñ‚ÐµÑ™ÑÐºÐ¸ Ð´Ð¾Ð´Ð°Ñ‚Ð°Ðº. ÐŸÑ€Ð°Ñ‚Ð¸ Ð¸ Ð¿Ñ€Ð¾ÑƒÑ‡Ð°Ð²Ð° Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐµ Ð¸Ð· Ð¾Ð²Ðµ <br />\r\nÐ¾Ð±Ð»Ð°ÑÑ‚Ð¸, Ð¾Ð´Ð³Ð¾Ð²Ð°Ñ€Ð° Ð·Ð° ÐµÑ„Ð¸ÐºÐ°ÑÐ½Ð¾ Ð¸ Ð·Ð°ÐºÐ¾Ð½Ð¸Ñ‚Ð¾ Ð¾Ð±Ð°Ð²Ñ™Ð°ÑšÐµ ÐµÐºÐ¾Ð½Ð¾Ð¼ÑÐºÐ¾-Ñ„Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐ¸Ñ… Ð¿Ð¾ÑÐ»Ð¾Ð²Ð°. ÐžÐ±Ð°Ð²Ñ™Ð° Ð¸<br />\r\n Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n<br />\r\n', 0, '', '', 0, ''),
(13, 'ÐšÑšÐ¸Ð³Ð¾Ð²Ð¾Ð´ÑÑ‚Ð²ÐµÐ½Ð¸ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð¸ Ð´Ñ€ÑƒÑˆÑ‚Ð²ÐµÐ½Ðµ Ð±Ñ€Ð¸Ð³Ðµ Ð¾ Ð´ÐµÑ†Ð¸', '	ÐšÐ¾Ð½Ñ‚Ð¸Ñ€Ð° Ð¸ ÐºÑšÐ¸Ð¶Ð¸ ÐºÑšÐ¸Ð³Ð¾Ð²Ð¾Ð´ÑÑ‚Ð²ÐµÐ½Ñƒ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ñ˜Ñƒ, Ð²Ð¾Ð´Ð¸ Ð¿Ð¾ÑÐ»Ð¾Ð²Ð½Ðµ ÐºÑšÐ¸Ð³Ðµ, ÑÐ²Ñ€ÑÑ‚Ð°Ð²Ð° <br />\r\nÐ±Ð°Ð½ÐºÐ¾Ð²Ð½Ðµ Ð¸Ð·Ð²Ð¾Ð´Ðµ Ð¿Ñ€ÐµÐ¼Ð° Ð²Ñ€ÑÑ‚Ð°Ð¼Ð° ÑÑ€ÐµÐ´ÑÑ‚Ð°Ð²Ð°, Ð¸Ð·Ñ€Ð°Ñ’ÑƒÑ˜Ðµ Ð¼ÐµÑÐµÑ‡Ð½Ðµ Ð¸Ð·Ð²ÐµÑˆÑ‚Ð°Ñ˜Ðµ Ð¾ Ð¿Ð¾Ñ‚Ñ€ÐµÐ±Ð½Ð¸Ð¼ ÑÑ€ÐµÐ´ÑÑ‚Ð²Ð¸Ð¼Ð°,<br />\r\nÐ¸Ð·Ñ€Ð°Ñ’ÑƒÑ˜Ðµ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¸Ñ˜ÑÐºÐµ Ð¸Ð·Ð²ÐµÑˆÑ‚Ð°Ñ˜Ðµ Ð¾ ÑƒÑ‚Ñ€Ð¾ÑˆÐµÐ½Ð¸Ð¼ ÑÑ€ÐµÐ´ÑÑ‚Ð²Ð¸Ð¼Ð° (Ð¼ÐµÑÐµÑ‡Ð½Ðµ, Ñ‚Ñ€Ð¾Ð¼ÐµÑÐµÑ‡Ð½Ðµ Ð¸ Ð³Ð¾Ð´Ð¸ÑˆÑšÐµ), <br />\r\nÑƒÑÐ¼ÐµÑ€Ð°Ð²Ð° ÑÑ€ÐµÐ´ÑÑ‚Ð²Ð° Ð½Ð° Ð¾Ð´Ð³Ð¾Ð²Ð°Ñ€Ð°Ñ˜ÑƒÑ›Ðµ Ñ€Ð°Ñ‡ÑƒÐ½Ðµ ÐºÐ° ÐºÐ¾Ñ€Ð¸ÑÐ½Ð¸Ñ†Ð¸Ð¼Ð° Ð¿Ñ€Ð°Ð²Ð°. ÐžÐ±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ <br />\r\nÐ½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n', 0, '', '', 0, ''),
(14, 'ÐŸÐ¾ÑÐ»Ð¾Ð²Ð¸ Ð»Ð¸ÐºÐ²Ð¸Ð´Ð°Ñ‚ÑƒÑ€Ðµ Ð¿Ð¾Ñ€Ð¾Ð´Ð¸Ñ™ÑÐºÐ¾Ð³ Ð¿Ñ€Ð°Ð²Ð° ', '	Ð’Ñ€ÑˆÐ¸  ÐºÐ¾Ð½Ñ‚Ñ€Ð¾Ð»Ñƒ Ð¸ Ð»Ð¸ÐºÐ²Ð¸Ð´Ð¸Ñ€Ð°ÑšÐµ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ð°Ñ‚Ð° Ð½Ð° Ð¾ÑÐ½Ð¾Ð²Ñƒ ÐºÐ¾Ñ˜Ð¸Ñ… ÑÐµ Ð²Ñ€ÑˆÐ¸ Ð¸ÑÐ¿Ð»Ð°Ñ‚Ð° Ð½Ð°ÐºÐ½Ð°Ð´Ð°<br />\r\nÐ·Ð°Ñ€Ð°Ð´Ð° Ð·Ð°Ð¿Ð¾ÑÐ»ÐµÐ½Ð¸Ñ… Ð¿Ð¾Ñ€Ð¾Ð´Ð¸Ñ™Ð°, ÐºÐ°Ð¾ Ð¸ Ð¿Ð¾Ñ€Ð¾Ð´Ð¸Ñ™Ð° ÐºÐ¾Ñ˜Ðµ ÑÐ°Ð¼Ð¾ÑÑ‚Ð°Ð»Ð½Ð¾ Ð¾Ð±Ð°Ð²Ñ™Ð°Ñ˜Ñƒ Ð´ÐµÐ»Ð°Ñ‚Ð½Ð¾ÑÑ‚ (Ñ‚Ñ˜. Ð¿Ð¾Ñ€Ð¾Ð´Ð¸Ñ™Ðµ<br />\r\n Ð¾ÑÐ½Ð¸Ð²Ð°Ñ‡Ð¸, Ð¾Ð´Ð½Ð¾ÑÐ½Ð¾ Ð²Ð»Ð°ÑÐ½Ð¸Ñ†Ð¸ Ð¿Ñ€ÐµÐ´ÑƒÐ·ÐµÑ›Ð° ÐºÐ¾Ñ˜Ð¸ Ð¸Ð¼Ð°Ñ˜Ñƒ Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð·Ð°Ð¿Ð¾ÑÐ»ÐµÐ½Ðµ). Ð’Ñ€ÑˆÐ¸ Ð¾Ð±Ñ€Ð°Ñ‡ÑƒÐ½ Ð¸ Ð¸ÑÐ¿Ð»Ð°Ñ‚Ñƒ <br />\r\nÐ½Ð°ÐºÐ½Ð°Ð´Ð° Ð·Ð°Ñ€Ð°Ð´Ð° Ð·Ð° Ð»Ð¸Ñ†Ð° ÐºÐ¾Ñ˜Ð° ÑÐ°Ð¼Ð¾ÑÑ‚Ð°Ð»Ð½Ð¾ Ð¾Ð±Ð°Ð²Ñ™Ð°Ñ˜Ñƒ Ð´ÐµÐ»Ð°Ñ‚Ð½Ð¾ÑÑ‚ ÐºÐ°Ð¾ Ð¿Ñ€Ð¾Ñ„ÐµÑÐ¸Ð¾Ð½Ð°Ð»Ð½Ð¾ Ð·Ð°Ð½Ð¸Ð¼Ð°ÑšÐµ, Ð° <br />\r\nÐ½ÐµÐ¼Ð°Ñ˜Ñƒ Ð´Ñ€ÑƒÐ³Ðµ Ð·Ð°Ð¿Ð¾ÑÐ»ÐµÐ½Ðµ. Ð’Ð¾Ð´Ð¸ Ð¾Ð¿ÐµÑ€Ð°Ñ‚Ð¸Ð²Ð½Ñƒ ÐµÐ²Ð¸Ð´ÐµÐ½Ñ†Ð¸Ñ˜Ñƒ Ð¾ Ð¸ÑÐ¿Ð»Ð°Ñ›ÐµÐ½Ð¸Ð¼ Ð½Ð°ÐºÐ½Ð°Ð´Ð°Ð¼Ð°, Ð¿Ñ€Ð°Ñ‚Ð¸ Ð¿Ñ€Ð¾Ð¿Ð¸ÑÐµ Ð¸Ð·<br />\r\n Ð½Ð°Ð²ÐµÐ´ÐµÐ½Ðµ Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸. ÐžÐ±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.<br />\r\n', 0, '', '', 0, ''),
(15, 'ÐŸÐ¾ÑÐ»Ð¾Ð²Ð¸ Ð»Ð¸ÐºÐ²Ð¸Ð´Ð°Ñ‚ÑƒÑ€Ðµ Ð´ÐµÑ‡Ð¸Ñ˜ÐµÐ³ Ð´Ð¾Ð´Ð°Ñ‚ÐºÐ°', '	Ð’Ñ€ÑˆÐ¸ Ð¿Ñ€ÐµÐ³Ð»ÐµÐ´ Ð¸ Ð»Ð¸ÐºÐ²Ð¸Ð´Ð¸Ñ€Ð°ÑšÐµ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ð°Ñ‚Ð° Ð½Ð° Ð¾ÑÐ½Ð¾Ð²Ñƒ ÐºÐ¾Ñ˜Ð¸Ñ… ÑÐµ Ð²Ñ€ÑˆÐ¸ Ð¸ÑÐ¿Ð»Ð°Ñ‚Ð° Ð¿Ñ€Ð°Ð²Ð° Ð½Ð°<br />\r\nÐ´ÐµÑ‡Ð¸Ñ˜Ð¸ Ð´Ð¾Ð´Ð°Ñ‚Ð°Ðº, Ð¿Ñ€Ð¸Ñ˜ÐµÐ¼ ÑÑ‚Ñ€Ð°Ð½Ð°ÐºÐ° Ð¸ Ð¿Ð¾ÑÑ‚ÑƒÐ¿Ð°ÑšÐµ Ð¿Ð¾ Ñ€ÐµÐºÐ»Ð°Ð¼Ð°Ñ†Ð¸Ñ˜Ð°Ð¼Ð°, ÑƒÑÐ°Ð³Ð»Ð°ÑˆÐ°Ð²Ð°ÑšÐµ ÑÐ¿Ð¸ÑÐºÐ¾Ð²Ð° (Ð»Ð¸ÑÑ‚Ð¸Ð½Ð³ ÐœÐ¸Ð½Ð¸ÑÑ‚Ð°Ñ€ÑÑ‚Ð²Ð°), Ð¸ÑÐ¿Ð»Ð°Ñ›ÑƒÑ˜Ðµ Ð´ÐµÑ‡Ð¸Ñ˜Ðµ Ð´Ð¾Ð´Ð°Ñ‚ÐºÐµ ÑÐ° Ð´Ð¾Ð½ÐµÑ‚Ð¸Ð¼ Ñ€ÐµÑˆÐµÑšÐ¸Ð¼Ð°, Ð¸Ð·Ð´Ð°Ñ˜Ðµ Ð¿Ð¾Ñ‚Ð²Ñ€Ð´Ðµ Ð¸Ð· ÐµÐ²Ð¸Ð´ÐµÐ½Ñ†Ð¸Ñ˜Ðµ Ñƒ Ð·ÐµÐ¼Ñ™Ð¸ Ð¸ Ð·Ð° Ð¸Ð½Ð¾ÑÑ‚Ñ€Ð°Ð½ÑÑ‚Ð²Ð¾. ÐžÐ±Ð°Ð²Ñ™Ð° Ð¸ Ð´Ñ€ÑƒÐ³Ðµ Ð¿Ð¾ÑÐ»Ð¾Ð²Ðµ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ñƒ ÑˆÐµÑ„Ð° ÐžÐ´ÑÐµÐºÐ° Ð¸ Ð½Ð°Ñ‡ÐµÐ»Ð½Ð¸ÐºÐ° ÐžÐ´ÐµÑ™ÐµÑšÐ°.', 0, '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `ks_pol`
--

CREATE TABLE IF NOT EXISTS `ks_pol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_pol`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_poz_jezika`
--

CREATE TABLE IF NOT EXISTS `ks_poz_jezika` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbgradnika` varchar(13) DEFAULT NULL,
  `jezik` int(11) DEFAULT NULL,
  `ocena` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_poz_jezika`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_predmeti`
--

CREATE TABLE IF NOT EXISTS `ks_predmeti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ks_predmeti`
--

INSERT INTO `ks_predmeti` (`id`, `naziv`) VALUES
(1, 'Prijem u radni odnos'),
(2, 'Rasporedjivanje'),
(3, 'Mirovanje radnog odnosa'),
(4, 'Unapredjenje u viÅ¡e zvanje'),
(5, 'Gubitak zvanja'),
(6, 'Prestanak radnog odnosa');

-- --------------------------------------------------------

--
-- Table structure for table `ks_prethodni_odmori`
--

CREATE TABLE IF NOT EXISTS `ks_prethodni_odmori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) DEFAULT NULL,
  `godina` int(11) DEFAULT NULL,
  `dana` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_prethodni_odmori`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_prethodni_staz`
--

CREATE TABLE IF NOT EXISTS `ks_prethodni_staz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) DEFAULT NULL,
  `firma` varchar(255) DEFAULT NULL,
  `pocetak` date DEFAULT NULL,
  `prestanak` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_prethodni_staz`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_radna_mesta`
--

CREATE TABLE IF NOT EXISTS `ks_radna_mesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  `opis` varchar(1000) DEFAULT NULL,
  `koeficijent` mediumtext,
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `ks_radna_mesta`
--

INSERT INTO `ks_radna_mesta` (`id`, `naziv`, `opis`, `koeficijent`) VALUES
(25, 'Daktilograf', 'Daktilograf', '8.74'),
(26, 'Kvalifikovani radnik', 'Kvalifikovani radnik', '8.00'),
(1, 'MlaÄ‘i referent', 'mlaÄ‘i referent', NULL),
(10, 'NaÄelnik odeljenja', 'NaÄelnik odeljenja', NULL),
(27, 'Nekvalifikovani radnik', 'Nekvalifikovani radnik', '6.40'),
(2, 'Referent ', 'Referent', '8.74'),
(9, 'Rukovodilac grupe', 'Rukovodilac grupe', NULL),
(7, 'Samostalni savetnik', 'Samostalni savetnik', NULL),
(13, 'Samostalni strucni saradnik', 'Samostalni strucni saradnik', '12.05'),
(22, 'Saradnik', 'Saradnik', '9.95'),
(24, 'Stenograf', 'Stenograf', '8.85'),
(4, 'StruÄni saradnik', 'StruÄni saradnik', '10.45'),
(23, 'Visokokvalifikovani radnik', 'Visokokvalifikovani radnik', '8.95'),
(12, 'ViÅ¡i referent', 'ViÅ¡i referent', '8.85'),
(21, 'ViÅ¡i saradnik', 'ViÅ¡i saradnik', '9.91'),
(20, 'ViÅ¡i struÄni saradnik', 'ViÅ¡i struÄni saradnik', '10.77'),
(11, 'Å ef odseka', 'Å ef odseka', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ks_radnik`
--

CREATE TABLE IF NOT EXISTS `ks_radnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) CHARACTER SET latin1 DEFAULT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prezime` varchar(255) CHARACTER SET latin2 COLLATE latin2_croatian_ci DEFAULT NULL,
  `imeoca` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datum_rodjenja` date DEFAULT NULL,
  `pol` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `br_mat_knjige` int(11) DEFAULT NULL,
  `skolska_sprema` int(11) DEFAULT NULL,
  `zanimanje` int(11) DEFAULT NULL,
  `radno_mesto` int(11) DEFAULT NULL,
  `sektor` int(11) DEFAULT NULL,
  `pocetak` date DEFAULT NULL,
  `kraj` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `godina` int(11) DEFAULT NULL,
  `dan` int(11) DEFAULT NULL,
  `meseci` int(11) DEFAULT NULL,
  `mat_br` int(11) DEFAULT NULL,
  `opis_posla` int(11) DEFAULT NULL,
  `mestor` int(11) DEFAULT NULL,
  `ulica` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `broj` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `slika` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_radnik`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_radni_odnos`
--

CREATE TABLE IF NOT EXISTS `ks_radni_odnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) DEFAULT NULL,
  `br_akta` varchar(255) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `predmet` int(11) DEFAULT NULL,
  `zvanje` varchar(255) DEFAULT NULL,
  `vrsta` int(11) DEFAULT NULL,
  `mesto` int(11) DEFAULT NULL,
  `sektor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ks_radni_odnos`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_sektor`
--

CREATE TABLE IF NOT EXISTS `ks_sektor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ks_sektor`
--

INSERT INTO `ks_sektor` (`id`, `naziv`) VALUES
(1, 'Odeljenje za javne sluzbe'),
(2, 'Odsek za javne sluzbe'),
(3, 'Odsek za drustvenu brigu o deci'),
(4, 'Odsek za socijalnu zastitu'),
(5, 'Grupa za dijasporu'),
(6, 'Odeljenje za opstu upravu, mesne zajednice i zajednicke poslove'),
(7, 'Odsek za opstu upravu'),
(8, 'Grupa za mesne zajednice'),
(10, 'Sluzba za zajednicke poslove'),
(11, 'Grupa za odrzavanje i obezbedjenje');

-- --------------------------------------------------------

--
-- Table structure for table `ks_skole`
--

CREATE TABLE IF NOT EXISTS `ks_skole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ks_skole`
--

INSERT INTO `ks_skole` (`id`, `naziv`) VALUES
(1, 'Dr Jovan Cvijic'),
(2, 'Tehnicka Skola Smederevo'),
(3, 'Gimnazija Smederevo');

-- --------------------------------------------------------

--
-- Table structure for table `ks_sposobnost`
--

CREATE TABLE IF NOT EXISTS `ks_sposobnost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbgradnika` varchar(13) DEFAULT NULL,
  `sposobnost` int(11) DEFAULT NULL,
  `ocena` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_sposobnost`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_status`
--

CREATE TABLE IF NOT EXISTS `ks_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ks_status`
--

INSERT INTO `ks_status` (`id`, `naziv`) VALUES
(1, 'Aktivan - neodredjeno'),
(2, 'Aktivan - odredjeno'),
(3, 'Aktivan - pripravnik'),
(4, 'Aktivan - volonter'),
(5, 'Otkaz'),
(6, 'Penzionisan');

-- --------------------------------------------------------

--
-- Table structure for table `ks_strucna_sprema`
--

CREATE TABLE IF NOT EXISTS `ks_strucna_sprema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  `sledovanje` int(11) DEFAULT NULL,
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ks_strucna_sprema`
--

INSERT INTO `ks_strucna_sprema` (`id`, `naziv`, `sledovanje`) VALUES
(1, '3. stepen', 3),
(2, '4. stepen', 4),
(3, '5. stepen', 5),
(4, '6. stepen', 6),
(5, '7. stepen', 7),
(6, '8. stepen', 8),
(7, 'Nekvalifikovan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ks_telefoni`
--

CREATE TABLE IF NOT EXISTS `ks_telefoni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` varchar(13) DEFAULT NULL,
  `broj` varchar(25) DEFAULT NULL,
  `tip` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ks_telefoni`
--


-- --------------------------------------------------------

--
-- Table structure for table `ks_tip_telefona`
--

CREATE TABLE IF NOT EXISTS `ks_tip_telefona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ks_tip_telefona`
--

INSERT INTO `ks_tip_telefona` (`id`, `naziv`) VALUES
(1, 'mobilni'),
(2, 'fiksni'),
(3, 'sluzbeni');

-- --------------------------------------------------------

--
-- Table structure for table `ks_ulice`
--

CREATE TABLE IF NOT EXISTS `ks_ulice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ks_ulice`
--

INSERT INTO `ks_ulice` (`id`, `naziv`) VALUES
(1, 'Knez Mihajlova'),
(2, 'Petrijevska'),
(3, 'Starca Vujadina');

-- --------------------------------------------------------

--
-- Table structure for table `ks_vrste_aktivnosti`
--

CREATE TABLE IF NOT EXISTS `ks_vrste_aktivnosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ks_vrste_aktivnosti`
--

INSERT INTO `ks_vrste_aktivnosti` (`id`, `naziv`) VALUES
(1, 'UpuÄ‡ivanje na rad u drugi drÅ¾avni organ'),
(2, 'Studijski boravak u inostranstvu'),
(3, 'Specijalizacija'),
(4, 'Å kolovanje'),
(5, 'Sticanje nauÄnog zvanja'),
(6, 'ÄŒlanstvo u komisijama i dr. telima Vlade');

-- --------------------------------------------------------

--
-- Table structure for table `ks_vrste_odgovornosti`
--

CREATE TABLE IF NOT EXISTS `ks_vrste_odgovornosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ks_vrste_odgovornosti`
--

INSERT INTO `ks_vrste_odgovornosti` (`id`, `naziv`) VALUES
(1, 'Disciplinska odgovornost'),
(2, 'Materijalna odgovornost'),
(3, 'Krivicna odgovornost'),
(4, 'Odgovornost za privredni prestup');

-- --------------------------------------------------------

--
-- Table structure for table `ks_zanimanja`
--

CREATE TABLE IF NOT EXISTS `ks_zanimanja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ks_zanimanja`
--

INSERT INTO `ks_zanimanja` (`id`, `naziv`) VALUES
(1, 'pekar'),
(3, 'lekar'),
(4, 'apotekar'),
(5, 'doktor'),
(6, 'inzenjer informatike'),
(7, 'diplomirani ekonomista'),
(8, 'diplomirani pravnik'),
(9, 'Vozac motornih vozila'),
(10, 'NK radnik');

-- --------------------------------------------------------

--
-- Table structure for table `ks_znanja`
--

CREATE TABLE IF NOT EXISTS `ks_znanja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ks_znanja`
--

INSERT INTO `ks_znanja` (`id`, `naziv`) VALUES
(6, 'MS Word'),
(7, 'MS Excel'),
(8, 'Vozacka dozvola B kategorije'),
(9, 'MS Power Point');

-- --------------------------------------------------------

--
-- Table structure for table `s48_klase`
--

CREATE TABLE IF NOT EXISTS `s48_klase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `s48_klase`
--


-- --------------------------------------------------------

--
-- Table structure for table `s48_korisnici`
--

CREATE TABLE IF NOT EXISTS `s48_korisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupa` int(11) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `s48_korisnici`
--


-- --------------------------------------------------------

--
-- Table structure for table `s48_pitanja`
--

CREATE TABLE IF NOT EXISTS `s48_pitanja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pitanje` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `odgovor` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `klasa` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `opis` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `s48_pitanja`
--


-- --------------------------------------------------------

--
-- Table structure for table `s48_poruke`
--

CREATE TABLE IF NOT EXISTS `s48_poruke` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `poruka` longtext COLLATE utf8_unicode_ci,
  `brzahteva` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `obradjivac` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `s48_poruke`
--


-- --------------------------------------------------------

--
-- Table structure for table `s48_predmet`
--

CREATE TABLE IF NOT EXISTS `s48_predmet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sluzba` int(11) DEFAULT NULL,
  `godina` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `naslov` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poruka` longtext COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `obradjivac` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oemail` int(11) DEFAULT NULL,
  `otelefon` int(11) DEFAULT NULL,
  `osms` int(11) DEFAULT NULL,
  `oweb` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `s48_predmet`
--


-- --------------------------------------------------------

--
-- Table structure for table `s48_saradnici`
--

CREATE TABLE IF NOT EXISTS `s48_saradnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `klasa` int(11) DEFAULT NULL,
  `ime` varchar(100) DEFAULT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `napomena` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `s48_saradnici`
--


-- --------------------------------------------------------

--
-- Table structure for table `s48_statusi`
--

CREATE TABLE IF NOT EXISTS `s48_statusi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`naziv`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `s48_statusi`
--

INSERT INTO `s48_statusi` (`id`, `naziv`) VALUES
(1, 'neobradjen'),
(2, 'obradjen'),
(3, 'u radu'),
(4, 'odbacen'),
(5, 'zavrsen'),
(9, 'ceka se dopuna');
