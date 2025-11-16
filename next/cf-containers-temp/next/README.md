# E-Devlet Aidat Sistemi

## 📦 Hızlı Kurulum

### 1. Veritabanı Kurulumu

**phpMyAdmin ile:**
1. http://localhost/phpmyadmin adresini açın
2. "Import" sekmesine gidin
3. `edevletaidat.sql` dosyasını seçin
4. "Go" butonuna tıklayın

**Komut satırı ile:**
```bash
mysql -u root -p < edevletaidat.sql
```

### 2. Veritabanı Bilgileri

```
Host: localhost
Port: 3306
Kullanıcı: dayko_aidat
Şifre: 5Nl?0l9j1
Veritabanı: dayko_aidat
```

### 3. Siteyi Başlat

Tarayıcıda açın:
```
http://localhost/3d4/index.php
```

### 4. Admin Panel

```
Şifre: admin123
```

## 🔧 Connection String

Eğer bağlantı hatası alırsanız:

**mysql.php** dosyasında:
```php
$host = 'localhost';        // veya 127.0.0.1
$kullanici = 'dayko_aidat';
$sifre = '5Nl?0l9j1';
$db_isim = 'dayko_aidat';
```

**.env** dosyasında:
```
DB_HOST=localhost
DB_USERNAME=dayko_aidat
DB_PASSWORD=5Nl?0l9j1
DB_DATABASE=dayko_aidat
```

## ⚠️ Sorun Giderme

### "Can't connect to MySQL server"
MySQL servisini başlatın:
- XAMPP: Control Panel → MySQL → Start
- WAMP: Tray icon → MySQL → Start

### "Access denied"
Kullanıcı adı ve şifreyi kontrol edin:
```sql
CREATE USER 'dayko_aidat'@'localhost' IDENTIFIED BY '5Nl?0l9j1';
GRANT ALL PRIVILEGES ON dayko_aidat.* TO 'dayko_aidat'@'localhost';
FLUSH PRIVILEGES;
```

## 📂 Dosya Yapısı

```
3d4/
├── index.php           # Ana sayfa
├── mysql.php           # Veritabanı bağlantısı
├── edevletaidat.sql    # Veritabanı kurulum dosyası
├── .env                # Yapılandırma
└── admin/              # Admin panel
```

## 🚀 Canlıya Alma

Bulut sunucuya yüklemek için `.env` dosyasını düzenleyin:
```
DB_HOST=your-server-ip
DB_USERNAME=dayko_aidat
DB_PASSWORD=5Nl?0l9j1
DB_DATABASE=dayko_aidat
```

## ✅ Hazır!

Artık sistem kullanıma hazır.
