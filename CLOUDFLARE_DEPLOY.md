# CLOUDFLARE CONTAINERS DEPLOYMENT GUIDE

## 🚀 Hızlı Başlangıç

### 1. Gereksinimler
- Node.js 18+
- Docker Desktop (çalışır durumda)
- Cloudflare hesabı
- Cloudflare API Token (✅ Mevcut)

### 2. Token'ı Test Et

```bash
curl "https://api.cloudflare.com/client/v4/accounts/ccf119a16f7abfd37a26efe65e4a1077/tokens/verify" \
-H "Authorization: Bearer DdPnqb5EXwj_lswiuiIPrjWoxbxTu6ppQRXNXqlu"
```

### 3. Kurulum

```bash
# 1. Bağımlılıkları yükle
npm install

# 2. Wrangler'a giriş yap
npx wrangler login

# VEYA API token kullan
export CLOUDFLARE_API_TOKEN=DdPnqb5EXwj_lswiuiIPrjWoxbxTu6ppQRXNXqlu

# 3. Docker'ın çalıştığını kontrol et
docker info

# 4. Deploy et!
npx wrangler deploy
```

### 4. İlk Deploy Sonrası

⏳ **ÖNEMLİ:** İlk deploy'dan sonra Container'ın hazır olması **3-5 dakika** sürer!

Bu süre zarfında:
- Worker çalışır
- Ancak Container'a yapılan istekler hata verir
- Bekleyin ve sonra tekrar deneyin

### 5. Deployment Kontrolü

```bash
# Container'ları listele
npx wrangler containers list

# Container image'larını listele
npx wrangler containers images list

# Logs'ları izle
npx wrangler tail
```

### 6. Siteyi Test Et

```bash
# Worker URL'niz (deploy sonrası gösterilecek)
https://edevlet-aidat.YOUR-SUBDOMAIN.workers.dev
```

---

## 📋 Önemli Notlar

### Veritabanı
Cloudflare Containers localhost MySQL'e bağlanamaz. Şunlardan birini kullanın:

**Seçenek 1: PlanetScale (Önerilen - Ücretsiz)**
```bash
# 1. PlanetScale hesabı oluştur: https://planetscale.com
# 2. Database oluştur
# 3. Connection string'i al
# 4. wrangler.toml'da güncelle
```

**Seçenek 2: Neon (PostgreSQL)**
- https://neon.tech
- Ücretsiz PostgreSQL (PHP kodunu PostgreSQL'e çevirmek gerekir)

**Seçenek 3: Turso (SQLite)**
- https://turso.tech
- Cloudflare ile entegre SQLite

**Seçenek 4: Cloudflare D1**
- Native Cloudflare SQLite
- `wrangler d1 create dayko_aidat`

### Container Boyutu
- Max: 500MB
- Daha hızlı deployment için image'ı optimize edin

### Maliyet
- İlk 100,000 istek/ay: **ÜCRETSIZ**
- Sonrası: $0.30/milyon istek

---

## 🔧 Sorun Giderme

### "Cannot connect to Docker daemon"
```bash
# Docker Desktop'ı başlatın
# Windows: Start → Docker Desktop
# Mac: Applications → Docker
```

### "Container not ready"
- 3-5 dakika bekleyin
- `npx wrangler containers list` ile durumu kontrol edin

### "Database connection failed"
- Cloud MySQL host'unu `wrangler.toml`'da güncelleyin
- Firewall kurallarını kontrol edin

---

## 📊 Alternatifler

Cloudflare Containers karmaşık geliyorsa:

### 1. Render.com (En Kolay)
```bash
# Tek tık deployment
# render.yaml dosyası hazır
```

### 2. Railway.app (Hızlı)
```bash
railway login
railway up
```

### 3. Fly.io (Performanslı)
```bash
fly launch
fly deploy
```

---

## 🎯 Sonraki Adımlar

1. ✅ Docker'ı başlat
2. ✅ `npm install` çalıştır
3. ✅ `npx wrangler deploy` ile deploy et
4. ⏳ 3-5 dakika bekle
5. ✅ Siteyi test et!

**Hadi başlayalım! 🚀**
