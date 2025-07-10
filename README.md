# 🛒 E-Procurement API – Technical Assessment

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Sanctum](https://img.shields.io/badge/Laravel%20Sanctum-000000?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/docs/sanctum)

**E-Procurement API** adalah RESTful API berbasis Laravel yang dibangun untuk keperluan **technical test**. Sistem ini menyediakan autentikasi pengguna, registrasi vendor, serta manajemen katalog produk berdasarkan vendor yang dimiliki user.

---

## 🎯 Objective

Menguji kemampuan dalam:

- Membangun struktur REST API dasar
- Mengimplementasikan Laravel Sanctum untuk autentikasi
- Mendesain relasi data user ↔ vendor ↔ produk
- Mengelola data menggunakan Laravel Resourceful Routing & Controller

---

## 🛠️ Tech Stack

| Komponen       | Teknologi            |
|----------------|----------------------|
| Framework      | Laravel 12.x         |
| Autentikasi    | Laravel Sanctum 🔐    |
| Database       | MySQL / MariaDB      |
| Format Data    | JSON                 |
| Middleware     | `auth:sanctum`       |

---

## 🚀 Instalasi & Menjalankan

```bash
# 1. Clone repositori
git clone https://github.com/Syechan112/vendor-procurement-system
cd vendor-procurement-system

# 2. Install dependency
composer install

# 3. Salin file .env dan generate app key
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di file .env
# DB_DATABASE=...
# DB_USERNAME=...
# DB_PASSWORD=...

# 5. Migrasi database
php artisan migrate

# 7. Jalankan server
php artisan serve
