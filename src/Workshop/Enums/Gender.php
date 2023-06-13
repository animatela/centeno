<?php

namespace Idat\Centeno\Workshop\Enums;

use Idat\Centeno\Shared\Enums\Concerns\GetsAttributes;

enum Gender: string
{
    use GetsAttributes;

    case MALE = 'male';
    case FEMALE = 'female';
}
