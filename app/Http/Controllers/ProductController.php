<?php
namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // Eager loading (bonus): hindari N+1
        $products = Product::with(['category', 'brand', 'owner'])->active()->latest()->paginate(15);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        return view('products.create', ['categories' => Category::all(), 'brands' => Brand::all()]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(4);
        $data['user_id'] = $request->user()->id;
        Product::create($data);

        return redirect()->route('products.index')->with('status', 'Produk dibuat.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('products.edit', ['product' => $product, 'categories' => Category::all(), 'brands' => Brand::all()]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);
        $product->update($data);

        return redirect()->route('products.index')->with('status', 'Produk diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Produk dihapus.');
    }
}
