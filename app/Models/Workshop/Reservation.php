<?php

namespace App\Models\Workshop;

use Idat\Centeno\Workshop\Enums\Currency;
use Idat\Centeno\Workshop\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
        'reservation_date',
        'reservation_time',
        'price',
        'status',
        'notes',
    ];

    protected $casts = [
        'currency' => Currency::class,
        'reservation_date' => 'datetime:Y-m-d',
        'reservation_time' => 'datetime:H:i:s',
        'status' => ReservationStatus::class,
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function ($model) {
            $model->number = Str::upper(Str::of(Str::ulid()->toRfc4122())->explode('-')->last());
            $model->status = ReservationStatus::NEW;
        });
    }

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
