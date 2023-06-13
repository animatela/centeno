<?php

namespace Idat\Centeno\Workshop\Enums;

use Idat\Centeno\Shared\Enums\Concerns\GetsAttributes;

enum TransmissionType: string
{
    use GetsAttributes;

    case AT = 'at';
    case MT = 'mt';
}
