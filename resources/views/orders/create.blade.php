@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold mb-4">Orders</h1>
@endsection

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

        <!-- Display cart product or empty message -->
        @if($product)
            <div class="border p-4 mb-4">
                <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p class="text-lg font-bold">${{ $product->price }}</p>
                <p class="text-gray-500">Stock: {{ $product->stock }}</p>

                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover mt-4">
                @endif

                <!-- Remove from Cart Button -->
{{--                <form action="{{ route('cart.remove') }}" method="POST" class="mt-4">--}}
{{--                    @csrf--}}
{{--                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Remove from Cart</button>--}}
{{--                </form>--}}

                <form action="{{ route('orders.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Place Order</button>
                </form>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif

        <!-- Flash messages -->
        @if (session('success'))
            <div class="mt-4 p-4 bg-green-500 text-white">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-500 text-white px

@endsection

