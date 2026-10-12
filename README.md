# Tugas Rutin 11 — E-Commerce DB + Secure Auth

**Nama:** Arrifan Ryansyah
**NIM:** 4253250019
**Mata Kuliah:** Pemrograman Web — Pertemuan 11
**Framework:** Laravel + Breeze (Blade) + MySQL

## Deskripsi
Aplikasi e-commerce sederhana dengan database 7 tabel, relasi Eloquent, seeder 54 produk realistis, autentikasi Laravel Breeze, sistem multi-role (admin / editor / user), custom middleware, dan Policy untuk otorisasi edit/hapus produk.

## Struktur Database (7 tabel)
`categories`, `brands`, `products`, `orders`, `order_items`, `reviews`, `cart_items`, serta tabel `users` yang diberi kolom `role`. Semua relasi memakai foreign key constraint.

## Cara Menjalankan
```bash
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
# buat database `ecommerce_p11` di MySQL, lalu atur DB_DATABASE di .env
php artisan migrate:fresh --seed
php artisan serve
```
Buka `http://127.0.0.1:8000`.

## Akun Uji
Password semua akun: `password`

| Email | Role | Hak Akses |
|---|---|---|
| admin@example.com | admin | Kelola semua produk, akses `/admin` |
| editor@example.com | editor | Tambah produk, edit/hapus hanya produk miliknya |
| user@example.com | user | Hanya melihat daftar produk |

## Fitur per Bagian Tugas

### Bagian A — Database & Eloquent
1. **Migrations** 7 tabel e-commerce + FK constraint (`database/migrations`)
2. **Seeder + Factory** 54 produk realistis (`database/seeders`, `database/factories`)
3. **Model + Relationships + Scope** (`app/Models`), scope `active()` dan `cheaperThan()` pada `Product`
4. **5 Query Tinker** (dokumentasi: `docs/A4_tinker_queries.md`)

### Bagian B — Auth & Security
5. **Laravel Breeze** (login, register, logout)
6. **Multi-role + Custom Middleware** (`app/Http/Middleware/RoleMiddleware.php`), dipakai sebagai `role:admin,editor`
7. **Policy** otorisasi edit/hapus (`app/Policies/ProductPolicy.php`)
8. **Route Protection** (`routes/web.php`) dan pengujian dua role di incognito

### Bonus
- Demo eager loading vs N+1 (21 query menjadi 2 query)

## Bukti Pengujian
Screenshot hasil pengujian ada di file terpisah: **[BUKTI-PENGUJIAN.md](BUKTI-PENGUJIAN.md)**

## Catatan
Objek yang dilindungi policy adalah `Product`, sehingga policy dinamai `ProductPolicy` (setara PostPolicy pada materi).
