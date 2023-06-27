<?php

namespace Idat\Centeno\Workshop\Objects\Services;

use Idat\Centeno\Workshop\Enums\Currency;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ServiceItemData extends Data
{
    public function __construct(
        public int $id,
        public int|Optional $sort,
        public int|Optional $service_id,
        public string|Optional $description,
        public Currency|Optional $currency,
        public int|Optional $quantity,
        public float|Optional $price,
        public Carbon|Optional|null $created_at,
        public Carbon|Optional|null $updated_at,
    ) {}
}
