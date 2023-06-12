<?php

namespace Idat\Centeno\Shared\Enums\Concerns;

use Idat\Centeno\Shared\Enums\Attributes\Description;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use ReflectionClassConstant;

trait GetsAttributes
{
    private static function getDescription(self $enum): string
    {
        $ref = new ReflectionClassConstant(self::class, $enum->name);
        $classAttributes = $ref->getAttributes(Description::class);

        if (count($classAttributes) === 0) {
            return Str::headline($enum->value);
        }

        return $classAttributes[0]->newInstance()->description;
    }

    private static function getTranslation(self $enum): string
    {
        return trans(
            Arr::join([
                'enums',
                Str::snake(class_basename($enum::class)),
                Str::lower($enum->name),
            ], '.')
        );
    }

    /**
     * @return array<string,string>
     */
    public static function asSelectArray(): array
    {
        return collect(self::cases())->map(
            fn ($enum) => [
                'name' => self::getTranslation($enum),
                'value' => $enum->value,
            ]
        )->toArray();
    }
}
