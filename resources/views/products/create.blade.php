<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Tambah Produk</h2></x-slot>
    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('products.store') }}" class="space-y-3 bg-white p-6 shadow rounded">
            @csrf
            <input name="name" placeholder="Nama produk" class="w-full border rounded p-2" required>
            <select name="category_id" class="w-full border rounded p-2">
                @foreach ($categories as $c) <option value="{{ $c->id }}">{{ $c->name }}</option> @endforeach
            </select>
            <select name="brand_id" class="w-full border rounded p-2">
                @foreach ($brands as $b) <option value="{{ $b->id }}">{{ $b->name }}</option> @endforeach
            </select>
            <input name="price" type="number" placeholder="Harga" class="w-full border rounded p-2" required>
            <input name="stock" type="number" placeholder="Stok" class="w-full border rounded p-2" required>
            <textarea name="description" placeholder="Deskripsi" class="w-full border rounded p-2"></textarea>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
