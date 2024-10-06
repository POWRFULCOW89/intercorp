<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::find($request->input('product'));

        return view('orders.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $productId = $request->validated()['product_id'];

        $order = auth()->user()->orders()->create([
            'product_id' => $productId,
            'quantity' => 1,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index', ['product' => $productId])
            ->with('success', '¡Orden creada con éxito!');

    }

    public function show(Order $order)
    {
        if (auth()->id() !== $order->user_id) {
            abort(403, 'Unauthorized access');
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function adminIndex()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $orders = Order::latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function changeStatus(Order $order, string $status)
    {
        $order->update(['status' => $status]);

//        ['created', 'pending', 'paid', 'shipped', 'delivered', 'canceled']

        switch ($status) {
            case 'shipped':
                $order->shipment()->create([
                    'tracking_number' => rand(100000, 999999),
                    'status' => 'created',
                ]);
                break;

            case 'paid':
//                $order->paid_at = now();
                break;
            case 'delivered':
                $order->update(['delivered_at' => now()]);
                break;
            case 'canceled':
                $order->update(['canceled_at' => now()]);
                break;
        }


        return redirect()->back()
            ->with('success', 'Order status updated successfully!');
    }
}
