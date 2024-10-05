@extends('layouts.admin')

@section('admin-content')
    <div class="p-8 w-full">

        <a href="{{ route('admin.products.create') }}"
           class=" mb-3 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear producto</a>

        @if($products->count())
            <table class="table-auto w-full my-8">
                <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nombre</th>
                    <th class="border px-4 py-2">Precio</th>
                    <th class="border px-4 py-2">Stock</th>
                    <th class="border px-4 py-2">Fecha</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="border px-4 py-2">{{ $product->id }}</td>
                        <td class="border px-4 py-2">{{ $product->name }}</td>
                        <td class="border px-4 py-2">{{ \Illuminate\Support\Number::currency($product->price) }}</td>
                        <td class="border px-4 py-2">{{ ($product->stock) }}</td>
                        <td class="border px-4 py-2">{{ $product->created_at->translatedFormat('d \d\e F \d\e\l Y') }}</td>
                        <td class="border px-4 py-2 flex gap-3">
                            <a href="{{ route('admin.products.show', ['product' => $product->id]) }}"
                               class="bg-blue-500 text-white px-4 py-2 rounded">Ver</a>

                            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                               class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @else
            <p>No hay productos.</p>
        @endif

        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Ver
            productos en tienda</a>

    </div>
@endsection
