-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Lip 2014, 12:23
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

CREATE TABLE IF NOT EXISTS `adresy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ulica` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `numer` varchar(10) COLLATE utf8_polish_ci DEFAULT NULL,
  `miasto` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `panstwo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `panstwo_id` (`panstwo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=18 ;

--
-- Zrzut danych tabeli `adresy`
--

INSERT INTO `adresy` (`id`, `ulica`, `numer`, `miasto`, `panstwo_id`) VALUES
(1, 'Komorska', '63', 'Warszawa', 12),
(4, 'Jakas', '69', 'Praga', 2),
(10, '', '', 'Charzykowy', 2),
(12, 'Stokrotka', '7', 'Paris', 1),
(13, NULL, NULL, NULL, NULL),
(14, '', '', '', NULL),
(15, NULL, NULL, NULL, NULL),
(16, 'Fordońska', '99', 'Bydgoszcz', 1),
(17, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `banki`
--

CREATE TABLE IF NOT EXISTS `banki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `adres_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `adres_id` (`adres_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `banki`
--

INSERT INTO `banki` (`id`, `nazwa`, `adres_id`) VALUES
(1, 'Bank Nasienia', 1),
(2, 'Bank Miłości', 12),
(3, 'Pryszczoland', 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_osobowe`
--

CREATE TABLE IF NOT EXISTS `dane_osobowe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `pesel` varchar(12) COLLATE utf8_polish_ci DEFAULT NULL,
  `adres_id` int(11) NOT NULL,
  `grupa_id` int(11) DEFAULT NULL,
  `stanowisko_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `adres_id` (`adres_id`),
  UNIQUE KEY `pesel` (`pesel`),
  KEY `grupa_id` (`grupa_id`),
  KEY `stanowisko_id` (`stanowisko_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `dane_osobowe`
--

INSERT INTO `dane_osobowe` (`id`, `imie`, `nazwisko`, `pesel`, `adres_id`, `grupa_id`, `stanowisko_id`) VALUES
(6, 'Klaudia', 'Augustyńska', '92121010569', 10, 1, 1),
(7, 'Nowa', 'Rejestracja', '1234567891', 13, NULL, NULL),
(8, 'Janusz', 'Wąsowski', '56789044443', 14, 8, NULL),
(9, 'Paweł', 'Chojnacki', '1234', 15, 9, NULL),
(10, 'Paweł', 'Augustyński', '3453445', 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `donacje`
--

CREATE TABLE IF NOT EXISTS `donacje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `organ_id` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `dawca_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organ_id` (`organ_id`),
  KEY `bank_id` (`bank_id`),
  KEY `dawca_id` (`dawca_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `donacje`
--

INSERT INTO `donacje` (`id`, `data`, `organ_id`, `bank_id`, `dawca_id`) VALUES
(5, '2014-06-01 20:49:59', 2, 1, 5),
(8, '2014-06-01 20:55:53', 1, NULL, 5),
(9, '2014-07-11 09:10:04', 12, 1, 5),
(10, '2014-07-12 08:53:36', 20, 3, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grupy_krwi`
--

CREATE TABLE IF NOT EXISTS `grupy_krwi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupa` varchar(4) COLLATE utf8_polish_ci NOT NULL,
  `rh` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `grupy_krwi`
--

INSERT INTO `grupy_krwi` (`id`, `grupa`, `rh`) VALUES
(1, 'A', 1),
(2, 'A', 0),
(3, 'B', 1),
(5, 'B', 0),
(6, 'AB', 1),
(7, 'AB', 0),
(8, '0', 1),
(9, '0', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `typ` int(11) NOT NULL,
  `naglowek` tinyint(1) NOT NULL DEFAULT '1',
  `opcja_id` int(11) DEFAULT NULL,
  `adres` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `etykieta` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `opcja_id` (`opcja_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `typ`, `naglowek`, `opcja_id`, `adres`, `etykieta`) VALUES
(1, 0, 1, 1, NULL, NULL, 'Banki'),
(2, 0, 1, 1, NULL, NULL, 'Donacje'),
(3, 0, 1, 1, NULL, NULL, 'Dawcy'),
(4, 0, 1, 1, NULL, NULL, 'Pracownicy'),
(5, 1, 1, 0, 1, '?org=banki&amp;metoda=dodaj', 'Dodaj bank'),
(6, 1, 1, 0, 2, '?org=banki', 'Lista banków'),
(7, 2, 1, 0, 5, '?org=donacje&amp;metoda=dodaj', 'Dodaj donację'),
(8, 2, 1, 0, 13, '?org=donacje', 'Lista donacji'),
(9, 3, 1, 0, 8, '?org=dawcy&amp;metoda=dodaj', 'Zarejestruj dawcę'),
(10, 3, 1, 0, 9, '?org=dawcy', 'Lista dawców'),
(11, 4, 1, 0, 11, '?org=pracownicy&amp;metoda=dodaj', 'Dodaj pracownika'),
(12, 4, 1, 0, 15, '?org=pracownicy', 'Lista pracowników');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opcje`
--

CREATE TABLE IF NOT EXISTS `opcje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `opcje`
--

INSERT INTO `opcje` (`id`, `nazwa`) VALUES
(1, 'Dodaj bank'),
(2, 'Lista banków'),
(3, 'Edytuj bank'),
(4, 'Usuń bank'),
(5, 'Dodaj donację'),
(6, 'Edytuj donację'),
(7, 'Usuń donację'),
(8, 'Zarejestruj dawcę'),
(9, 'Lista dawców'),
(10, 'Edytuj użytkownika'),
(11, 'Dodaj pracownika'),
(13, 'Lista donacji'),
(14, 'Edytuj profil'),
(15, 'Lista pracowników');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `organy`
--

CREATE TABLE IF NOT EXISTS `organy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `cena` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=21 ;

--
-- Zrzut danych tabeli `organy`
--

INSERT INTO `organy` (`id`, `nazwa`, `cena`) VALUES
(1, 'nerka', 50000),
(2, 'nasienie', 800),
(9, 'mózg', 999),
(12, 'oko zielone prawe', 0),
(13, 'trójka mleczna', 0),
(14, 'ząb mądrości', 0),
(15, 'tłuszcz z pośladków', 0),
(16, 'tłuszcz z brzucha', 0),
(17, 'pępek', 0),
(20, 'pryszcz z czoła', -100);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `panstwa`
--

CREATE TABLE IF NOT EXISTS `panstwa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panstwo` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=14 ;

--
-- Zrzut danych tabeli `panstwa`
--

INSERT INTO `panstwa` (`id`, `panstwo`) VALUES
(1, 'Polska'),
(2, 'Czechy'),
(8, 'Hiszpania'),
(9, 'Litwa'),
(10, 'Francja'),
(11, 'Szwajcaria'),
(12, 'Austria'),
(13, 'Niemcy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`id`, `nazwa`) VALUES
(1, 'dawca'),
(2, 'pracownik'),
(3, 'handlarz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roletoopcje`
--

CREATE TABLE IF NOT EXISTS `roletoopcje` (
  `rola_id` int(11) NOT NULL,
  `opcja_id` int(11) NOT NULL,
  KEY `id_opcji` (`opcja_id`),
  KEY `id_roli` (`rola_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `roletoopcje`
--

INSERT INTO `roletoopcje` (`rola_id`, `opcja_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 13),
(1, 2),
(1, 13),
(1, 14),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 13),
(3, 14);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stanowiska`
--

CREATE TABLE IF NOT EXISTS `stanowiska` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `pensja` int(11) NOT NULL COMMENT 'w zł',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `stanowiska`
--

INSERT INTO `stanowiska` (`id`, `nazwa`, `pensja`) VALUES
(1, 'pomagier', 4000),
(2, 'asystent wodzireja', 1680),
(4, 'dyrektor', 1680),
(5, 'project manager ds. przechowywania narządów', 1680);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `dane_osobowe_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `dane_osobowe_id` (`dane_osobowe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `email`, `haslo`, `dane_osobowe_id`) VALUES
(5, 'k@laudia.pl', '1234', 6),
(6, 'n@owe.org', '1234', 7),
(7, 'adres@adresowy.pl', 'haslo', 8),
(8, 'pawel.marcin.chojnacki@gmail.com', '1234', 9),
(9, 'pa@wel.pl', '1234', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicytorole`
--

CREATE TABLE IF NOT EXISTS `uzytkownicytorole` (
  `uzytkownik_id` int(11) NOT NULL,
  `rola_id` int(11) NOT NULL,
  KEY `id_uzytkownika` (`uzytkownik_id`,`rola_id`),
  KEY `id_roli` (`rola_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicytorole`
--

INSERT INTO `uzytkownicytorole` (`uzytkownik_id`, `rola_id`) VALUES
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicytostanowiska`
--

CREATE TABLE IF NOT EXISTS `uzytkownicytostanowiska` (
  `uzytkownik_id` int(11) NOT NULL,
  `stanowisko_id` int(11) NOT NULL,
  KEY `uzytkownik_id` (`uzytkownik_id`),
  KEY `stanowisko_id` (`stanowisko_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicytostanowiska`
--

INSERT INTO `uzytkownicytostanowiska` (`uzytkownik_id`, `stanowisko_id`) VALUES
(5, 1),
(5, 2);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD CONSTRAINT `adresy_ibfk_1` FOREIGN KEY (`panstwo_id`) REFERENCES `panstwa` (`id`);

--
-- Ograniczenia dla tabeli `banki`
--
ALTER TABLE `banki`
  ADD CONSTRAINT `banki_ibfk_1` FOREIGN KEY (`adres_id`) REFERENCES `adresy` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `dane_osobowe`
--
ALTER TABLE `dane_osobowe`
  ADD CONSTRAINT `dane_osobowe_ibfk_1` FOREIGN KEY (`adres_id`) REFERENCES `adresy` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dane_osobowe_ibfk_2` FOREIGN KEY (`grupa_id`) REFERENCES `grupy_krwi` (`id`),
  ADD CONSTRAINT `dane_osobowe_ibfk_3` FOREIGN KEY (`stanowisko_id`) REFERENCES `stanowiska` (`id`);

--
-- Ograniczenia dla tabeli `donacje`
--
ALTER TABLE `donacje`
  ADD CONSTRAINT `donacje_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `banki` (`id`),
  ADD CONSTRAINT `donacje_ibfk_2` FOREIGN KEY (`organ_id`) REFERENCES `organy` (`id`),
  ADD CONSTRAINT `donacje_ibfk_3` FOREIGN KEY (`dawca_id`) REFERENCES `uzytkownicy` (`id`);

--
-- Ograniczenia dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`opcja_id`) REFERENCES `opcje` (`id`);

--
-- Ograniczenia dla tabeli `roletoopcje`
--
ALTER TABLE `roletoopcje`
  ADD CONSTRAINT `roletoopcje_ibfk_1` FOREIGN KEY (`rola_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `roletoopcje_ibfk_2` FOREIGN KEY (`opcja_id`) REFERENCES `opcje` (`id`);

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`dane_osobowe_id`) REFERENCES `dane_osobowe` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `uzytkownicytorole`
--
ALTER TABLE `uzytkownicytorole`
  ADD CONSTRAINT `uzytkownicytorole_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`),
  ADD CONSTRAINT `uzytkownicytorole_ibfk_2` FOREIGN KEY (`rola_id`) REFERENCES `role` (`id`);

--
-- Ograniczenia dla tabeli `uzytkownicytostanowiska`
--
ALTER TABLE `uzytkownicytostanowiska`
  ADD CONSTRAINT `uzytkownicytostanowiska_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`),
  ADD CONSTRAINT `uzytkownicytostanowiska_ibfk_2` FOREIGN KEY (`stanowisko_id`) REFERENCES `stanowiska` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
