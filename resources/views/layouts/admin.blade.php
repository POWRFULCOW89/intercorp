@extends('layouts.app')

@section('content')
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-500 text-white">
            <div class="p-4">
                <h3 class="text-lg font-semibold">Menú de administración</h3>
            </div>
            <nav class="mt-4">
                <ul>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                            Productos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                            Órdenes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.shipments.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                            Envíos
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        @yield('admin-content')

    </div>
@endsection
