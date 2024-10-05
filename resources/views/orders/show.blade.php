@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-4">Order Details</h1>

        <div class="border p-4 mb-4">
            <h2 class="text-xl font-semibold">Order ID: {{ $order->id }}</h2>
            <p>Total: ${{ $order->total }}</p>
            <p>Date: {{ $order->created_at->format('M d, Y') }}</p>
            <p>Status: {{ $order->status }}</p>

            <table class="table-auto w-full mt-4">
                <thead>
                <tr>
                    <th class="border px-4 py-2">Product</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="border px-4 py-2">{{ $order->product->name }}</td>
                    <td class="border px-4 py-2">${{ $order->product->price }}</td>
                    <td class="border px-4 py-2">{{ $order->quantity }}</td>
                    <td class="border px-4 py-2">${{ $order->quantity * $order->product->price }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <a href="{{ route('orders.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Back to
            Orders</a>
@endsection
