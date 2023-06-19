<?php

namespace Idat\Centeno\Workshop\Objects\Services;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ServiceData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        public string|Optional $description,
        public string|Optional $type,
        public int|Optional $position,
        public bool $is_visible,
        public string|Optional $seo_title,
        public string|Optional $seo_description,
        public int|Optional $sort,
        public Carbon|Optional|null $created_at,
        public Carbon|Optional|null $updated_at,
        public Carbon|Optional|null $deleted_at,
    ) {}
}
