@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold mb-4">Products</h1>
@endsection

@section('content')
    <div class="p-8">
        <!-- Search Form -->
        <form method="GET" action="{{ route('products.index') }}" class="mb-6 w-full flex ">
            <input type="text" name="search" value="{{ request()->get('search') }}" placeholder="Search products..."
                   class="border border-gray-300 p-2 rounded flex-1 ">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded ml-2">Search</button>
        </form>

        <!-- Products Table -->

        <div class="grid grid-cols-3 gap-4">
            @foreach($products as $product)
                <div class="flex-col justify-center items-center my-8 flex-1 p-4">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-1/3 rounded-lg">

                    <div class="m-6">
                        <h4 class="font-bold text-2xl">{{ $product->name }}</h4>
                        <p class="text-gray-600 my-4">{{ $product->description }}</p>
                        <p class="text-gray-600 my-4 text-xl font-bold">{{ \Illuminate\Support\Number::currency($product->price) }}</p>

                        <a href="{{ route('orders.create', compact('product')) }}" class="uppercase text-sm font-bold text-white bg-orange-600 p-6 rounded-full">Comprar
                            ahora
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $products->appends(['search' => request()->get('search')])->links() }}
        </div>
    </div>
@endsection
