<?php

namespace Idat\Centeno\Workshop\Enums;

use Idat\Centeno\Shared\Enums\Concerns\GetsAttributes;

enum Currency
{
    use GetsAttributes;

    case PEN;
    case USD;
}
