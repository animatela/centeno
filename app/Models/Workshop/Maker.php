<?php

namespace App\Models\Workshop;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Maker extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'workshop_makers';

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class, 'addressable', 'addressables');
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'workshop_maker_id');
    }
}
