@extends('layouts.admin')

@section('content')
    <div class="container p-8">
        <h1 class="text-3xl font-bold mb-4">Product Details</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Product Information -->
            <div class="bg-white shadow p-6 rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">{{ $product->name }}</h2>

                <p class="text-gray-600 mb-4">
                    <strong>Description:</strong> <br>
                    {{ $product->description }}
                </p>

                <p class="text-gray-600 mb-4">
                    <strong>Price:</strong> ${{ number_format($product->price, 2) }}
                </p>

                <p class="text-gray-600 mb-4">
                    <strong>Stock:</strong> {{ $product->stock }} units
                </p>

                <p class="text-gray-600 mb-4">
                    <strong>Active:</strong>
                    @if($product->active)
                        <span class="text-green-500">Yes</span>
                    @else
                        <span class="text-red-500">No</span>
                    @endif
                </p>

                <p class="text-gray-600 mb-4">
                    <strong>Created At:</strong> {{ $product->created_at->format('d-m-Y H:i') }}
                </p>

                <p class="text-gray-600 mb-4">
                    <strong>Last Updated:</strong> {{ $product->updated_at->format('d-m-Y H:i') }}
                </p>
            </div>

            <!-- Product Image -->
            <div class="bg-white shadow p-6 rounded-lg flex items-center justify-center">
                @if($product->image)
                    <img src="{{  $product->image }}" alt="{{ $product->name }}" class="w-full max-w-md rounded-lg shadow-lg">
                @else
                    <p class="text-gray-600">No image available</p>
                @endif
            </div>

        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('admin.products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Back to Products
            </a>
        </div>
    </div>
@endsection
