# E-DEVLET AİDAT SİSTEMİ - KURULUM REHBERİ

## 📋 Gereksinimler

- PHP 7.4+ veya 8.x
- MySQL 5.7+ veya MariaDB 10.4+
- Apache/Nginx web sunucusu
- XAMPP/WAMP/MAMP (localhost için)

## 🚀 Kurulum Yöntemleri

### Yöntem 1: Otomatik Kurulum (Önerilen)

```bash
# Komut satırında çalıştırın:
php setup.php
```

Script sizden şunları soracak:
- MySQL host adresi (varsayılan: 127.0.0.1)
- MySQL port (varsayılan: 3306)
- Root kullanıcı adı (varsayılan: root)
- Root şifresi

### Yöntem 2: Manuel Kurulum (phpMyAdmin)

1. **XAMPP/WAMP'ı başlatın**
   - MySQL servisini başlatın
   - phpMyAdmin'i açın (http://localhost/phpmyadmin)

2. **SQL dosyasını import edin**
   - `quick_install.sql` dosyasını açın
   - Import → Dosya seç → `quick_install.sql` → Go

3. **Yapılandırma dosyasını düzenleyin**
   - `.env.example` dosyasını `.env` olarak kopyalayın
   - Veritabanı bilgilerini girin:
     ```
     DB_HOST=127.0.0.1
     DB_USERNAME=root
     DB_PASSWORD=
     DB_DATABASE=edevletaidat
     ```

4. **Tarayıcıdan test edin**
   ```
   http://localhost/3d4/index.php
   ```

### Yöntem 3: Komut Satırı Kurulumu

```bash
# MySQL'e giriş yapın
mysql -u root -p

# SQL dosyasını çalıştırın
source quick_install.sql

# veya
mysql -u root -p < quick_install.sql
```

## 🔧 Veritabanı Bağlantı Ayarları

### Localhost (XAMPP/WAMP)
```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=edevletaidat
```

### Linux/Ubuntu
```env
DB_HOST=localhost
DB_PORT=3306
DB_USERNAME=edevlet_user
DB_PASSWORD=eDevlet2025!Secure
DB_DATABASE=edevletaidat
DB_SOCKET=/var/run/mysqld/mysqld.sock
```

### Shared Hosting (cPanel)
```env
DB_HOST=localhost
DB_PORT=3306
DB_USERNAME=cpanel_user
DB_PASSWORD=cpanel_password
DB_DATABASE=cpanel_user_edevletaidat
```

### Cloud/VPS
```env
DB_HOST=your-server-ip
DB_PORT=3306
DB_USERNAME=edevlet_user
DB_PASSWORD=your_strong_password
DB_DATABASE=edevletaidat
```

## 📁 Dosya Yapısı

```
3d4/
├── index.php              # Ana sayfa
├── mysql.php              # Veritabanı bağlantısı
├── database.php           # Gelişmiş DB yöneticisi
├── .env                   # Yapılandırma (oluşturulacak)
├── .env.example           # Yapılandırma şablonu
├── setup.php              # Otomatik kurulum
├── install.sql            # Tam kurulum SQL
├── quick_install.sql      # Hızlı kurulum SQL
├── edevletaidat.sql       # Orijinal SQL
└── README_KURULUM.md      # Bu dosya
```

## 🐛 Sorun Giderme

### "Error: connect ENOENT /var/run/mysqld/mysqld.sock"

**Çözüm 1:** Host adresini değiştirin
```env
DB_HOST=127.0.0.1  # localhost yerine
```

**Çözüm 2:** Socket yolunu belirtin
```env
DB_SOCKET=/var/run/mysqld/mysqld.sock
```

### "Access denied for user"

**Çözüm:** Kullanıcı adı/şifre kontrol edin
```bash
# MySQL'e root olarak giriş yapın
mysql -u root -p

# Yeni kullanıcı oluşturun
CREATE USER 'edevlet_user'@'localhost' IDENTIFIED BY 'eDevlet2025!Secure';
GRANT ALL PRIVILEGES ON edevletaidat.* TO 'edevlet_user'@'localhost';
FLUSH PRIVILEGES;
```

### "Unknown database 'edevletaidat'"

**Çözüm:** Veritabanını manuel oluşturun
```sql
CREATE DATABASE edevletaidat CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci;
```

### "Can't connect to MySQL server"

**Çözüm:** MySQL servisini başlatın

**Windows (XAMPP):**
```bash
C:\xampp\mysql_start.bat
```

**Linux:**
```bash
sudo systemctl start mysql
sudo systemctl start mariadb
```

**macOS:**
```bash
brew services start mysql
```

## ✅ Kurulum Kontrolü

Tarayıcıda test edin:
```
http://localhost/3d4/index.php
```

Bağlantı string'ini kontrol edin:
```
http://localhost/3d4/index.php?debug=connection
```

## 🔐 Güvenlik

1. **Varsayılan şifreleri değiştirin**
   - Admin panel şifresi: `admin123` → Güçlü bir şifre
   - Veritabanı şifresi: Güçlü bir şifre belirleyin

2. **Dosya izinlerini ayarlayın**
   ```bash
   chmod 600 .env
   chmod 644 *.php
   ```

3. **Production'da debug modunu kapatın**
   ```env
   APP_DEBUG=false
   APP_ENV=production
   ```

## 📞 Destek

Sorun yaşıyorsanız:
1. `logs/database_errors.log` dosyasını kontrol edin
2. PHP error loglarını kontrol edin
3. MySQL/MariaDB loglarını kontrol edin

## 🎉 Başarıyla Kuruldu!

Artık sistemi kullanabilirsiniz:
- **Ana Sayfa:** http://localhost/3d4/index.php
- **Admin Panel:** http://localhost/3d4/admin/
- **Admin Şifre:** admin123 (değiştirin!)
