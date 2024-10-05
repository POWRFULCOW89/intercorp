@extends('layouts.admin')

@section('admin-content')
    <main class="flex-1 bg-gray-100 p-6">
        <!-- Tarjeta del Dashboard -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
{{--            <p class="text-lg">Bienvenido al panel de administración.</p>--}}
        </div>

        <!-- Tarjeta de Total de Órdenes -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-2">Total de Órdenes</h3>
                <p class="text-4xl font-bold text-center">{{ $totalOrders }}</p>
            </div>

            <!-- Tarjeta de Total de Envíos -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-2">Total de Envíos</h3>
                <p class="text-4xl font-bold text-center">{{ $totalShipments }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Gráfico de barras de productos más vendidos -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-4">Productos más vendidos</h3>
                <canvas id="bestSellingProductsChart"></canvas>
            </div>

            <!-- Gráfico de líneas de órdenes atendidas por mes -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-4">Órdenes atendidas por mes</h3>
                <canvas id="ordersPerMonthChart"></canvas>
            </div>

            <!-- Gráfico de pastel de productos más pedidos -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-4">Productos más pedidos</h3>
                <canvas id="mostOrderedProductsChart"></canvas>
            </div>

            <!-- Gráfico de barras de envíos en los últimos 7 días -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold mb-4">Envíos en los últimos 7 días</h3>
                <canvas id="shipmentsLastWeekChart"></canvas>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Datos para el gráfico de productos más vendidos
            const bestSellingProductsCtx = document.getElementById('bestSellingProductsChart').getContext('2d');
            const bestSellingProductsLabels = @json($bestSellingProducts->pluck('product.name'));
            const bestSellingProductsData = @json($bestSellingProducts->pluck('total_quantity'));
            const bestSellingProductsChart = new Chart(bestSellingProductsCtx, {
                type: 'bar',
                data: {
                    labels: bestSellingProductsLabels,
                    datasets: [{
                        label: 'Cantidad vendida',
                        data: bestSellingProductsData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Datos para el gráfico de órdenes atendidas por mes
            const ordersPerMonthCtx = document.getElementById('ordersPerMonthChart').getContext('2d');
            const ordersPerMonthLabels = @json($ordersPerMonth->pluck('month'));
            const ordersPerMonthData = @json($ordersPerMonth->pluck('total_orders'));
            const ordersPerMonthChart = new Chart(ordersPerMonthCtx, {
                type: 'line',
                data: {
                    labels: ordersPerMonthLabels,
                    datasets: [{
                        label: 'Órdenes atendidas',
                        data: ordersPerMonthData,
                        fill: false,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Datos para el gráfico de productos más pedidos
            const mostOrderedProductsCtx = document.getElementById('mostOrderedProductsChart').getContext('2d');
            const mostOrderedProductsLabels = @json($mostOrderedProducts->pluck('product.name'));
            const mostOrderedProductsData = @json($mostOrderedProducts->pluck('total_orders'));
            const mostOrderedProductsChart = new Chart(mostOrderedProductsCtx, {
                type: 'pie',
                data: {
                    labels: mostOrderedProductsLabels,
                    datasets: [{
                        label: 'Productos más pedidos',
                        data: mostOrderedProductsData,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (context.parsed !== null) {
                                        label += ': ' + context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Datos para el gráfico de envíos en los últimos 7 días
            const shipmentsLastWeekCtx = document.getElementById('shipmentsLastWeekChart').getContext('2d');
            const shipmentsLastWeekLabels = @json($shipmentsLastWeek->pluck('date'));
            const shipmentsLastWeekData = @json($shipmentsLastWeek->pluck('total_shipments'));
            const shipmentsLastWeekChart = new Chart(shipmentsLastWeekCtx, {
                type: 'bar',
                data: {
                    labels: shipmentsLastWeekLabels,
                    datasets: [{
                        label: 'Total envíos',
                        data: shipmentsLastWeekData,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
