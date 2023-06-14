<?php

namespace Idat\Centeno\Workshop\Enums;

use Idat\Centeno\Shared\Enums\Concerns\GetsAttributes;

enum ReservationStatus: string
{
    use GetsAttributes;

    case NEW = 'new';
    case STARTED = 'started';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
