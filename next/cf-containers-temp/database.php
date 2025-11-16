<?php
/**
 * Gelişmiş Veritabanı Bağlantı Yöneticisi
 * 
 * Connection String Formatları:
 * - TCP: mysqli://username:password@host:port/database
 * - Socket: mysqli://username:password@localhost/database?socket=/path/to/socket
 */

class DatabaseConnection {
    
    private static $instance = null;
    private $connection = null;
    private $config = [];
    
    /**
     * Singleton pattern
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        $this->loadConfig();
        $this->connect();
    }
    
    /**
     * Yapılandırmayı yükle
     */
    private function loadConfig() {
        // .env dosyası varsa onu kullan
        if (file_exists(__DIR__ . '/.env')) {
            $this->loadEnvFile();
        } else {
            // Varsayılan ayarlar
            $this->config = [
                'host'     => 'localhost',
                'port'     => 3306,
                'username' => 'dayko_aidat',
                'password' => '5Nl?0l9j1',
                'database' => 'dayko_aidat',
                'charset'  => 'utf8mb4',
                'socket'   => null
            ];
        }
    }
    
    /**
     * .env dosyasını yükle
     */
    private function loadEnvFile() {
        $envFile = file_get_contents(__DIR__ . '/.env');
        $lines = explode("\n", $envFile);
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }
            
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            switch ($key) {
                case 'DB_HOST':
                    $this->config['host'] = $value;
                    break;
                case 'DB_PORT':
                    $this->config['port'] = (int)$value;
                    break;
                case 'DB_USERNAME':
                    $this->config['username'] = $value;
                    break;
                case 'DB_PASSWORD':
                    $this->config['password'] = $value;
                    break;
                case 'DB_DATABASE':
                    $this->config['database'] = $value;
                    break;
                case 'DB_CHARSET':
                    $this->config['charset'] = $value;
                    break;
                case 'DB_SOCKET':
                    $this->config['socket'] = !empty($value) ? $value : null;
                    break;
            }
        }
    }
    
    /**
     * Veritabanına bağlan
     */
    private function connect() {
        $host = $this->config['host'];
        $port = $this->config['port'];
        $username = $this->config['username'];
        $password = $this->config['password'];
        $database = $this->config['database'];
        $socket = $this->config['socket'];
        
        // Bağlantı denemesi
        try {
            // Önce socket ile dene
            if (!empty($socket) && file_exists($socket)) {
                $this->connection = @new MySQLi(
                    $host,
                    $username,
                    $password,
                    $database,
                    null,
                    $socket
                );
            }
            
            // Socket başarısız olduysa TCP ile dene
            if ($this->connection === null || $this->connection->connect_error) {
                // localhost yerine 127.0.0.1 kullan (Windows için)
                if ($host === 'localhost') {
                    $host = '127.0.0.1';
                }
                
                $this->connection = @new MySQLi(
                    $host,
                    $username,
                    $password,
                    $database,
                    $port
                );
            }
            
            // Hala bağlantı kurulamadıysa hata ver
            if ($this->connection->connect_error) {
                throw new Exception($this->connection->connect_error);
            }
            
            // Karakter seti ayarla
            $charset = $this->config['charset'] ?? 'utf8mb4';
            $this->connection->set_charset($charset);
            
            // Timezone ayarla
            $this->connection->query("SET time_zone = '+03:00'");
            
        } catch (Exception $e) {
            $this->logError($e->getMessage());
            die($this->getErrorMessage());
        }
    }
    
    /**
     * Bağlantıyı al
     */
    public function getConnection() {
        return $this->connection;
    }
    
    /**
     * Connection String bilgisini al
     */
    public function getConnectionString() {
        $host = $this->config['host'];
        $port = $this->config['port'];
        $database = $this->config['database'];
        $socket = $this->config['socket'];
        
        if (!empty($socket)) {
            return "mysqli://****:****@{$host}/{$database}?socket={$socket}";
        } else {
            return "mysqli://****:****@{$host}:{$port}/{$database}";
        }
    }
    
    /**
     * Bağlantı durumunu kontrol et
     */
    public function ping() {
        if ($this->connection === null) {
            return false;
        }
        return $this->connection->ping();
    }
    
    /**
     * Hata mesajını logla
     */
    private function logError($error) {
        $logFile = __DIR__ . '/logs/database_errors.log';
        $logDir = dirname($logFile);
        
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }
        
        $timestamp = date('Y-m-d H:i:s');
        $message = "[{$timestamp}] {$error}\n";
        $message .= "Config: " . json_encode($this->getSafeConfig()) . "\n";
        $message .= "Connection String: " . $this->getConnectionString() . "\n\n";
        
        @file_put_contents($logFile, $message, FILE_APPEND);
    }
    
    /**
     * Güvenli config bilgisi al (şifresiz)
     */
    private function getSafeConfig() {
        $safe = $this->config;
        $safe['password'] = '****';
        return $safe;
    }
    
    /**
     * Kullanıcı dostu hata mesajı
     */
    private function getErrorMessage() {
        $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Veritabanı Bağlantı Hatası</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 50px; background: #f5f5f5; }
        .error-box { background: white; padding: 30px; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #d32f2f; margin-top: 0; }
        .info { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .code { background: #263238; color: #aed581; padding: 15px; border-radius: 5px; font-family: monospace; overflow-x: auto; }
        ul { line-height: 1.8; }
    </style>
</head>
<body>
    <div class="error-box">
        <h1>⚠️ Veritabanı Bağlantı Hatası</h1>
        <p>Veritabanı bağlantısı kurulamadı. Lütfen aşağıdaki adımları kontrol edin:</p>
        
        <div class="info">
            <strong>📋 Mevcut Connection String:</strong><br>
            <code>' . $this->getConnectionString() . '</code>
        </div>
        
        <h3>✅ Kontrol Listesi:</h3>
        <ul>
            <li>MySQL/MariaDB servisi çalışıyor mu?</li>
            <li>Kullanıcı adı ve şifre doğru mu?</li>
            <li>Veritabanı oluşturuldu mu?</li>
            <li>Host adresi doğru mu? (localhost, 127.0.0.1, IP)</li>
            <li>Port numarası doğru mu? (varsayılan: 3306)</li>
            <li>Firewall bağlantıyı engelliyor mu?</li>
        </ul>
        
        <h3>🔧 Düzeltme Adımları:</h3>
        
        <h4>1. MySQL Servisini Başlat:</h4>
        <div class="code">
# Windows (XAMPP):<br>
C:\\xampp\\mysql_start.bat<br><br>
# Linux:<br>
sudo systemctl start mysql<br>
sudo systemctl start mariadb<br><br>
# macOS:<br>
brew services start mysql
        </div>
        
        <h4>2. Bağlantı Ayarlarını Düzenle:</h4>
        <p><code>mysql.php</code> veya <code>.env</code> dosyasını düzenleyin.</p>
        
        <h4>3. Veritabanını Oluştur:</h4>
        <div class="code">
mysql -u root -p<br>
CREATE DATABASE ' . $this->config['database'] . ';<br>
GRANT ALL ON ' . $this->config['database'] . '.* TO \'' . $this->config['username'] . '\'@\'localhost\';<br>
FLUSH PRIVILEGES;
        </div>
    </div>
</body>
</html>';
        
        return $html;
    }
}

// Kullanım için yardımcı fonksiyon
function getDbConnection() {
    return DatabaseConnection::getInstance()->getConnection();
}

// Session başlat
ob_start();
@session_start();
error_reporting(0);

// Bağlantıyı oluştur ve session'a kaydet
$db = DatabaseConnection::getInstance();
$_SESSION["mysqli"] = $db->getConnection();
$_SESSION["query"] = null;

// Debug için connection string'i göster (production'da kaldırın)
if (isset($_GET['debug']) && $_GET['debug'] === 'connection') {
    echo "<pre>";
    echo "Connection String: " . $db->getConnectionString() . "\n";
    echo "Ping Test: " . ($db->ping() ? "✓ Başarılı" : "✗ Başarısız") . "\n";
    echo "</pre>";
    exit;
}
