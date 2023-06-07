<?php

namespace App\Models\Workshop;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'workshop_customers';

    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class, 'addressable', 'addressables');
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'workshop_customer_id');
    }
}
