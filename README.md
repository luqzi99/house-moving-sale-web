# 🏠 Moving Out Sale

A simple house clearance sale web app built for sharing within a community. The owner manages items via a private admin panel; the public sees a marketplace-style listing and can contact via WhatsApp directly.

**Live:** [house-clearance-sale.luqmanhakimrohaizi.my](https://house-clearance-sale.luqmanhakimrohaizi.my)

---

## Features

**Public marketplace**
- Browse items by category (Perabot, Elektronik, Dapur, Lain-lain)
- Search by name or description
- Tap any card to open a detail modal with full description and image carousel
- WhatsApp button pre-fills the message with item name and price
- Open Graph meta tags — shareable link shows preview on WhatsApp/Telegram

**Admin panel** (`/admin`)
- Secure login (single admin account from `.env`)
- Full CRUD for items — name, description, price/free, category, condition, emoji, status
- Multi-image upload, auto-resized to max 1200px and stored on Cloudflare R2
- Delete individual images or all at once with SweetAlert2 confirmation
- Manual sort order to control listing sequence

---

## Stack

| Layer | Tech |
|-------|------|
| Backend | Laravel 11 (PHP 8.3) |
| Frontend | Blade + Tailwind CDN (no build step) |
| Database | MySQL 8 |
| Storage | Cloudflare R2 (S3-compatible) |
| Container | Docker Compose |
| Web server | nginx + PHP-FPM via supervisord |

---

## Local Development

**Requirements:** Docker + Docker Compose

```bash
# 1. Clone and enter project
git clone <repo-url> house-clearance-sale
cd house-clearance-sale

# 2. Copy env and fill in values
cp .env.example .env
# Edit .env — set ADMIN_EMAIL, ADMIN_PASSWORD, WHATSAPP_NUMBER, R2_* keys

# 3. Start all services (app + MySQL + phpMyAdmin)
docker compose -f docker-compose.local.yml up -d --build

# 4. Run migrations and seed admin user
docker compose -f docker-compose.local.yml exec app php artisan migrate --seed
```

| URL | What |
|-----|------|
| `http://localhost:8000` | Public marketplace |
| `http://localhost:8000/admin/login` | Admin panel |
| `http://localhost:8080` | phpMyAdmin |

After first setup, just `docker compose -f docker-compose.local.yml up -d` to start.

---

## Environment Variables

```env
APP_NAME="Moving Out Sale"
APP_URL=https://house-clearance-sale.luqmanhakimrohaizi.my

DB_HOST=house-clearance-mysql
DB_DATABASE=house_clearance
DB_USERNAME=hcsale
DB_PASSWORD=
DB_ROOT_PASSWORD=

ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=

WHATSAPP_NUMBER=601116185660   # country code, no +

R2_ACCESS_KEY_ID=
R2_SECRET_ACCESS_KEY=
R2_BUCKET=
R2_ENDPOINT=https://<account-id>.r2.cloudflarestorage.com
R2_PUBLIC_URL=https://pub-xxxx.r2.dev
```

---

## VPS Deploy

The app runs as a Docker Compose stack on `/srv/house-clearance-sale`, fronted by a shared nginx gateway.

```bash
# One-time setup on VPS
cd /srv
git clone <repo-url> house-clearance-sale
cd house-clearance-sale
cp .env.example .env        # fill in production secrets
docker compose up -d --build
docker exec house-clearance-app php artisan key:generate
docker exec house-clearance-app php artisan migrate --seed

# Drop nginx config and reload gateway
cp nginx/conf.d/*.conf /srv/nginx/conf.d/
docker exec nginx-gateway nginx -s reload
```

**Subsequent deploys:**
```bash
bash deploy.sh
```

---

## Project Structure

```
.
├── app/Http/Controllers/
│   ├── Admin/AuthController.php    # login / logout
│   ├── Admin/ItemController.php    # CRUD + R2 upload
│   └── PublicController.php        # marketplace index
├── app/Models/Item.php
├── resources/views/
│   ├── admin/                      # login, items CRUD
│   ├── layouts/                    # admin + public layouts
│   └── public/index.blade.php      # marketplace + modal + carousel
├── docker/
│   ├── nginx.conf
│   ├── php.ini
│   └── supervisord.conf
├── nginx/conf.d/                   # gateway nginx config
├── docker-compose.yml              # VPS (external web network)
├── docker-compose.local.yml        # local dev (phpMyAdmin included)
└── deploy.sh
```

---

Built by [luqmanhakimrohaizi.my](https://luqmanhakimrohaizi.my)
