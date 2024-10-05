@extends('layouts.app')

@section('content')

    <div class="p-8">
        <h1 class="text-3xl font-bold">Rastreo de pedidos</h1>
        <p>Número de rastreo: <strong>{{ $shipment->tracking_number }}</strong></p>
        <p>Estatus actual: <strong id="current-status">{{ ucfirst($shipment->mapped_status) }}</strong></p>
        <p>Última actualización: <strong
                    id="latest-update">{{ \Carbon\Carbon::parse($shipment->updated_at)->diffForHumans() }}</strong></p>


        <div class="status mt-8">
            <h3 class="text-xl font-semibold mb-4">Status History</h3>
            @php
                $statusProgression = ['created', 'documented', 'traveling', 'drop_off', 'delivered'];
                $icons = [
                    'created' => 'https://www.rastreaguia.com/icons/document.svg',
                    'documented' => 'https://www.rastreaguia.com/icons/document.svg',
                    'traveling' => 'https://www.rastreaguia.com/icons/truck.svg',
                    'drop_off' => 'https://www.rastreaguia.com/icons/store.svg',
                    'delivered' => 'https://www.rastreaguia.com/icons/delivered.svg',
                ];

                $colors = [
                    'created' => 'bg-yellow-500',
                    'documented' => 'bg-orange-500',
                    'traveling' => 'bg-blue-500',
                    'drop_off' => 'bg-green-500',
                    'delivered' => 'bg-green-500',
                ];

                $translatedStatus = [
                    'created' => 'Creado',
                    'documented' => 'Documentado',
                    'traveling' => 'En camino',
                    'drop_off' => 'Entregado a paquetería',
                    'delivered' => 'Entregado',
                ];
                $currentStatusIndex = array_search($shipment->status, $statusProgression);
            @endphp


            <ol class="relative border-l border-gray-200 dark:border-gray-700 p-2 m-2 lg:p-5 lg:m-5">
                @foreach($statusProgression as $index => $status)
                    @if($index <= $currentStatusIndex)
                        <li class="mb-5 ml-12">
                        <span
                                class="absolute flex items-center justify-center w-12 h-12 rounded-full -left-6 p-2 {{ $colors[$status] }} ">
                          <img src="{{ $icons[$status] }}" alt="Ícono">
                        </span>
                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">
                                {{ $translatedStatus[$status] }}
                            </h3>
                            {{--                            <time class="block mb-2 lg:text-sm  text-gray-400 dark:text-gray-500">--}}

                            {{--                                21 de noviembre del 2023 a las 11:45--}}
                            {{--                            </time>--}}

                            <p class="text-sm mb-2 text-gray-500">
                                Descripción: {{ \App\Models\Shipment::$statusDescriptions[$status] }}
                            </p>
                        </li>
                    @endif
                @endforeach
            </ol>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <li class="relative pb-10">

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const trackingNumber = "{{ $shipment->tracking_number }}";

                // Initialize Laravel Echo
                console.log(`Listening on shipment.${trackingNumber}`);

                Echo.private(`shipment.${trackingNumber}`)
                    .listen('.shipment.updated', (e) => {
                        console.log('Shipment updated:', e);

                        // Update the current status in the shipment tracking page
                        document.getElementById('current-status').textContent = e.status;

                        // Append the new status to the stepper
                        location.reload(); // Simple refresh to redraw the stepper with updated data
                    });
            });
        </script>
@endpush
