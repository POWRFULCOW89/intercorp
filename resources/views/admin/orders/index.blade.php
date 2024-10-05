@extends('layouts.admin')

@section('admin-content')
    <div class="p-8 w-full">

        @if($orders->count())
            <table class="table-auto w-full mb-8">
                <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Fecha</th>
                    <th class="border px-4 py-2">Estatus</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="border px-4 py-2">{{ $order->id }}</td>
                        <td class="border px-4 py-2">${{ $order->product->price }}</td>
                        <td class="border px-4 py-2">{{ $order->created_at->translatedFormat('d \d\e F \d\e\l Y') }}</td>
                        <td class="border px-4 py-2">{{ $order->mapped_status }}</td>
                        <td class="border px-4 py-2 flex gap-3">
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="bg-blue-500 text-white px-4 py-2 rounded">Ver</a>

                            @if($order->status === 'paid')
                                <form
                                    action="{{ route('orders.changeStatus', ['order' => $order->id, 'status' => 'shipped']) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                        Enviar
                                    </button>
                                </form>
                            @endif
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
            <p>You have no orders yet.</p>
        @endif

{{--        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Ver pro</a>--}}

    </div>

@endsection
