<p align="center"><a href="#" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# E-Catalogue

A Laravel-based e-catalogue application for managing products/entries with categories, statuses, and about/mission information.

## 🚀 Fitur Utama

- CRUD katalog (produk/daftar item)
- Kategori katalog
- Status publikasi (aktif/nonaktif)
- Halaman About Us, Sosial Media, dan Visi & Misi
- Autentikasi dasar (jika diaktifkan pada project)

## ✅ Prasyarat

Pastikan di mesin kamu sudah terpasang:

- PHP 8.1+ (atau sesuai requirement Laravel di project ini)
- Composer
- Node.js + npm (atau yarn)
- Database (MySQL/MariaDB/SQLite/Postgres)

---

## ⚙️ Cara Konfigurasi (Setup)

1. **Clone repository**

```bash
git clone <repo-url>
cd e-catalogue
```

2. **Install dependensi PHP**

```bash
composer install
```

3. **Install dependensi frontend**

```bash
npm install
```

4. **Siapkan file environment**

```bash
cp .env.example .env
```

5. **Generate app key**

```bash
php artisan key:generate
```

6. **Konfigurasi database di `.env`**

Contoh konfigurasi MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=nama_user
DB_PASSWORD=password
```

7. **(Opsional) Buat symbolic link storage**

```bash
php artisan storage:link
```

---

## 🗄️ Migrasi & Seed Data

1. **Jalankan migrasi**

```bash
php artisan migrate
```

2. **(Opsional) Jalankan seeder**

```bash
php artisan db:seed
```

---

## ▶️ Menjalankan Aplikasi

### 1) Jalankan server Laravel

```bash
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

### 2) Jalankan build frontend (Vite)

- Mode development (watch):

```bash
npm run dev
```

- Mode production (build):

```bash
npm run build
```

---

## 🔍 Struktur Folder Penting

- `app/` - Laravel backend (Controllers, Models, dll)
- `database/migrations/` - Schema database
- `database/seeders/` - Seed data
- `resources/views/` - Blade templates
- `routes/web.php` - Web routes
- `public/` - Entry point web + asset hasil build

---

## 🧪 Testing (jika tersedia)

Jika project menggunakan PHPUnit/Pest:

```bash
php artisan test
```

---

## 📌 Catatan Tambahan

- Jika kamu menambahkan relasi baru atau field di model, jalankan migrasi ulang dengan:
  ```bash
  php artisan migrate:fresh --seed
  ```

- Pastikan `APP_ENV` di `.env` sudah disesuaikan (local/production) untuk menyalakan/menonaktifkan debugging.

---

## 📄 Lisensi

Project ini mengikuti lisensi MIT (lihat `LICENSE` jika tersedia).
