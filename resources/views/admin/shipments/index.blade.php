@extends('layouts.admin')

@section('admin-content')
    <div class="p-8 w-full">

        @if($shipments->count())
            <table class="table-auto w-full mb-8">
                <thead>
                <tr>
                    <th class="border px-4 py-2">Clave</th>
                    <th class="border px-4 py-2">Número de rastreo</th>
                    <th class="border px-4 py-2">Estatus</th>
                    {{--                    <th class="border px-4 py-2">Date</th>--}}
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shipments as $shipment)

                    <tr>
                        <td class="border px-4 py-2">{{ $shipment->id }}</td>
                        <td class="border px-4 py-2">{{ $shipment->tracking_number }}</td>
                        <td class="border px-4 py-2">{{ $shipment->mapped_status }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('orders.show', $shipment->id) }}"
                               class="bg-blue-500 text-white px-4 py-2 rounded">Ver</a>

                            @if($shipment->status != 'delivered')
                                <form
                                    action="{{ route('shipments.update', ["shipment" => $shipment->tracking_number, "status" => $shipment->next_status]) }}"
                                    method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('POST')

                                    <input type="hidden" name="status" value="{{ $shipment->next_status }}">
                                    <button type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded">Marcar
                                        como {{ $shipment->mapped_next_status }}
                                    </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $shipments->links() }}
            </div>
        @else
            <p>No hay órdenes nuevas</p>
        @endif

{{--        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">Browse--}}
{{--            Products</a>--}}

    </div>

@endsection
