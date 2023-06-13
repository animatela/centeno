<?php

namespace Idat\Centeno\Workshop\Enums;

use Idat\Centeno\Shared\Enums\Concerns\GetsAttributes;

enum DocumentType: string
{
    use GetsAttributes;

    case DNI = 'dni';
    case RUC = 'ruc';
    case CE = 'ce';
}
