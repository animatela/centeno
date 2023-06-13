<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperServiceItem
 */
class ServiceItem extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'service_items';
}
