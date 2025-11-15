<?php
ob_start();
@session_start();
error_reporting(0);

// Veritabanı Bağlantı Ayarları
$host = 'localhost';           // Sunucu adresi
$port = 3306;                  // MySQL/MariaDB portu
$kullanici = 'dayko_aidat';    // Veritabanı kullanıcı adı
$sifre = '5Nl?0l9j1';          // Veritabanı şifresi
$db_isim = 'dayko_aidat';      // Veritabanı adı
$socket = null;                // Unix socket yolu (null = TCP kullan)

// Alternatif Bağlantı Ayarları (gerekirse aktif edin)
// $host = '127.0.0.1';        // Unix socket yerine TCP kullan
// $socket = '/var/run/mysqld/mysqld.sock';  // Unix socket yolu
// $socket = '/tmp/mysql.sock';              // macOS için

// Connection String ile bağlantı oluştur
$conn = new MySQLi($host, $kullanici, $sifre, $db_isim, $port, $socket);

// Karakter seti ayarla
mysqli_set_charset($conn, "utf8");

// Bağlantı kontrolü
if ($conn->connect_error) {
    // Detaylı hata mesajı
    error_log("MySQL Bağlantı Hatası: " . $conn->connect_error);
    error_log("Bağlantı Bilgileri: Host=$host, Port=$port, User=$kullanici, DB=$db_isim");
    
    die('Veritabanı Bağlantısı Hatası: ' . $conn->connect_errno . ' - ' . $conn->connect_error);
}

// Session'a kaydet
$_SESSION["mysqli"] = $conn;
$_SESSION["query"] = null;