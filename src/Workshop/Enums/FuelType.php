<?php

namespace Idat\Centeno\Workshop\Enums;

use Idat\Centeno\Shared\Enums\Concerns\GetsAttributes;

enum FuelType: string
{
    use GetsAttributes;

    case DIESEL = 'diesel';
    case GASOLINE = 'gasoline';
    case LPG = 'lpg';
    case NGV = 'ngv';
    case BI_FUEL = 'dual';
    case ELECTRIC = 'electric';
}
