<?php

namespace App\Models\Shop;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'shop_customers';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
