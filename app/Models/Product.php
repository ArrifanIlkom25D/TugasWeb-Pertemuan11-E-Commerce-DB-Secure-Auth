<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'brand_id', 'name', 'slug',
        'description', 'price', 'stock', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    // ---- Scope (minimal 1) ----
    public function scopeActive(Builder $q): Builder { return $q->where('is_active', true)->where('stock', '>', 0); }
    public function scopeCheaperThan(Builder $q, int $price): Builder { return $q->where('price', '<', $price); }

    // ---- Relationships ----
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function brand(): BelongsTo    { return $this->belongsTo(Brand::class); }
    public function owner(): BelongsTo    { return $this->belongsTo(User::class, 'user_id'); }
    public function reviews(): HasMany    { return $this->hasMany(Review::class); }
    public function orderItems(): HasMany { return $this->hasMany(OrderItem::class); }
}
