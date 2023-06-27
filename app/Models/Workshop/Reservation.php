<?php

namespace App\Models\Workshop;

use Idat\Centeno\Workshop\Enums\Currency;
use Idat\Centeno\Workshop\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperReservation
 */
class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reservations';

    protected $fillable = [
        'number',
        'currency',
        'date_time',
        'price',
        'status',
        'notes',
    ];

    protected $casts = [
        'currency' => Currency::class,
        'date_time' => 'datetime',
        'status' => ReservationStatus::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'vehicle_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
