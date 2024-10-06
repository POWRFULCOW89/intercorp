@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold mb-4">Orders</h1>
@endsection

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Mi Carrito</h1>

        <!-- Display cart product or empty message -->
        @if($product)
            <div class="border border-gray-300 rounded-lg shadow-md p-4 mb-4 bg-white">
                <h2 class="text-xl font-semibold">Nombre: {{ $product->name }}</h2>
                <p class="text-gray-600">Descripción: {{ $product->description }}</p>
                <p class="text-lg font-bold mt-2">Precio final: ${{ number_format($product->price, 2) }}</p>
                <p class="text-gray-500">Stock: {{ $product->stock }}</p>

                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover mt-4 mx-auto">
                @endif

                <!-- Payment Information Section -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold">Información de pago</h3>
                    <form action="{{ route('orders.store') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-4">
                            <label for="card_number" class="block text-sm font-medium text-gray-700">Número de
                                tarjeta</label>
                            <input type="text" id="card_number" name="card_number" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                   placeholder="1234 5678 9012 3456">

                            @error('card_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="expiry_date" class="block text-sm font-medium text-gray-700">Fecha de
                                expiración</label>
                            <input type="text" id="expiry_date" name="expiry_date" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                   placeholder="MM/YY">

                            @error('expiry_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="mb-4">
                            <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                            <input type="text" id="cvv" name="cvv" required
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                   placeholder="123">

                            @error('cvv')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Comprar ahora</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-gray-500">Tu carrito está vaçío.</p>
        @endif

        <!-- Flash messages -->
        @if (session('success'))
            <div class="mt-4 p-4 bg-green-500 text-white rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Continuar
            comprando</a>
    </div>
@endsection
