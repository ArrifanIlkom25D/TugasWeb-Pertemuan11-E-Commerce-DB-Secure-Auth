<?php
namespace App\Policies;

use App\Models\Product;
use App\Models\User;

/**
 * Setara "PostPolicy" di materi: objek yang dilindungi di tugas ini adalah Product.
 * Aturan: admin boleh semua, editor hanya produk miliknya, user biasa tidak boleh.
 */
class ProductPolicy
{
    public function create(User $user): bool { return $user->hasRole('admin', 'editor'); }

    public function update(User $user, Product $product): bool
    {
        return $user->isAdmin() || ($user->isEditor() && $product->user_id === $user->id);
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->isAdmin() || ($user->isEditor() && $product->user_id === $user->id);
    }
}
