# portfolio-html

Portofolio **Muhamad Ihsan Kurniawan** — menampilkan identitas sebagai **Career Switcher**
menuju **Backend & Infrastructure Engineer**, dengan **sistem backend sendiri** (PHP murni,
tanpa framework) agar konten bisa di-update lewat panel admin **tanpa bongkar kode**.

Di-deploy via **CI/CD GitHub Actions** ke server homelab dengan stack Docker
(php-fpm + Nginx + MySQL), pola yang sama seperti proyek webrent.

## Fitur

- **Admin panel** (`/admin/login`) — login session, CSRF, hash password
  - CRUD **Proyek** (gambar, featured, aktif, urutan)
  - CRUD **Sertifikat pelatihan** (gambar, penerbit, tahun, link kredensial)
  - CRUD **Skills** (kelompok Backend / Infrastructure / Networking / DevOps)
  - **Profil & pengaturan situs** (nama, tagline, tentang, kontak, sosial)
  - **Roadmap Project Ascend** (tandai selesai, tambah/hapus item, progress otomatis)
  - **Pesan kontak** (lihat, tandai dibaca, hapus)
  - **Ubah password admin**
- **Halaman publik** (render dari database) — Beranda, Proyek, Detail Proyek, Sertifikat, Kontak
- **Form kontak** tersimpan ke database
- **Upload gambar** divalidasi (tipe & ukuran), disimpan di volume bersama

## Stack

| Lapisan | Teknologi |
|---|---|
| Frontend | HTML, CSS, JavaScript (vanilla) — tema infra/terminal gelap |
| Backend | PHP 8.3 murni (custom mini-framework: Router, PDO, Auth, Validator, CSRF) |
| Database | MySQL 8 (container) |
| Server | Nginx (proxy fastcgi) + php-fpm |
| Deployment | Docker Compose + GitHub Actions (self-hosted runner) |

## Struktur Repo

```
├── public/                     # document root (satu-satunya yang bisa diakses web)
│   ├── index.php               # front controller (routing)
│   ├── css/ js/ uploads/
├── app/
│   ├── core/                   # Database, Router, Controller, View, Auth, Csrf, Validator, Upload, Model
│   ├── config/                 # config.php (env) + routes.php
│   ├── controllers/            # publik + admin
│   ├── models/
│   └── views/                  # layouts, pages, admin
├── database/
│   ├── schema.sql              # CREATE TABLE IF NOT EXISTS
│   └── seed.sql                # data awal (admin, settings, proyek, skill, roadmap)
├── migrate.php                 # CLI migrasi + seed (idempotent, dijalankan saat deploy)
├── docker/
│   ├── docker-compose.prod.yml # app + web + db + volumes
│   └── nginx/default.conf
├── Dockerfile                  # php:8.3-fpm-alpine + pdo_mysql
├── .github/workflows/          # ci.yml, deploy-prod.yml, rollback.yml
└── scripts/                    # setup-server.sh, migrate.sh
```

## Menjalankan Lokal

```bash
# siapkan .env (contoh)
cat > .env << 'EOF'
PORT=8080
DB_NAME=portfolio_db
DB_USER=portfolio
DB_PASS=localpass123
DB_ROOT_PASS=rootpass123
BASE_URL=http://localhost:8080
APP_DEBUG=true
ADMIN_USERNAME=admin
ADMIN_PASSWORD=admin123
EOF

docker compose --env-file .env -f docker/docker-compose.prod.yml up -d --build
docker compose --env-file .env -f docker/docker-compose.prod.yml exec -T app php migrate.php

# akses
#   website  : http://localhost:8080
#   admin    : http://localhost:8080/admin/login   (admin / admin123)
```

> Port 8080 dipilih karena port 80 sudah dipakai stack webrent di server yang sama.

## Setup Server (sekali saja)

Jalankan di server homelab (akun dengan akses sudo):

```bash
sudo bash scripts/setup-server.sh --token <RUNNER_TOKEN>
```

- `<RUNNER_TOKEN>` dari repo → **Settings → Actions → Runners → New self-hosted runner**
- Menginstal **runner khusus portofolio** (label `portfolio`, terpisah dari webrent) sebagai service,
  menyiapkan `/opt/portfolio/prod` + `.env` (PORT, kredensial DB & admin digenerate acak)
- **Sebelum deploy pertama:** sesuaikan `BASE_URL` di `/opt/portfolio/prod/.env` dengan IP server
- Buka firewall: `sudo ufw allow 8080/tcp`

## Alur CI/CD

| Workflow | Trigger | Runner | Aksi |
|---|---|---|---|
| `ci.yml` | push/PR ke `main` | `ubuntu-latest` | lint PHP semua file, cek struktur, syntax JS, validasi compose |
| `deploy-prod.yml` | push ke `main` | `[self-hosted, portfolio]` | rsync → `/opt/portfolio/prod` → build & up → migrate → health check `:8080` |
| `rollback.yml` | manual (Actions) | `[self-hosted, portfolio]` | Rollback ke image tag sebelumnya / yang ditentukan |

Deploy di-log ke `.deploy-history` (tag = commit SHA) untuk mendukung rollback.

## Keamanan

- Semua query memakai **PDO prepared statement**
- Semua output di-**escape** (`htmlspecialchars`)
- Semua form memakai **CSRF token**
- Upload divalidasi MIME + ukuran, nama file acak
- File sensitif (`app/`, `database/`, `*.sql`, `*.env`) **ditolak** oleh Nginx
- Password admin di-hash (`password_hash`) & bisa diganti dari panel admin

## Roadmap Berikutnya (Project Ascend)

1. ✅ Portfolio HTML statis + CI/CD
2. ✅ Portfolio dengan backend PHP murni + admin panel (repo ini)
3. ⬜ Porting ke **CodeIgniter 4** (styling migrasi ke Tailwind)
4. ⬜ Portfolio **Laravel**
5. ⬜ Production Homelab & Cloud Deployment