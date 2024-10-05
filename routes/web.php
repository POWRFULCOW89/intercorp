<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipmentController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $latestProducts = Product::latest()->take(3)->get();
    return view('welcome', compact('latestProducts'));
})->name('welcome');

Route::get('/laptops', [ProductController::class, 'index'])->name('products.index');

Route::post('contact', function () {
    return 'Your message has been sent successfully!';
})->name('contact');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
Route::get('/admin/products/{product}', [ProductController::class, 'adminShow'])->name('admin.products.show');

Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');

Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
Route::get('/admin/shipments', [ShipmentController::class, 'adminIndex'])->name('admin.shipments.index');

Route::post('/orders/{order}/status/{status}', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');

Route::post('/shipments/track/{shipment:tracking_number}/{status}', [ShipmentController::class, 'update'])->name('shipments.update');
Route::get('/shipments/track/{shipment:tracking_number}', [ShipmentController::class, 'track'])->name('shipments.track');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/dashboard', function () {

        $totalOrders = Order::count();
        $totalShipments = Shipment::count();

        $bestSellingProducts = Order::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->with('product:id,name') // Asegúrate de que la relación esté definida en el modelo Order
            ->limit(5)
            ->get();

        // Gráfico de líneas de órdenes atendidas por mes
        $ordersPerMonth = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total_orders')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Gráfico de pastel de productos más pedidos
        $mostOrderedProducts = Order::select('product_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('product_id')
            ->orderBy('total_orders', 'desc')
            ->with('product:id,name') // Asegúrate de que la relación esté definida en el modelo Order
            ->limit(5)
            ->get();

        // Gráfico de barras de envíos en los últimos 7 días
        $shipmentsLastWeek = Shipment::whereBetween('created_at', [now()->subDays(7), now()])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total_shipments')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

//        dd($bestSellingProducts, $ordersPerMonth, $mostOrderedProducts, $shipmentsLastWeek);


        return view('dashboard', compact(
            'bestSellingProducts',
            'ordersPerMonth',
            'mostOrderedProducts',
            'shipmentsLastWeek',
            'totalOrders',
            'totalShipments'
        ));
    })->name('dashboard');
});
