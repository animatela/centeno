<?php

namespace Idat\Centeno\Workshop\Objects\Services;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdatedServiceData extends Data
{
    public function __construct(
        public string $name,
        public string $slug,
        public string|Optional $description,
        public string|Optional $type,
        public int|Optional $position,
        public bool $is_visible,
        public string|Optional $seo_title,
        public string|Optional $seo_description,
        public int|Optional $sort,
    ) {}
}
