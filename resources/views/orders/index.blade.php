@extends('layouts.app')

@section('content')
<div class="p-8">

    @if($orders->count())
        <table class="table-auto w-full mb-8">
            <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Total</th>
                <th class="border px-4 py-2">Fecha</th>
                <th class="border px-4 py-2">Estatus</th>
                <th class="border px-4 py-2">Accioness</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="border px-4 py-2">{{ $order->id }}</td>
                    <td class="border px-4 py-2">${{ $order->product->price }}</td>
                    <td class="border px-4 py-2">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="border px-4 py-2">{{ $order->status }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('orders.show', $order->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <p>Todavía no cuentas con órdenes en Intercorp.</p>
    @endif

    <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Browse Products</a>

</div>

@endsection
