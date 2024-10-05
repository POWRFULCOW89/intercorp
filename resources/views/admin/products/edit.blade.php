@extends('layouts.admin')

@section('content')
    <div class="container p-8">
        <h1 class="text-3xl font-bold mb-4">
            {{ $product->exists ? 'Editar Producto' : 'Crear Producto' }}
        </h1>

        <form
            action="{{ $product->exists ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
            method="POST" enctype="multipart/form-data">

            @csrf
            @if($product->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="description" id="description"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                    <input type="file" name="image" id="image"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="active" class="block text-sm font-medium text-gray-700">Activo</label>
{{--                    <input type="checkbox" name="active" id="active"--}}
{{--                            {{ old('active', $product->active) ? 'checked' : '' }}>--}}

                    <input type="hidden" name="active" value="0">

{{--                    <input type="checkbox" name="active" id="active" value="1"--}}
{{--                        {{ old('active', $product->active) ? 'checked' : '' }}>--}}

                    <input type="checkbox" name="active" id="active" value="1" class="mt-1 block border-gray-300 rounded-md shadow-sm"
                        {{ old('active', $product->active) ? 'checked' : '' }}>

                    @error('active')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Other form fields for description, price, stock, active, image upload -->
                <!-- Similar to the previous form implementation -->
            </div>

            <div class="mt-8">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    {{ $product->exists ? 'Actualizar Producto' : 'Crear Producto' }}
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="ml-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
