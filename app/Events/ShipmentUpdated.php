<?php

namespace App\Events;

use App\Models\Shipment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShipmentUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(private readonly Shipment $shipment)
    {
        //
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('shipment.'.$this->shipment->tracking_number),
        ];
    }

    public function broadcastAs(): string
    {
        return 'shipment.updated';
    }
}
