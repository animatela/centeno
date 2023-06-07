<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'workshop_services';


    public function items(): HasMany
    {
        return $this->hasMany(ServiceItem::class, 'workshop_service_id');
    }
}
