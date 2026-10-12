<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Edit Produk</h2></x-slot>
    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-3 bg-white p-6 shadow rounded">
            @csrf @method('PUT')
            <input name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded p-2" required>
            <input name="price" type="number" value="{{ old('price', $product->price) }}" class="w-full border rounded p-2" required>
            <input name="stock" type="number" value="{{ old('stock', $product->stock) }}" class="w-full border rounded p-2" required>
            <textarea name="description" class="w-full border rounded p-2">{{ old('description', $product->description) }}</textarea>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
        </form>
    </div>
</x-app-layout>
