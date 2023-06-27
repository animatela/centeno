<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperService
 */
class Service extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ServiceItem::class, 'service_id');
    }
}
