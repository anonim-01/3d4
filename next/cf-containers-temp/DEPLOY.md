# DEPLOYMENT GUIDE - Buluta Yayınlama Rehberi

## 🚀 Yöntem 1: Render.com (ÜCRETSİZ + KOLAY)

### Adım 1: Render.com'a Kaydol
1. https://render.com adresine git
2. GitHub hesabınla giriş yap

### Adım 2: MySQL Veritabanı Oluştur
1. Dashboard → New → PostgreSQL/MySQL
2. İsim: `edevlet-db`
3. Ücretsiz planı seç
4. Create Database

### Adım 3: Web Service Oluştur
1. Dashboard → New → Web Service
2. GitHub repo'nu bağla: `Gigeswiki/3d4`
3. Ayarlar:
   - Name: `edevlet-aidat`
   - Environment: Docker
   - Branch: main
   - Instance Type: Free

4. Environment Variables ekle:
   ```
   DB_HOST = [Render'dan aldığınız host]
   DB_USERNAME = dayko_aidat
   DB_PASSWORD = 5Nl?0l9j1
   DB_DATABASE = dayko_aidat
   ```

5. Deploy butonuna tıkla

### ✅ Hazır!
Site URL'niz: `https://edevlet-aidat.onrender.com`

---

## 🚀 Yöntem 2: Railway.app (HIZLI)

### Adım 1: Railway'e Kaydol
1. https://railway.app
2. GitHub ile giriş yap

### Adım 2: Proje Oluştur
```bash
# Terminal'de:
npm install -g @railway/cli
railway login
cd c:\Users\mrtko\OneDrive\Ekler\Belgeler\GitHub\3d4
railway init
railway up
```

### Adım 3: MySQL Ekle
1. Dashboard → New → Database → MySQL
2. Bağlantı bilgilerini al
3. Environment Variables'a ekle

### ✅ Hazır!

---

## 🚀 Yöntem 3: Fly.io (PERFORMANSLI)

### Kurulum:
```bash
# PowerShell'de:
irm https://fly.io/install.ps1 | iex

# Giriş yap
fly auth login

# Uygulama oluştur
cd c:\Users\mrtko\OneDrive\Ekler\Belgeler\GitHub\3d4
fly launch

# Deploy et
fly deploy
```

---

## 🚀 Yöntem 4: Docker ile Lokal Test

```bash
# Docker Desktop'ı yükleyin
# Sonra çalıştırın:

cd c:\Users\mrtko\OneDrive\Ekler\Belgeler\GitHub\3d4
docker-compose up -d

# Test edin:
# http://localhost:8080
```

---

## 🚀 Yöntem 5: Cloudflare Workers (Gelişmiş)

⚠️ **Not:** PHP'yi Workers için Node.js'e çevirmek gerekir

### Seçenek A: PHP Backend Ayrı Yerde
1. Backend'i Render/Railway'de deploy et
2. Frontend'i Cloudflare Pages'e yükle
3. API çağrılarını backend'e yönlendir

### Seçenek B: Tam Node.js'e Çevir
```bash
npm create cloudflare@latest edevlet-workers
cd edevlet-workers
npm install
npm run deploy
```

---

## 📊 Karşılaştırma

| Platform | Ücretsiz | Kolay | Hız | PHP Desteği |
|----------|----------|-------|-----|-------------|
| Render   | ✅       | ⭐⭐⭐  | ⭐⭐  | ✅          |
| Railway  | ✅       | ⭐⭐⭐  | ⭐⭐⭐ | ✅          |
| Fly.io   | ✅       | ⭐⭐   | ⭐⭐⭐ | ✅          |
| Cloudflare| ✅      | ⭐    | ⭐⭐⭐ | ❌ (Workers) |

---

## 🎯 ÖNERİ: RENDER.COM

En kolay ve ücretsiz:
1. https://render.com → Sign Up
2. New → Web Service → Connect GitHub
3. Select repo: `3d4`
4. Environment: Docker
5. Deploy!

**5 dakikada hazır! 🚀**
