<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vehicle extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'workshop_vehicles';

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function maker(): BelongsTo
    {
        return $this->belongsTo(Maker::class, 'workshop_maker_id');
    }
}
