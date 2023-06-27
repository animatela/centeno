<?php

namespace Idat\Centeno\Workshop\Enums;

use Idat\Centeno\Shared\Enums\Concerns\GetsAttributes;

enum Currency: string
{
    use GetsAttributes;

    case PEN = 'PEN';
    case USD = 'USD';
}
