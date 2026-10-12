# Tugas Rutin 11 — E-Commerce DB + Secure Auth (Laravel + Breeze)

## Struktur file → letakkan di project Laravel kamu
| File di folder ini | Salin ke project |
|---|---|
| `database/migrations/*` | `database/migrations/` |
| `database/factories/ProductFactory.php` | `database/factories/` |
| `database/seeders/*` | `database/seeders/` (timpa DatabaseSeeder) |
| `app/Models/*` | `app/Models/` (timpa User.php) |
| `app/Http/Middleware/RoleMiddleware.php` | `app/Http/Middleware/` |
| `app/Http/Controllers/*` | `app/Http/Controllers/` (timpa Controller.php) |
| `app/Policies/ProductPolicy.php` | `app/Policies/` |
| `bootstrap/app.php` | **jangan ditimpa buta** — cukup tambahkan alias `role` ke file aslimu |
| `routes/web.php` | `routes/web.php` (timpa) |
| `resources/views/products/*` | `resources/views/products/` |
| `tests/Feature/RoleAccessTest.php` | `tests/Feature/` |

## Langkah eksekusi (urut)

### 0. Persiapan
```bash
composer create-project laravel/laravel TugasWeb-P11-EcommerceAuth
cd TugasWeb-P11-EcommerceAuth
# atur DB di .env (mis. DB_CONNECTION=mysql, DB_DATABASE=ecommerce_p11) lalu buat databasenya
```

### 1. Install Breeze (Bagian B.5)  — lakukan SEBELUM menyalin file
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
```

### 2. Salin semua file dari tabel di atas

### 3. Migrate + seed (Bagian A.1 & A.2)
```bash
php artisan migrate:fresh --seed
```
Akun uji (password: `password`): `admin@example.com`, `editor@example.com`, `user@example.com`

### 4. Tinker (A.4) → ikuti `docs/A4_tinker_queries.md`, screenshot hasilnya

### 5. Jalankan & uji manual (B.8)
```bash
php artisan serve
```
- Window biasa: login **admin** → bisa tambah/edit/hapus semua produk, buka `/admin`
- Window **incognito**: login **user** → tombol edit/hapus tidak muncul; buka `/products/create` → **403**
- Tes editor: hanya bisa edit/hapus produk miliknya (`user_id` = dia), `/admin` → 403
- Tanpa login buka `/products` → redirect ke `/login`

### 6. Automated test
```bash
php artisan test --filter=RoleAccessTest
```

### 7. Git
```bash
git init && git add . && git commit -m "Tugas P11 e-commerce auth"
# buat repo GitHub bernama: TugasWeb-P11-EcommerceAuth, lalu push
```

## Bonus
- Filament: `composer require filament/filament` → `php artisan filament:install --panels` → `php artisan make:filament-user`
  (agar admin-only, tambahkan `canAccessPanel()` di User.php yang return `$this->isAdmin()`, dan `implements FilamentUser`)
- Eager loading demo: sudah ada di `docs/A4_tinker_queries.md` dan `ProductController@index`

## Catatan
Soal menyebut **PostPolicy**; di sini objeknya produk, jadi dinamai `ProductPolicy`. Kalau dosen mewajibkan nama itu, ganti nama class/file dan modelnya saja.
