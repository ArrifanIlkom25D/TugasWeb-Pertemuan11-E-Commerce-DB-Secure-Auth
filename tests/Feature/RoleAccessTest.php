<?php
namespace Tests\Feature;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    private function product(User $owner): Product
    {
        return Product::create([
            'user_id' => $owner->id,
            'category_id' => Category::create(['name' => 'Test', 'slug' => 'test'])->id,
            'brand_id' => Brand::create(['name' => 'TestBrand'])->id,
            'name' => 'Produk Test', 'slug' => 'produk-test', 'price' => 1000, 'stock' => 5,
        ]);
    }

    public function test_guest_redirected_to_login(): void
    {
        $this->get('/products')->assertRedirect('/login');
    }

    public function test_user_cannot_access_create_page(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'user']))->get('/products/create')->assertForbidden();
    }

    public function test_editor_cannot_edit_other_editors_product(): void
    {
        $other = User::factory()->create(['role' => 'editor']);
        $me    = User::factory()->create(['role' => 'editor']);
        $p = $this->product($other);

        $this->actingAs($me)->get("/products/{$p->id}/edit")->assertForbidden();
    }

    public function test_admin_can_delete_any_product(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);
        $p = $this->product($editor);

        $this->actingAs(User::factory()->create(['role' => 'admin']))
             ->delete("/products/{$p->id}")->assertRedirect('/products');
        $this->assertModelMissing($p);
    }

    public function test_only_admin_can_open_admin_panel(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'editor']))->get('/admin')->assertForbidden();
        $this->actingAs(User::factory()->create(['role' => 'admin']))->get('/admin')->assertOk();
    }
}
