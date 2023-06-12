<?php

namespace Idat\Centeno\Shared\Enums\Attributes;

use Attribute;

#[Attribute]
class Description
{
    public function __construct(
        public readonly string $description,
    ) {}
}
