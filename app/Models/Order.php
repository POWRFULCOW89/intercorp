<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;


/***
 * @mixin Builder
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'status',
    ];

    protected static $mappedStatus = [
        'pending' => 'Pendiente',
        'paid' => 'Pagado',
        'shipped' => 'Enviado',
        'delivered' => 'Entregado',
        'canceled' => 'Cancelado',
    ];

    public function getMappedStatusAttribute(): string
    {
        return self::$mappedStatus[$this->status] ?? 'Desconocido';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class);
    }
}
