# Bukti Pengujian — Tugas Rutin 11

## A4. Query Tinker

**Query 1** — Scope `active()` + eager loading
![Query 1](docs/query1.png)

**Query 2** — Relasi kategori ke produk
![Query 2](docs/query2.png)

**Query 3** — Agregasi jumlah dan rata-rata harga per kategori
![Query 3](docs/query3.png)

**Query 4** — Order beserta item dan produk (nested eager loading)
![Query 4](docs/query4.png)

**Query 5** — Produk dengan rating rata-rata tertinggi
![Query 5](docs/query5.png)

## Bonus: N+1 vs Eager Loading

Tanpa eager loading terjadi 21 query (masalah N+1):
![N+1](docs/n-plus-1.png)

Dengan `with('category')` hanya 2 query:
![Eager Loading](docs/eager-loading.png)

## B8. Pengujian Role

**Admin** — tombol tambah/edit/hapus tampil
![Admin Produk](docs/admin-products.png)

**Admin** — akses halaman `/admin`
![Admin Panel](docs/admin-panel.png)

**User** (incognito) — tanpa tombol edit/hapus
![User Produk](docs/user-products.png)

**User** (incognito) — `/products/create` menghasilkan 403
![User 403](docs/user-403.png)

## Automated Test
```bash
php artisan test --filter=RoleAccessTest
```
![Test Result](docs/test-result.png)
