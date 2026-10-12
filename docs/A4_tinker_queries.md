# A.4 — 5 Query Tinker (screenshot tiap hasilnya)

Jalankan: `php artisan tinker`

```php
// 1. Scope active() + eager loading (bonus eager loading demo)
App\Models\Product::with(['category','brand'])->active()->take(5)->get(['id','name','price','category_id','brand_id']);

// 2. Relationship: semua produk dalam kategori Smartphone
App\Models\Category::where('name','Smartphone')->first()->products->pluck('name');

// 3. Agregasi: jumlah produk & rata-rata harga per kategori
App\Models\Category::withCount('products')->withAvg('products','price')->get(['id','name']);

// 4. Order milik user beserta item & produknya (nested eager loading)
App\Models\User::where('email','user@example.com')->first()->orders()->with('items.product')->get();

// 5. Produk dengan rating rata-rata tertinggi
App\Models\Product::withAvg('reviews','rating')->having('reviews_avg_rating','>',0)->orderByDesc('reviews_avg_rating')->take(5)->get(['id','name']);
```

## Demo N+1 vs eager loading (bonus)
```php
DB::enableQueryLog();
App\Models\Product::take(20)->get()->each(fn($p) => $p->category->name);
count(DB::getQueryLog());   // ±21 query (N+1)

DB::flushQueryLog();
App\Models\Product::with('category')->take(20)->get()->each(fn($p) => $p->category->name);
count(DB::getQueryLog());   // 2 query
```
