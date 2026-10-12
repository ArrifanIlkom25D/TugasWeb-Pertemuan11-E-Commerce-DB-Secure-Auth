<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Daftar Produk</h2></x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        @if (session('status')) <div class="mb-4 p-3 bg-green-100 rounded">{{ session('status') }}</div> @endif

        @can('create', App\Models\Product::class)
            <a href="{{ route('products.create') }}" class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded">+ Produk</a>
        @endcan

        <table class="w-full bg-white shadow rounded text-sm">
            <thead><tr class="text-left border-b">
                <th class="p-3">Nama</th><th>Kategori</th><th>Brand</th><th>Harga</th><th>Stok</th><th>Aksi</th>
            </tr></thead>
            <tbody>
            @foreach ($products as $p)
                <tr class="border-b">
                    <td class="p-3">{{ $p->name }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td>{{ $p->brand->name }}</td>
                    <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>{{ $p->stock }}</td>
                    <td class="flex gap-2 py-2">
                        @can('update', $p)
                            <a href="{{ route('products.edit', $p) }}" class="text-indigo-600">Edit</a>
                        @endcan
                        @can('delete', $p)
                            <form method="POST" action="{{ route('products.destroy', $p) }}" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-app-layout>
