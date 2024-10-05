<?php

namespace App\Http\Controllers;

use App\Events\ShipmentUpdated;
use App\Models\Shipment;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShipmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment, string $status)
    {

        $shipment->update([
            'status' => $status,
        ]);

        broadcast(new ShipmentUpdated($shipment))->toOthers();

        if ($status === 'delivered') {
            $shipment->order->update([
                'status' => 'delivered',
            ]);
        }

        return back()->with('message', 'Shipment status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }

    public function adminIndex()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $shipments = Shipment::latest()->paginate(10);

        return view('admin.shipments.index', compact('shipments'));
    }

    public function track(Shipment $shipment)
    {
        $header = 'Rastreo de pedidos';

        return view('shipments.track', compact('shipment', 'header'));
    }
}
