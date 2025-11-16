<?php
/**
 * Veritabanı Yapılandırma Dosyası
 * 
 * Bu dosyayı config.php olarak kopyalayıp kendi ayarlarınızı girin
 */

return [
    // Veritabanı Bağlantı Ayarları
    'database' => [
        // Temel Ayarlar
        'host'     => 'localhost',      // Sunucu adresi
        'port'     => 3306,             // Port numarası
        'username' => 'kullanici_adi',  // Kullanıcı adı
        'password' => 'sifre',          // Şifre
        'database' => 'veritabani_adi', // Veritabanı adı
        'charset'  => 'utf8mb4',        // Karakter seti
        'socket'   => null,             // Unix socket (null = TCP kullan)
        
        // Connection String Örnekleri:
        // Localhost TCP: host=localhost;port=3306
        // IP ile: host=192.168.1.100;port=3306
        // Unix Socket: host=localhost;unix_socket=/var/run/mysqld/mysqld.sock
        // Cloud (Render): host=xxxxx.proxy.rlwy.net;port=3306
    ],
    
    // Alternatif Bağlantı Ayarları (Farklı Ortamlar İçin)
    'environments' => [
        'localhost' => [
            'host'     => 'localhost',
            'port'     => 3306,
            'username' => 'root',
            'password' => '',
            'database' => 'edevletaidat',
            'socket'   => null,
        ],
        'xampp' => [
            'host'     => '127.0.0.1',
            'port'     => 3306,
            'username' => 'root',
            'password' => '',
            'database' => 'edevletaidat',
            'socket'   => null,
        ],
        'wamp' => [
            'host'     => '127.0.0.1',
            'port'     => 3306,
            'username' => 'root',
            'password' => '',
            'database' => 'edevletaidat',
            'socket'   => null,
        ],
        'linux' => [
            'host'     => 'localhost',
            'port'     => 3306,
            'username' => 'dayko_aidat',
            'password' => '5Nl?0l9j1',
            'database' => 'dayko_aidat',
            'socket'   => '/var/run/mysqld/mysqld.sock',
        ],
        'docker' => [
            'host'     => 'mysql',  // Docker container adı
            'port'     => 3306,
            'username' => 'root',
            'password' => '5Nl?0l9j1',
            'database' => 'edevletaidat',
            'socket'   => null,
        ],
        'shared_hosting' => [
            'host'     => 'localhost',
            'port'     => 3306,
            'username' => 'cpanel_user',
            'password' => '5Nl?0l9j1',
            'database' => 'cpanel_dbname',
            'socket'   => null,
        ],
        'cloud' => [
            'host'     => 'your-db-host.cloud.com',
            'port'     => 3306,
            'username' => 'cloud_user',
            'password' => 'cloud_password',
            'database' => 'cloud_database',
            'socket'   => null,
        ],
    ],
    
    // Aktif Ortam (yukarıdaki environments'tan birini seçin)
    'active_environment' => 'localhost',
    
    // Hata Ayıklama
    'debug' => true,
    'log_errors' => true,
];
