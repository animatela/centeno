<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAddressable
 */
class Addressable extends Model
{
    use HasFactory;

    protected $table = 'addressables';
}
