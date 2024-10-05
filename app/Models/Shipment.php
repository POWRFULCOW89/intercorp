<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 */
class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tracking_number',
        'status',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static array $statusDescriptions = [
        'created' => 'La guía de envío ha sido creada',
        'documented' => 'La paquetería ha recibido el paquete',
        'traveling' => 'El paquete se encuentra en camino',
        'drop_off' => 'El paquete ha llegado a la oficina destino',
        'delivered' => 'El paquete ha sido entregado',
        'return' => 'El paquete ha sido devuelto',
    ];

    protected static array $mappedStatus = [
        'created' => 'Creado',
        'documented' => 'Documentado',
        'traveling' => 'En camino',
        'drop_off' => 'En punto de entrega',
        'delivered' => 'Entregado',
        'return' => 'Devuelto',
    ];

    public function getMappedStatusAttribute(): string
    {
        return self::$mappedStatus[$this->status] ?? 'Desconocido';
    }

    public function getNextStatusAttribute(): string
    {
        $statuses = [
            'created' => 'documented',
            'documented' => 'traveling',
            'traveling' => 'drop_off',
            'drop_off' => 'delivered',
//            'delivered' => 'return',
//            'return' => 'created',
        ];

        return $statuses[$this->status] ?? 'unknown';
    }

    public function getMappedNextStatusAttribute(): string
    {
        return self::$mappedStatus[$this->getNextStatusAttribute()] ?? 'Desconocido';
    }
}
