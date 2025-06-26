<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Active    = 'active';
    case Completed = 'completed';

    public static function values(): array
    {
        return array_map(fn (self $s) => $s->value, self::cases());
    }
}
