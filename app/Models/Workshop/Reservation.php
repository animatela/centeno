<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'workshop_reservations';

    protected $fillable = [
        'number',
        'price',
        'status',
        'currency',
        'notes',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'workshop_service_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'workshop_vehicle_id');
    }
}
